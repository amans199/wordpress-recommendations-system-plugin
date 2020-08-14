<?php
/*
Plugin Name:    Recommendations Master
Plugin URI:     https:/corsorr.com
Description:    Manage a very advanced recommendations system for posts, products, materials and any other type of content in your wordpress site
Version:        0.0.1
Author:         Ahmed Mansour
Author URI:     https://www.linkedin.com/in/amans199/
*/


//  this line of code is to prevent usage without WP core
defined('ABSPATH') or die();

if (!class_exists('rm199')) :
    final class rm199
    {
        private static $instance = null;

        // start rm199 constructor 
        private function __construct()
        {
            $this->initializeHooks();
            $this->setupDatabase();
        }
        public static function getInstance()
        {
            if (is_null(self::$instance))
                self::$instance = new self();

            return self::$instance;
        }
        private function initializeHooks()
        {
            if (is_admin()) {
                require_once('admin/admin.php');
            }
            require_once('public/public.php');
        }
        private function setupDatabase()
        {
            require_once('admin/classes/Rm199_Database.php');
            register_activation_hook(__FILE__, array('Rm199Database', 'setup'));
            add_action('wp_login', array('Rm199Database', 'createDatabaseEntry'), 10, 2);
            // require_once('uninstall.php');
            // register_uninstall_hook(__FILE__, array('Rm199Uninstall', 'uninstall'));
        }
    }
endif;

rm199::getInstance();
