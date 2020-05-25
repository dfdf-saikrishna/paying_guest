<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{


        private $data;

        public function __construct()
        {
                parent::__construct();
                $this->load->library('ion_auth');
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters(
                        $this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth')
                );
        }

        private function set_data()
        {
                // the user is not logging in so display the login page
                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['identity'] = array('name'        => 'identity',
                    'class'       => 'form-control',
                    'autofocus'   => '',
                    'id'          => 'identity',
                    'value'       => $this->form_validation->set_value('identity'),
                    'placeholder' => 'Email'
                );

                $this->data['password'] = array('name'        => 'password',
                    'class'       => 'form-control',
                    'autofocus'   => '',
                    'id'          => 'password',
                    'type'        => 'password',
                    'placeholder' => 'Password'
                );
                $this->data['remember'] = array(
                    'name'    => 'remember',
                    'value'   => 'Remember Me',
                    'checked' => $this->form_validation->set_value('remember'),
                );
        }

        public function index()
        {
                $this->data['bootstrap_dir'] = $this->config->item('bootstrap_dir') . 'admin/';
                $this->data['title']         = $this->lang->line('login_heading');

                //validate form input
                $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
                $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

                if ($this->form_validation->run() == true)
                {
                        // check to see if the user is logging in
                        // check for "remember me"
                        $remember = (bool) $this->input->post('remember');

                        if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                        {
                                //if the login is successful
                                //redirect them back to the home page
                                $this->session->set_flashdata('message', $this->ion_auth->messages());

                                $user = $this->ion_auth->user()->row();
                                $this->session->set_userdata(array(
                                    'admin_fullname' => $user->last_name . ', ' . $user->first_name
                                ));
                                redirect('admin/home', 'refresh');
                        }
                        else
                        {
                                // if the login was un-successful
                                // redirect them back to the login page
                                $this->session->set_flashdata('message', $this->ion_auth->errors());
                                redirect('admin/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                        }
                }
                else
                {
                        $this->set_data();
                        $this->_render_page('admin/login', $this->data);
                }
        }

}
