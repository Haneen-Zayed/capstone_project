<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\Transaction;
use Core\Model\Item;


class Transactions extends Controller
{

    use Tests;

    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
        $this->admin_view(true);
    }

    /**
     * Gets all transactions
     *
     * @return array
     */
    public function index()
    {
        $this->permissions(['Admin','Accountant']);
        $this->view = 'transactions.index';
        $transaction = new Transaction; // new model transaction.
        $this->data['transactions'] = $transaction->get_all();
        $this->data['transactions_count'] = count($transaction->get_all());
    }

    public function single()
    {

        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Accountant','Seller']);
        $this->view = 'transactions.single';
        $transaction = new Transaction();
        $this->data['transaction'] = $transaction->get_by_id($_GET['id']);
    }

    /**
     * Display the HTML form for transaction creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['Admin','Seller']);
        $this->view = 'transactions.create';
        $items = new Item();
        $items = $items->get_available_item();
        $transaction = new Transaction();
        $this->data['items'] = $items;
        $this->data['transactions'] = $transaction->get_user_transactions($_SESSION['user']['user_id']);
        $this->data['transactions_count'] = count($transaction->get_user_transactions($_SESSION['user']['user_id']));
    }


    /**
     * Display the HTML form for transaction update
     *
     * @return void
     */
    public function edit()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Accountant','Seller']);
        $this->view = 'transactions.edit';
        $transaction = new Transaction();
        $selected_transaction = $transaction->get_by_id($_GET['id']);
        $this->data['transaction'] = $selected_transaction;
    }

    /**
     * Updates the transaction
     * ..
     * @return void
     */
    public function update()
    {
        $this->permissions(['Admin','Accountant','Seller']);
        $transaction = new Transaction();
        $_POST['total_price'] =$_POST['item_quantity'] * $_POST['item_price'];
        $transaction->update($_POST);
        Helper::redirect('/transaction?id=' . $_POST['id']);
    }

    /**
     * Delete the transaction
     *
     * @return void
     */
    public function delete()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Accountant','Seller']);
        $this->updateQuantity($_GET['id']);
        $transaction = new Transaction();
        $transaction->delete($_GET['id']);
        if ($this->permissions(['Admin','Accountant'])) {
            Helper::redirect('/transactions');
          } elseif ($this->permissions(['Seller'])){
            Helper::redirect('/transactions/create');
          }   
     
    }

    // update available quantity in items table coz deleting transaction
    public function updateQuantity($id){
        $items = new Item();
        $selected_item= $items->get_item_transactions($id);
        $transaction = new Transaction();
        $selected_transaction = $transaction->get_by_id($id);
        $selected_item->stock= $selected_item->stock + $selected_transaction->item_quantity;
        $item=(array)$selected_item;
        unset($item['user_id']);
        unset($item['transaction_id']);
        $item['id']=$item['item_id'];
        unset($item['item_id']);
        $items->update($item);
    }
}
