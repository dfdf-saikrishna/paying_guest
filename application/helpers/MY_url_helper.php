<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('check_valid_parameter'))
{

        function check_valid_parameter($id = NULL)
        {

                if (is_null($id))
                {
                        show_error('invalid parameter');
                }
        }

}