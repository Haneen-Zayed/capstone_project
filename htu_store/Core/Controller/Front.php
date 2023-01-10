<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Model\User;
use DateTime;

class Front extends Controller
{
    
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

    public function index()
    {
        $this->view = 'dashboard';
        //1 show Total sales
        //2 show Total transaction
        $transaction = new Transaction;
        $this->data['transaction_count'] = count($transaction->get_all());
        $item = new Item;
        //4 show Top five expensive items (5) Filter by ordering it first
        $this->data['items'] = $item->get_expensive_item();
        //3 show Total items number
        $this->data['items_count'] = count($item->get_all());
        //5 show Total users
        $user = new User;
        $this->data['users_count'] = count($user->get_all());
    }

}