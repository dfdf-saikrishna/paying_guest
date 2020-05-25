<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Room_model');
        }

        public function index()
        {
                $this->data['rooms'] = $this->Room_model->where(array('room_active' => TRUE, 'room_best' => TRUE))->with_room_type()->as_object()->get_all();

                $this->template['slider']     = $this->_render_page('public/_templates/slider', $this->data, TRUE);
                $this->template['index_room'] = $this->_render_page('public/_templates/best_room', $this->data, TRUE);

                $this->_render_public_page(get_class(), $this, 'public/home', $this->template);
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
