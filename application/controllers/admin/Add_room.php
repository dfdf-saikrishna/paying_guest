<?php

defined('BASEPATH') or exit('invalid');

class Add_room extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();
                $this->load->model('Room_type_model');
                $this->load->helper('combobox');
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters(
                        $this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth')
                );
        }

        public function index()
        {
                $this->template['upload_message'] = '';
                $config                           = array(
                    'encrypt_name'  => TRUE,
                    'upload_path'   => 'assets/images/rooms',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => "1000KB",
                    'max_height'    => "768",
                    'max_width'     => "1024"
                );
                $this->load->library('upload', $config);
                $this->form_validation->set_rules(array(
                    array(
                        'label' => 'Number',
                        'field' => 'number',
                        'rules' => 'required|is_natural_no_zero|is_unique[room.room_number]'
                    ),
                    array(
                        'label' => 'Description',
                        'field' => 'description',
                        'rules' => 'required'
                    ),
                    array(
                        'label' => 'Price',
                        'field' => 'price',
                        'rules' => 'required|decimal'
                    ),
                    array(
                        'label' => 'Type',
                        'field' => 'type',
                        'rules' => 'required|combo_box_check_id'
                    ),
                    array(
                        'label' => 'Bed Count',
                        'field' => 'bed',
                        'rules' => 'required|is_natural_no_zero'
                    ),
                ));
                if (empty($_FILES['upload_image_file']['name']))
                {
                        $this->form_validation->set_rules('upload_image_file', 'Image', 'required');
                }
                $check_file_uplaod = FALSE;
                $uploaded          = FALSE;
                $run               = $this->form_validation->run();
                if (isset($_FILES['upload_image_file']['error']) && $_FILES['upload_image_file']['error'] != 4)
                {
                        $check_file_uplaod = TRUE;
                        if ($run)
                        {
                                $uploaded                         = ($this->upload->do_upload('upload_image_file'));
                                $this->template['upload_message'] = ($uploaded) ? 'uploaded' : $this->upload->display_errors();
                        }
                }
                if (!$run || ($check_file_uplaod && !$uploaded))
                {
                        $my_form = array(
                            'upload'       => TRUE,
                            'caption'      => 'Add Room',
                            'action'       => current_url(),
                            'button_name'  => 'save',
                            'button_title' => 'Add Room'
                        );

                        $my_inputs = array(
                            'aa' =>
                            array(
                                'size' => '6',
                                'attr' =>
                                array(
                                    'number'      => array(
                                        'title' => 'Number',
                                        'type'  => 'text',
                                        'value' => $this->form_validation->set_value('number'),
                                    ),
                                    'description' => array(
                                        'title' => 'Description',
                                        'type'  => 'text',
                                        'value' => $this->form_validation->set_value('description'),
                                    ),
                                    'price'       => array(
                                        'title' => 'Price',
                                        'type'  => 'text',
                                        'value' => $this->form_validation->set_value('price'),
                                    ),
                                    'type'        => array(
                                        'title'       => 'Type',
                                        'type'        => 'combo',
                                        'value'       => NULL,
                                        'combo_value' => $this->Room_type_model->as_dropdown('room_type_name')->get_all()
                                    )
                                )
                            ),
                            'bb' =>
                            array(
                                'size' => '6',
                                'attr' =>
                                array(
                                    'bed'               => array(
                                        'title' => 'Bed Count',
                                        'type'  => 'text',
                                        'value' => NULL,
                                        'value' => $this->form_validation->set_value('bed'),
                                    ),
                                    'has'               => array(
                                        'title'          => 'Has',
                                        'type'           => 'checkbox',
                                        'value'          => NULL,
                                        'checkbox_value' => for_combo_box_addroom_HAS(),
                                    ),
                                    'upload_image_file' => array(
                                        'title' => 'Image',
                                        'type'  => 'file',
                                        'value' => '',
                                    )
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
                        $this->load->model('Room_model');
                        $data_to_be_add = array(
                            'room_number'      => $this->input->post('number', TRUE),
                            'room_description' => $this->input->post('description', TRUE),
                            'room_price'       => $this->input->post('price', TRUE),
                            'room_type_id'     => $this->input->post('type', TRUE),
                            'room_bed_count'   => $this->input->post('bed', TRUE),
                            'user_id'          => $this->ion_auth->user()->row()->id,
                            'room_image'       => $this->upload->data()['file_name']
                        );
                        foreach (for_combo_box_addroom_HAS() as $k => $v)
                        {
                                $data_to_be_add['room_has_' . $k] = ($this->input->post($k, TRUE) == $k) ? TRUE : FALSE;
                        }
                        $tmp                      = $this->Room_model->insert($data_to_be_add);
                        $this->template['result'] = ($tmp) ? 'Added ' : 'Failed ';
                }
                $this->_render_admin_page('admin/add_room', $this->template);
        }

}
