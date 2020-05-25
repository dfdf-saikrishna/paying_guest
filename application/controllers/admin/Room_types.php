<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Room_types extends Admin_Controller
{

        public function __construct()
        {
                parent::__construct();
        }

        public function index()
        {

                $this->template['table'] = $this->_render_table_view('Room Types', 'room-types', array(
                    'name'        => 'Name',
                    'description' => 'Description',
                    'active'      => 'Active',
                    'user'        => 'Admin'
                ));

                $this->_render_admin_page('admin/room_types', $this->template);
        }

        public function change_status($room_type_id = NULL)
        {
                check_valid_parameter($room_type_id);
                $this->load->model('Room_type_model');
                $obj = $this->Room_type_model->as_object()->get($room_type_id);
                $this->Room_type_model->update(array('room_type_active' => !$obj->room_type_active), $room_type_id);
                $this->index();
        }

}
