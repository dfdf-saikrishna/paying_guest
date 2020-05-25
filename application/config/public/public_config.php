<?php

/*
  | ---------------------------------
  | public config
  | ---------------------------------
  |
  |
  |
  |
  |
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | ---------------------------------
  | pages
  | ---------------------------------
  |
  |
  |
  |
  |
 */

$config['accomodation_page'] = 'accomodation test';
$config['reservation_page']  = 'reservation test';
$config['contact_page']      = 'contact test';
/*
  | ---------------------------------
  | slider info
  | ---------------------------------
  |
  |
  |
  |
  |
 */
//1st
$config['first_sub_desc']    = '1st sub';
//2nd
$config['second_desc']       = '2nd decf';
$config['second_sub_desc']   = '2nd sub desc';
//3rd
$config['third_desc']        = '3rd dexc';
$config['third_sub_desc']    = '3rd sub dec';

/*
  | ---------------------------------
  | email reciever
  | ---------------------------------
  |
  | set this email who wans ro recieve of email from client (public web)
  |
  |
  |
 */

$config['email_reciever'] = 'emorickfighter@gmail.com';
/*
  | ---------------------------------
  | message submit reservation
  | ---------------------------------
  |
  |
  |
  |
  |
 */

$config['success_reservation'] = 'Thank you! Your booking is confirmed. Invoice Sent in your email address';
$config['failed_reservation']  = 'Failed to reserve you reservation, Please contact administrator.';


/*
  | ---------------------------------
  | information
  | ---------------------------------
  |
  | makikita ito sa footer at saka contact
  |
  |
  |
 */
$config['contact_long_description'] = 'Lorem Ipsum Dolor Lorem Ipsum Dolor Lorem Ipsum Dolor ';
$config['address']                  = 'Labason Zambo';
$config['contact_number']           = '+63912 345 678';
$config['email']                    = 'admin@admin.com';


/*
  | ---------------------------------
  | social media
  | ---------------------------------
  |
  |
  | footer part
  |
  | set FALSE if no need
  |
  |     sample | $config['footer_facebook'] = FALSE;
  | or
  |
  | set a url
  |     sample | $config['footer_facebook'] = 'https://web.facebook/user';
  |
 */
$config['footer_facebook']    = 'https://web.facebook.com/ClashRoyale/';
$config['footer_twitter']     = 'https://twitter.com/ClashofClans';
$config['footer_pinterest']   = FALSE;
$config['footer_google_plus'] = FALSE;
$config['footer_rss']         = FALSE;

# say something here
$config['footer_social_media'] = 'Tibi alienus possimus nomini legendus pariatur,';

/*
  | ---------------------------------
  | other
  | ---------------------------------
  |
  |
  |
  |
  |
 */

$config['current_year'] = '2017';
$config['view_folder']  = 'public';
