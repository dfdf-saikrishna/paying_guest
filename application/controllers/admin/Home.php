<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller
{

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {

                $this->data['test'] = 'im test home.';

                $this->_render_admin_page('admin/home', $this->data);
        }

        public function logout()
        {
                $this->ion_auth->logout();
                redirect('admin/login', 'refresh');
        }

}
