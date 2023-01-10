<?php

namespace Core\Base;
use Core\Helpers\Helper;
use Core\Model\User;



abstract class Controller
{
    abstract public function render();

    protected $view = null;
    protected $data = array();

    protected function view()
    {
        new View($this->view, $this->data);
    }

    protected function auth()
    {
        
        if (!isset($_SESSION['user'])) { 
            Helper::redirect('/login');
            exit;
        }
        
    }

    /**
     * Check if the user has the assigned permissions.
     *
     * @param array $permissions_set
     * @return void
     */
    protected function permissions(array $permissions_set)
    {
        $this->auth();

        // Collect user permissions from the DB
        $user = new User;
        $assigned_permissions = $user->get_permissions();
        // check if the user has all the permissions_set
        if (!array_intersect($permissions_set, $assigned_permissions)) {
            //  no element of permissions_set is present in assigned_permissions At least
            Helper::redirect('/');
        } 
        else{
            return true;
        }
    
        // if any of the permission sets are not assigned to the user, redirect to the dashboard
    }

    /**
     * Change the header view. check View.php line 18
     *
     * @param boolean $switch
     * @return void
     */
    protected function admin_view(bool $switch): void
    {
        // check if the session user is existed
        // if not, do noting
        // if existed, check if $switch is true
        // if true, $_SESSION['user']['is_admin_view'] = true
        // if false, $_SESSION['user']['is_admin_view'] = false

        if (isset($_SESSION['user']['is_admin_view'])) {
            $_SESSION['user']['is_admin_view'] = $switch;
        }
    }

}