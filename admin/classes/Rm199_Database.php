<?php
// if (!defined('ABSPATH')) {
//     exit;
// }
// class Rm199Database
// {
//     public static function setup()
//     {
//         global $wpdb;
//         $table_name = $wpdb->prefix . 'rm199_db';
//         $charset_collate = $wpdb->get_charset_collate();
//         $sql = "CREATE TABLE $table_name (
//             id int(11) NOT NULL AUTO_INCREMENT,
//             user_id int(11) NOT NULL,
//             user_name text NOT NULL,
//             last_login datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
//             PRIMARY KEY (id)
//             ) $charset_collate";
//         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//         dbDelta($sql);
//     }

//     public static function createDatabaseEntry($user, $current_user)
//     {
//         global $wpdb;
//         $name = $current_user->user_login;
//         $id = $current_user->ID;
//         $table_name = $wpdb->prefix . 'rm199_db';

//         $wpdb->insert(
//             $table_name,
//             array(
//                 'user_id' => $id,
//                 'user_name' => $name,
//                 'last_login' => current_time('mysql')
//             )
//         );
//     }
// }
