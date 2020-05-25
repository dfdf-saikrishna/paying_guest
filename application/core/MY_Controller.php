<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

        function __construct()
        {
                parent::__construct();
        }

        public function _render_page($view, $data = null, $returnhtml = false)
        {
                $this->viewdata = (empty($data)) ? $this->data : $data;
                if ($returnhtml)
                {
                        return $this->load->view($view, $data, TRUE);
                }
                else
                {
                        $this->load->view($view, $data);
                }
        }

}

class Admin_Controller extends MY_Controller
{

        function __construct()
        {
                parent::__construct();
                $this->load->library('ion_auth');
                // $this->lang->load('auth');
                if (!$this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
                {
                        redirect('admin/login', 'refresh');
                }
                $this->config->load('admin/admin_config');
        }

        public function _render_json_view($array)
        {
                $this->_render_page('admin/_templates/api', array(
                    'msg' => json_encode($array),
                ));
        }

        /**
         * to load view page
         * @param string $caption caption of table
         * @param string $controller where to get data
         * @param array $columns key-tdata key, value = title header of table columns
         */
        public function _render_table_view($caption, $controller, $columns)
        {
                return $this->_render_page('admin/_templates/table', array(
                            'caption'    => $caption,
                            'columns'    => $columns,
                            'controller' => $controller,
                                ), TRUE);
        }

        /**
         * render views at one call
         * 
         * @param view $content current view page to be render
         * @param data $data data to be render also in current view 
         * @return null if content is missing
         */
        public function _render_admin_page($content, $data = NULL)
        {
                if (!$content)
                {
                        return NULL;
                }
                else
                {
                        $data['bootstrap_dir'] = $this->config->item('bootstrap_dir') . 'admin/';
                        $data['navigations']   = admin_navigation();

                        $this->template['header']  = $this->_render_page('admin/_templates/header', $data, TRUE);
                        $this->template['content'] = $this->_render_page($content, $data, TRUE);
                        $this->template['footer']  = $this->_render_page('admin/_templates/footer', $data, TRUE);

                        $this->_render_page('template', $this->template);
                }
        }

}

class Public_Controller extends MY_Controller
{


        protected $data;

        function __construct()
        {
                parent::__construct();
                $this->load->config('public/public_config');
                $this->data['bootstrap_dir'] = $this->config->item('bootstrap_dir') . 'public/';
                $this->data['navigations']   = public_navigation();
        }

        /**
         * render views at one call
         * 
         * @param view $content current view page to be render
         * @param data $data data to be render also in current view 
         * @return null if content is missing
         */
        public function _render_public_page($title, $controller, $content, $data = NULL)
        {
                if (!$content)
                {
                        return NULL;
                }
                else
                {
                        $data['title']      = $title;
                        $data['controller'] = $controller;

                        $this->template['header']  = $this->_render_page('public/_templates/header', $data, TRUE);
                        $this->template['content'] = $this->_render_page($content, $data, TRUE);
                        $this->template['footer']  = $this->_render_page('public/_templates/footer', $data, TRUE);

                        $this->_render_page('template', $this->template);
                }
        }

}
