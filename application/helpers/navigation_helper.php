<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('public_navigation'))
{

        function public_navigation()
        {

                return array(
                    'home'           => 'Home',
                    'accommodations' => 'Accommodations',
                    'reservation'    => 'Reservation',
                    'contact-us'     => 'Contact Us',
                );
        }

}
if (!function_exists('admin_navigation'))
{

        function admin_navigation()
        {
                return array(
                    'home'        =>
                    array(
                        'label' => 'Home',
                        'desc'  => 'Dashboard Description',
                        'icon'  => 'dashboard-dial',
                    ),
                    'reservations' =>
                    array(
                        'label' => 'Reservations',
                        'desc'  => 'Reservation Description',
                        'icon'  => 'app-window-with-content',
                    ),
                    'rooms'       =>
                    array(
                        'label' => 'Rooms',
                        'desc'  => 'Rooms Description',
                        'icon'  => 'app-window-with-content',
                    ),
                    'room_types'  =>
                    array(
                        'label' => 'Room Types',
                        'desc'  => 'Room Types Description',
                        'icon'  => 'app-window-with-content',
                    ),
                    'users'       =>
                    array(
                        'label' => 'Users',
                        'desc'  => 'Users Description',
                        'icon'  => 'hourglass',
                    ),
                    //sub menu
                    'add'         =>
                    array(
                        'label' => 'Add Data',
                        'icon'  => 'chevron-down',
                        'sub'   =>
                        array(
                            'add-room'      =>
                            array(
                                'label' => 'Add Room',
                                'desc'  => 'Add Room Description',
                                'icon'  => 'pencil',
                            ),
                            'add-room-type' =>
                            array(
                                'label' => 'Add Room Type',
                                'desc'  => 'Add Room Type Description',
                                'icon'  => 'pencil',
                            ),
                        ),
                    ),
                );
        }

}