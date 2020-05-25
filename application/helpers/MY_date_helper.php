<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('convert_date_'))
{

        /**
         * 
         * @param string $date | 01/28/2015
         * @return string formated date | 28 Jan, 2015
         */
        function convert_date_($date)
        {
                $CI                       = get_instance();
                $CI->load->library('Calendar');
                $CI->calendar->month_type = 'short';

                list($m_, $d_, $y_) = explode('/', $date);

                return $d_ . ' ' . $CI->calendar->get_month_name($m_) . ', ' . $y_;
        }

}
if (!function_exists('my_human_to_unix_conveter_'))
{

        /**
         * 
         * @param string $date || 01/28/2015
         * @return string unix time
         */
        function my_human_to_unix_conveter_($date)
        {
                list($m_, $d_, $y_) = explode('/', $date);

                /**
                 * date sample value: 2017-01-26
                 */
                $date_to_be_convert = $y_ . '-' . $m_ . '-' . $d_;


                /**
                 * sample value: 06:30 pm
                 */
                $current_time = mdate('%h:%i %a', time());


                /**
                 * sample value: 2017-01-26 06:16 PM
                 */
                $output = $date_to_be_convert . ' ' . $current_time;

                return human_to_unix($output);
        }

}if (!function_exists('my_unix_to_human_conveter_'))
{

        /**
         * 
         * @param string $unix || 1485427200
         * @return string human time | 28 Jan, 2015
         */
        function my_unix_to_human_conveter_($unix)
        {
                /**
                 * sample value: 2017-01-26 06:16 PM
                 */
                $human_time = unix_to_human($unix);

                list($date_, $time_, $am_pm_) = explode(' ', $human_time);

                list($y_, $m_, $d_) = explode('-', $date_);


                /**
                 * sample value to convert: 01/28/2015
                 */
                return convert_date_($m_ . '/' . $d_ . '/' . $y_);
        }

}
if (!function_exists('different_days_'))
{

        /**
         * 
         * @param string $date_start | 01/28/2015
         * @param string $date_end | 01/28/2015
         * @return int different day(s)
         */
        function different_days_($date_start, $date_end)
        {
                $CI = get_instance();
                $CI->load->library('Calendar');

                list($m_1, $d_1, $y_1) = explode('/', $date_start);
                list($m_2, $d_2, $y_2) = explode('/', $date_end);


                if ($m_1 === $m_2 && $y_1 === $y_2)
                {

                        return (int) $d_2 - $d_1;
                }
                else if ($m_1 < $m_2 && $y_1 === $y_2)
                {

                        $days_in_betweens = 0;
                        $days_in_month_1  = $CI->calendar->get_total_days($m_1, $y_1);

                        for ($i = ($m_1 + 1); $i < $m_2; $i++)
                        {
                                $days_in_betweens += $CI->calendar->get_total_days($i, $y_1);
                        }

                        $start = $days_in_month_1 - $d_1;
                        return (int) $start + $d_2 + $days_in_betweens;
                }
        }

}