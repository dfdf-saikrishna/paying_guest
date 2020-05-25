<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {

                $this->template['table'] = $this->_render_table_view('Users', 'users', array(
                    'first_name' => 'First Name',
                    'last_name'  => 'Last Name',
                    'username'   => 'Username',
                    'email'      => 'Email',
                    'created_on' => 'Created On',
                    'active'     => 'Acive',
                    'company'    => 'Company',
                    'phone'      => 'Phone',
                    'user_type'  => 'User Type'
                ));

                $this->_render_admin_page('admin/users', $this->template);
        }

}
