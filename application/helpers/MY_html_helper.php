<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('script_tag'))
{

        /**
         * Script
         *
         * Generates an HTML script tag.
         *
         * @param	string	content
         * @return	string
         */
        function script_tag($src = '')
        {
                $link = '';

                if (!preg_match('#^([a-z]+:)?//#i', $src))
                {
                        $CI   = & get_instance();
                        $link .= $CI->config->slash_item('base_url') . $src;
                }
                else
                {
                        $link .= $src;
                }

                return '<script src="' . $link . '"></script>' . "\n";
        }

}

if (!function_exists('comment_tag'))
{

        /**
         * Comment
         *
         * Generates an HTML Comment tag.
         *
         * @param	string	content
         */
        function comment_tag($conntent = '')
        {

                return '<!-- ' . $conntent . ' -->' . "\n";
        }

}
