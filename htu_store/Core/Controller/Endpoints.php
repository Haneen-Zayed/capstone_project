<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Tests;
use Core\Model\Item;
use Core\Model\Transaction;
use Core\Model\Usertransaction;
use Exception;

class Endpoints extends Controller
{
        
        use Tests;
        protected $request_body;
        protected $http_code = 200;
      
        protected $response_schema = array(
                "success" => true, // to provide the response status.
                "message_code" => "", // to provide message code for the front-end developer for a better error handling
                "body" => []
        );

        function __construct()
        {      
                $this->request_body = (array) json_decode(file_get_contents("php://input"));
        }

        public function render()
        {
                header("Content-Type: application/json"); // changes the header information
                http_response_code($this->http_code); // set the HTTP Code for the response
                echo json_encode($this->response_schema); // convert the data to json format
        }

        function item()
        {
                self::check_if_exists(isset($_GET['id']), "Please make sure the id is exists");
                try {
                        $id = $_GET['id'];
                        $item = new Item;
                        $item = $item->get_by_id($id);
                        if (empty($item)) {
                                throw new \Exception('No item were found!');
                        }
                        $this->response_schema['body'] = $item;
                        $this->response_schema['message_code'] = "items_collected_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['success'] = false;
                        $this->response_schema['message_code'] = $error->getMessage();
                        $this->http_code = 404;
                }
        }

        // Function for ajax api to create a new transaction
        function create()
        {       
                self::check_if_empty($this->request_body);
                try {
                        $transaction = new Transaction;
                        $transaction->create($this->request_body);
                        $this->response_schema['message_code'] = "transaction_created_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "transaction_was_not_created";
                        $this->http_code = 421;
                }
        }

        // Function for ajax api to decrease stock available quantity
        function dec_quantity() {
        
                self::check_if_exists(isset($_POST['item_id']), "Please make sure the id is exists");
                try {
                        $item = new Item();
                        $one_item = $item->get_by_id($_POST['item_id']);
                        $one_item->stock = $one_item->stock - $_POST['quantity'];
                        $item->update((array)$one_item);

                        $transaction = new Transaction;
                        unset($_POST['quantity']);
                        $last_id_transaction= $transaction->last_id_transaction();
                        $_POST['transaction_id']= $last_id_transaction->id;
                        $usertransaction = new Usertransaction();
                        $usertransaction->create($_POST);

                        $this->response_schema['message_code'] = "quantity_updated_successfuly";
                } catch (\Exception $error) {
                        $this->response_schema['message_code'] = "quantity_was_not_updated";
                        $this->http_code = 421;
                }
        }
       
        
}
