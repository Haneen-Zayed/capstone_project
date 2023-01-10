<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Base\View;
use Core\Helpers\Helper;
use Core\Helpers\Tests;
use Core\Model\Item;


class Items extends Controller
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
     * Gets all items
     *
     * @return array
     */
    public function index()
    {
        $this->permissions(['Admin','Procurement']);
        $this->view = 'items.index';
        $item = new Item;
        $this->data['items'] = $item->get_all();
        $this->data['items_count'] = count($item->get_all());
    }

    public function single()
    {

        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Procurement']);
        $this->view = 'items.single';
        $item = new Item();
        $this->data['item'] = $item->get_by_id($_GET['id']);
    }

    /**
     * Display the HTML form for item creation
     *
     * @return void
     */
    public function create()
    {
        $this->permissions(['Admin','Procurement']);
        $this->view = 'items.create';
    }

    /**
     * Creates new item
     *
     * @return void
     */
    public function store()
    {
        $this->permissions(['Admin','Procurement']);
        $item = new Item();
        $item->create($_POST);
        Helper::redirect('/items');
    }

    /**
     * Display the HTML form for item update
     *
     * @return void
     */
    public function edit()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Procurement']);
        $this->view = 'items.edit';
        $item = new Item();
        $selected_item = $item->get_by_id($_GET['id']);
        $this->data['item'] = $selected_item;
    }

    /**
     * Updates the item
     *
     * @return void
     */
    public function update()
    {
        $this->permissions(['Admin','Procurement']);
        $item = new Item();
        $item->update($_POST);
        Helper::redirect('/item?id=' . $_POST['id']);
    }

    /**
     * Delete the item
     *
     * @return void
     */
    public function delete()
    {
        self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
        $this->permissions(['Admin','Procurement']);
        $item = new Item();
        $item->delete($_GET['id']);
        Helper::redirect('/items');
    }
}
