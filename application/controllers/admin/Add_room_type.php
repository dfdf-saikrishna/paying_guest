<?php

defined('BASEPATH') or exit('invalid');

class Add_room_type extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters(
                        $this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth')
                );
        }

        public function index()
        {
                $this->form_validation->set_rules(array(
                    array(
                        'label' => 'Name',
                        'field' => 'name',
                        'rules' => 'required'
                    ),
                    array(
                        'label' => 'Description',
                        'field' => 'description',
                        'rules' => 'required'
                    ),
                ));
                if (!$this->form_validation->run())
                {
                        $my_form = array(
                            'caption'      => 'Add Room Type',
                            'action'       => current_url(),
                            'button_name'  => 'save',
                            'button_title' => 'Add Room Type'
                        );

                        $my_inputs = array(
                            'aa' =>
                            array(
                                'size' => '12',
                                'attr' =>
                                array(
                                    'name'        => array(
                                        'title' => 'Name',
                                        'type'  => 'text',
                                        'value' => $this->form_validation->set_value('name'),
                                    ),
                                    'description' => array(
                                        'title' => 'Description',
                                        'type'  => 'text',
                                        'value' => $this->form_validation->set_value('description'),
                                    ),
                                )
                            ),
                        );

                        $this->template['form'] = $this->_render_page('admin/_templates/form', array(
                            'my_form'         => $my_form,
                            'my_forms_inputs' => $my_inputs,
                                ), TRUE);
                }
                else
                {
                        $this->load->model('Room_type_model');
                        $tmp                      = $this->Room_type_model->insert(array(
                            'room_type_name'        => $this->input->post('name', TRUE),
                            'room_type_description' => $this->input->post('description', TRUE),
                            'user_id'               => $this->ion_auth->user()->row()->id
                        ));
                        $this->template['result'] = ($tmp) ? 'Added' : 'Failed';
                }
                $this->_render_admin_page('admin/add_room_type', $this->template);
        }

}
