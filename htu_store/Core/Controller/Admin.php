<?php

namespace Core\Controller;

use Core\Base\Controller;


class Admin extends Controller
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
    }
    
}