<?php

namespace Core\Controller;

use Core\Base\Controller;
use Core\Helpers\Helper;
use Core\Model\User;

class Users extends Controller
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

        /**
         * Gets all users
         *
         * @return array
         */
        public function index()
        {
                $this->permissions(['Admin']);
                $this->view = 'users.index';
                $user = new User; 
                $this->data['users'] = $user->get_all();
                $this->data['users_count'] = count($user->get_all());
        }

        public function single()
        {
                $this->permissions(['Admin','Accountant','Seller','Procurement']);
                $this->view = 'users.single';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Display the HTML form for post creation
         *
         * @return void
         */
        public function create()
        {
                $this->permissions(['Admin']);
                $this->view = 'users.create';
        }

        /**
         * Creates new post
         *
         * 
         * @return void
         */
        public function store()
        {
                $this->permissions(['Admin']);
                $target_dir ="resources/images/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                if(isset($_FILES["fileToUpload"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                                var_dump(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file));
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                }
                                $_POST['photo'] = $_FILES["fileToUpload"]["name"];
                        } 
                }
                $user = new User();
                $permissions = null;
                switch ($_POST['role']) {
                        case 'Admin':
                                $permissions = 'Admin';
                                break;

                        case 'Accountant':
                                $permissions = 'Accountant';
                                break;
                        case 'Seller':
                                $permissions = 'Seller';
                                 break;
                        case 'Procurement':
                                $permissions = 'Procurement';
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] =$permissions;
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                $user->create($_POST);
                Helper::redirect('/users');
        }

        /**
         * Display the HTML form for post update
         *
         * @return void
         */
        public function edit()
        {
                $this->permissions(['Admin','Accountant','Seller','Procurement']);
                $this->view = 'users.edit';
                $user = new User();
                $this->data['user'] = $user->get_by_id($_GET['id']);
        }

        /**
         * Updates the post
         *
         * @return void
         */
        public function update()
        {
                $this->permissions(['Admin','Accountant','Seller','Procurement']);
                $user = new User();
                 //process permissions
                $permissions = null;
                switch ($_POST['role']) {
                        case 'Admin':
                                $permissions = 'Admin';
                                break;

                        case 'Accountant':
                                $permissions = 'Accountant';
                                break;
                        case 'Seller':
                                $permissions = 'Seller';
                                 break;
                        case 'Procurement':
                                $permissions = 'Procurement';
                                break;
                }
                unset($_POST['role']);
                $_POST['permissions'] =$permissions;
                $_POST['password'] = \password_hash($_POST['password'], \PASSWORD_DEFAULT);
                $user->update($_POST);
                Helper::redirect('/user?id=' . $_POST['id']);
        }

        /**
         * Delete the post
         *
         * @return void
         */
        public function delete()
        {
                $this->permissions(['Admin','Accountant','Seller','Procurement']);
                $user = new User();
                $user->delete($_GET['id']);
                Helper::redirect('/users');
        }
}
