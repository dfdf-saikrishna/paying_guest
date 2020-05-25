<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Room_model extends MY_Model
{

        public function __construct()
        {
                $this->table            = 'room';
                $this->primary_key      = 'room_id';
                //   $this->soft_deletes = true;
                // $this->has_one['details'] = 'User_model';
                # $this->has_one['user'] = array('User_model', 'user_id', 'id');
                $this->has_one['users'] = array(
                    'foreign_model' => 'User_model',
                    'foreign_table' => 'users',
                    'foreign_key'   => 'id',
                    'local_key'     => 'user_id'
                );

                $this->has_one['room_type'] = array(
                    'foreign_model' => 'Room_type_model',
                    'foreign_table' => 'room_type',
                    'foreign_key'   => 'room_type_id',
                    'local_key'     => 'room_type_id'
                );
                
                $this->has_one['reservation'] = array(
                    'foreign_model' => 'Reservation_model',
                    'foreign_table' => 'reservation',
                    'foreign_key'   => 'room_id',
                    'local_key'     => 'room_id'
                );
                // $this->has_one['details'] = array('local_key' => 'user_id', 'foreign_key' => 'user_id', 'foreign_model' => 'User_model');
                // $this->has_many['posts'] = 'Post_model';
                ///------------------------
                // you can set the database connection that you want to use for this particular model, by passing the group connection name or a config array. By default will use the default connection
                //  $this->_database_connection = 'special_connection';
                // you can disable the use of timestamps. This way, MY_Model won't try to set a created_at and updated_at value on create methods. Also, if you pass it an array as calue, it tells MY_Model, that the first element is a created_at field type, the second element is a updated_at field type (and the third element is a deleted_at field type if $this->soft_deletes is set to TRUE)
                $this->timestamps           = TRUE;

                // you can enable (TRUE) or disable (FALSE) the "soft delete" on records. Default is FALSE, which means that when you delete a row, that one is gone forever
                $this->soft_deletes = FALSE;

                // you can set how the model returns you the result: as 'array' or as 'object'. the default value is 'object'
                $this->return_as = 'object' | 'array';

                // you can set relationships between tables
                //$this->has_one['...'] allows establishing ONE TO ONE or more ONE TO ONE relationship(s) between models/tables
                #  $this->has_one['phone'] = 'Phone_model';
                // or $this->has_one['phone'] = array('Phone_model','foreign_key','local_key');
                #  $this->has_one['address'] = 'Address_model';
                // or $this->has_one['address'] = array('Address_model','foreign_key','another_local_key');
                // $this->has_many[''...] allows establishing ONE TO MANY or more ONE TO MANY relationship(s) between models/tables
                # $this->has_many['posts'] = 'Post_model';
                // or $this->has_many['posts'] = array('Posts_model','foreign_key','another_local_key');
                // $this->has_many_pivot['...'] allows establishing MANY TO MANY or more MANY TO MANY relationship(s) between models/tables with the use of a PIVOT TABLE
                #  $this->has_many_pivot['posts'] = 'Post_model';
                // or $this->has_many_pivot['posts'] = array('Posts_model','foreign_primary_key','local_primary_key');
                // ATTENTION! The pivot table name must be composed of the two table names separated by "_" the table names having to to be alphabetically ordered (NOT users_posts, but posts_users).
                // Also the pivot table must contain as identifying columns the columns named by convention as follows: table_name_singular + _ + foreign_table_primary_key.
                // For example: considering that a post can have multiple authors, a pivot table that connects two tables (users and posts) must be named posts_users and must have post_id and user_id as identifying columns for the posts.id and users.id tables.
                // you can also use caching. If you want to use the set_cache('...') method, but you want to change the way the caching is made you can use the following properties:

                $this->cache_driver = 'file';
                //By default, MY_Model uses the files (CodeIgniter's file driver) to cache result. If you want to change the way it stores the cache, you can change the $cache_driver property to whatever CodeIgniter cache driver you want to use.

                $this->cache_prefix = 'mm';
                //With $cache_prefix, you can prefix the name of the caches. By default any cache made by MY_Model starts with 'mm' + _ + "name chosen for cache"

                parent::__construct();
        }

}
