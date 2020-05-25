<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends Public_Controller
{


        protected $session_names_;
        protected $data;
        protected $template;
        private $current_timestampp_;

        public function __construct()
        {
                parent::__construct();
                $this->session_names_      = array(
                    'room_id',
                    //check in                
                    'check_in',
                    'check_out',
                    'adult_count',
                    'child_count',
                    //personal info                
                    'firstname',
                    'lastname',
                    'email',
                    'phone',
                    //card info                
                    'card_number',
                    'card_cvv',
                    'card_expire_month',
                    'card_expire_year',
                    //
                    'payment_'
                );
                $this->load->model('Room_model');
                $this->load->library('form_validation');
                $this->load->helper(array('combobox', 'date'));
                $this->form_validation->set_error_delimiters(
                        '<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
		<i class="fa fa-question-circle"></i> ', ' </div>'
                );
                $this->data['message']     = '';
                $this->current_timestampp_ = time();
        }

        private function _render_reservation_template($template__, $data_)
        {
                $this->data['title_top']      = get_class();
                $this->data['title_top_desc'] = $this->config->item('reservation_page');
                $template['image_top_header'] = $this->_render_page('public/_templates/image_top_header', $this->data, TRUE);

                $template['form_template'] = $this->_render_page($template__, $data_, TRUE);
                $this->_render_public_page(get_class(), $this, 'public/reservation', $template);
        }

        private function booking_details()
        {
                $this->data['room']            = $this->Room_model->where(array('room_id' => $this->session->userdata('room_id')))->with_room_type()->as_object()->get();
                $this->data['booking_details'] = $this->_render_page('public/_templates/booking_details', $this->data, TRUE);
        }

        private function check_room_session()
        {
                if ($this->session->has_userdata('room_id'))
                {
                        if (!$this->check_room_availbility($this->session->userdata('room_id')))
                        {
                                show_error('Romm is unavailable or not exist.');
                        }
                }
                else
                {
                        show_error('Room is unavailable or not exist.');
                }
        }

        private function unset_sessions_()
        {
                $this->session->unset_userdata($this->session_names_);
        }

        private function validate_page_($page)
        {
                switch ($page)
                {
                        default :
                        case 1://select room
                                $this->unset_sessions_();
                                break;
                        case 2://check in

                                if (!$this->input->get('room-id'))
                                {
                                        show_error('Missing Parameter.');
                                }
                                $room_id_ = $this->input->get('room-id');


                                /*
                                 * check if room_id is exist, then check if available
                                 * 
                                 */
                                $tmp_room_obj = $this->Room_model->get($room_id_);

                                //exist
                                if ($tmp_room_obj)
                                {
                                        //avail
                                        if ($this->check_room_availbility($room_id_))
                                        {
                                                $this->data['room_id'] = $room_id_;
                                                $this->session->set_userdata('room_id', $room_id_);
                                        }
                                        else
                                        {
                                                show_error('Romm is unavailable or not exist.');
                                        }
                                }
                                else
                                {
                                        show_error('Romm is unavailable or not exist.');
                                }
                                break;
                        case 3://personal info
                                $this->check_room_session();

                                break;
                        case 4://payment
                                $this->check_room_session();
                                break;
                        case 5://thank you
                                $this->check_room_session();
                                break;
                }
        }

        #1 | select room

        private function check_room_availbility($r_id)
        {
                $this->load->model('Reservation_model');
                $reser_obj = $this->Reservation_model
                        ->where('room_id', $r_id)
                        ->as_object()
                        ->get_all();
                if ($reser_obj)
                {
                        foreach ($reser_obj as $v_)
                        {
                                $in  = $v_->reservation_check_in;
                                $out = $v_->reservation_check_out;

                                if (!($in < $this->current_timestampp_ && $out < $this->current_timestampp_))
                                {
                                        return FALSE;
                                }
                        }
                }

                return TRUE;
        }

        public function index()
        {
                $this->validate_page_(1);
                //select room 
                $room_obj = $this->Room_model->where(array(
                            'room_active' => TRUE,
                        ))
                        ->with_room_type('fields:room_type_name,room_type_active', 'where:1=1')
                        ->as_object()
                        ->get_all();

                $room = array();

                if ($room_obj)
                {
                        foreach ($room_obj as $v)
                        {
                                if ($this->check_room_availbility($v->room_id))
                                {
                                        $room[] = $v;
                                }
                        }
                }

                $this->data['rooms'] = (object) $room;
                $this->_render_reservation_template('public/_templates/reservation_select_room', $this->data);
        }

        #2

        public function check_in()
        {
                $this->validate_page_(2);
                $this->form_validation->set_rules(array(
                    array(
                        'field' => 'check_in',
                        'label' => 'Check In',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'check_out',
                        'label' => 'Check Out',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'adult_count',
                        'label' => 'Adult',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'child_count',
                        'label' => 'Child',
                        'rules' => 'required',
                    ),
                ));

                if ($this->form_validation->run())
                {
                        $this->session->set_userdata(array(
                            'check_in'    => $this->input->post('check_in', TRUE),
                            'check_out'   => $this->input->post('check_out', TRUE),
                            'adult_count' => $this->input->post('adult_count', TRUE),
                            'child_count' => $this->input->post('child_count', TRUE)
                        ));
                        redirect(base_url('reservation/personal-info'), 'refresh');
                }
                else
                {
                        $this->data['message'] = validation_errors();
                }

                $this->_render_reservation_template('public/_templates/reservation_check_in', $this->data);
        }

        #3

        public function personal_info()
        {
                $this->validate_page_(3);
                $this->form_validation->set_rules(array(
                    array(
                        'field' => 'firstname',
                        'label' => 'First Name',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'lastname',
                        'label' => 'Last Name',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'phone',
                        'label' => 'Phone',
                        'rules' => 'required',
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email',
                    ),
                    array(
                        'field' => 'personal_info_check_box',
                        'label' => 'terms and condition',
                        'rules' => 'required'
                    )
                ));

                if ($this->form_validation->run())
                {
                        $this->session->set_userdata(array(
                            'firstname' => $this->input->post('firstname', TRUE),
                            'lastname'  => $this->input->post('lastname', TRUE),
                            'email'     => $this->input->post('email', TRUE),
                            'phone'     => $this->input->post('phone', TRUE)
                        ));
                        redirect(base_url('reservation/payment'), 'refresh');
                }
                else
                {
                        $this->data['message'] = validation_errors();
                }

                $this->booking_details();

                $this->_render_reservation_template('public/_templates/reservation_personal_info', $this->data);
        }

        #4

        public function payment()
        {
                $rule = '';
                if ($this->input->post('payment__btn', TRUE))
                {
                        $rule = '|required';
                }
                $this->validate_page_(4);
                $this->form_validation->set_rules(array(
                    array(
                        'field' => 'card_number',
                        'label' => 'Card Number',
                        'rules' => 'trim' . $rule,
                    ),
                    array(
                        'field' => 'card_cvv',
                        'label' => 'CVV',
                        'rules' => 'trim' . $rule,
                    ),
                    array(
                        'field' => 'card_expire_month',
                        'label' => 'Expire',
                        'rules' => 'trim' . $rule,
                    ),
                    array(
                        'field' => 'card_expire_year',
                        'label' => 'Expire Year',
                        'rules' => 'trim' . $rule,
                    ),
                ));

                if ($this->form_validation->run())
                {
                        if ($this->input->post('payment_later__btn', TRUE))
                        {
                                $this->session->set_userdata(array(
                                    'card_number'       => $this->input->post('card_number', TRUE),
                                    'card_cvv'          => $this->input->post('card_cvv', TRUE),
                                    'card_expire_month' => $this->input->post('card_expire_month', TRUE),
                                    'card_expire_year'  => $this->input->post('card_expire_year', TRUE),
                                    'payment_'          => 'later'
                                ));
                        }
                        elseif ($this->input->post('payment__btn', TRUE))
                        {
                                $this->session->set_userdata(array(
                                    'card_number'       => $this->input->post('card_number', TRUE),
                                    'card_cvv'          => $this->input->post('card_cvv', TRUE),
                                    'card_expire_month' => $this->input->post('card_expire_month', TRUE),
                                    'card_expire_year'  => $this->input->post('card_expire_year', TRUE),
                                    'payment_'          => 'paid'
                                ));
                        }

                        redirect(base_url('reservation/thank-you'), 'refresh');
                }
                else
                {
                        $this->data['message'] = validation_errors();
                }
                $this->booking_details();

                $this->_render_reservation_template('public/_templates/reservation_payment', $this->data);
        }

        #5

        public function thank_you()
        {
                $this->validate_page_(5);
                $this->load->helper('string');
                $payment_id               = '#' . random_string('unique');
                $this->data['payment_id'] = $payment_id;
                $this->data['room']       = $this->Room_model->where(array('room_id' => $this->session->userdata('room_id')))->with_room_type()->as_object()->get();


                if ($this->save_reservation($payment_id))
                {
                        $this->data['result_'] = '<h3 class="mg-alert-payment">' . $this->config->item('success_reservation') . '</h3>';
                }
                else
                {
                        $this->data['result_'] = '<h3 class="mg-alert-payment">' . $this->config->item('failed_reservation') . '</h3>';
                }

                $this->_render_reservation_template('public/_templates/reservation_thank_you', $this->data);
                $this->unset_sessions_();
        }

        private function save_reservation($payment_id)
        {
                foreach ($this->session_names_ as $k => $v)
                {
                        if (!$this->session->has_userdata($v))
                        {
                                //when one of the session is none
                                log_message('error', 'session name: ' . $v . ' not exist');
                                show_error('Invalid process.');
                        }
                }
                $data_to_be_insert = array();
                foreach ($this->session_names_ as $k => $v)
                {
                        $v = (string) $v;

                        switch ($v)
                        {
                                case 'room_id':
                                        /**
                                         * this is foreign column in table
                                         */
                                        $data_to_be_insert[$v]                  = $this->session->userdata($v);
                                        break;
                                case 'check_in':
                                case 'check_out':
                                        /**
                                         * converting first for easy track reservation in the future using unix time
                                         */
                                        $data_to_be_insert['reservation_' . $v] = my_human_to_unix_conveter_($this->session->userdata($v));
                                        break;
                                default:
                                        /**
                                         * save normally in current table 
                                         */
                                        $data_to_be_insert['reservation_' . $v] = $this->session->userdata($v);
                                        break;
                        }
                }

                /**
                 * payment_id is not save in session so i just not include in the loop session names.
                 */
                $data_to_be_insert['reservation_payment_id'] = $payment_id;

                $this->load->model('Reservation_model');
                return $this->Reservation_model->insert($data_to_be_insert);
        }

        public function resources($bootstrap_dir = NULL)
        {
                if (is_null($bootstrap_dir))
                {
                        show_404();
                }


                $link_tag  = array(
                    'css/bootstrap.min.css',
                    'css/font-awesome.min.css',
                    'css/owl.carousel.css',
                    'css/owl.theme.css',
                    'css/owl.transitions.css',
                    'css/cs-select.css',
                    'css/bootstrap-datepicker3.min.css',
                    'css/freepik.hotels.css',
                    'css/nivo-lightbox.css',
                    'css/nivo-lightbox-theme.css',
                    'css/style.css'
                );
                $all_links = link_tag('https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Playfair+Display:400,400italic,700,700italic,900,900italic');
                $all_links .= comment_tag('bootstrap');
                foreach ($link_tag AS $K => $V)
                {
                        $all_links .= link_tag($bootstrap_dir . $V);
                }

                return $all_links .
                        comment_tag('HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries') .
                        comment_tag('WARNING: Respond.js doesn\'t work if you view the page via file://') .
                        '<!--[if lt IE 9]>' . "\n" .
                        script_tag($bootstrap_dir . 'js/html5shiv.min.js') .
                        script_tag($bootstrap_dir . 'js/respond.min.js') .
                        '<![endif]-->' . "\n" .
                        script_tag($bootstrap_dir . 'js/modernizr.custom.min.js');
        }

        public function resources_footer($bootstrap_dir = NULL)
        {
                if (is_null($bootstrap_dir))
                {
                        show_404();
                }


                $scripts = array(
                    'js/jquery.min.js',
                    'js/bootstrap.min.js',
                    'js/owl.carousel.min.js',
                    'js/jssor.slider.mini.js',
                    'js/classie.js',
                    'js/selectFx.js',
                    'js/bootstrap-datepicker.min.js',
                    'js/starrr.min.js',
                    'js/nivo-lightbox.min.js',
                    'js/jquery.shuffle.min.js',
                    'js/gmaps.min.js',
                    'js/jquery.parallax-1.1.3.js',
                    'js/script.js',
                );

                $links = '';
                foreach ($scripts as $k => $v)
                {
                        $links .= script_tag($bootstrap_dir . $v);
                }
                return $links . script_tag('http://maps.google.com/maps/api/js?sensor=true');
        }

}
