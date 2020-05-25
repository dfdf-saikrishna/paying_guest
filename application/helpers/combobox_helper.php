<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('for_combo_box_addroom_HAS'))
{

        function for_combo_box_addroom_HAS()
        {

                return array(
                    'breakfast' => 'Break Fast',
                    'aircon'    => 'Aircon',
                    'gym'       => 'Gym',
                    'tvlcd'     => 'TV LCD',
                    'wifi'      => 'Wifi',
                );
        }

}
if (!function_exists('combo_number_public'))
{

        function combo_number_public($s, $e, $default, $value = NULL)
        {

                $array = array();
                $attr  = array('data' => $default, 'disabled' => '', 'value' => NULL);

                if (is_null($value) || $value == '')
                {
                        $attr['selected'] = '';
                }

                $array[-1] = $attr;

                for ($i = $s; $i <= $e; $i++)
                {
                        $array[$i] = $i;
                }

                return $array;
        }

}