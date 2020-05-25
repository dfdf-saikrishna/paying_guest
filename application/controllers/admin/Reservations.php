<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends Admin_Controller
{

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {
                $this->template['table'] = $this->_render_table_view('Reservations', 'reservations', array(
                    'payment_id'  => 'Payment ID',
                    'payment_'  => 'Payment',
                    'check_in'    => 'Check In',
                    'check_out'   => 'Check Out',
                    'room_number' => 'Room Number',
                    'room_type'   => 'Type',
                    'lastname'    => 'Last Name',
                    'firstname'   => 'First Name',
                    'email'       => 'Email',
                    'phone'       => 'Phone',
                    'adult_count' => 'Adult',
                    'child_count' => 'Child',
                ));

                $this->_render_admin_page('admin/reservations', $this->template);
        }

}
