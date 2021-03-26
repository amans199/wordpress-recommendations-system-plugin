<?php
/*
Plugin Name:    Recommendations Master
Plugin URI:     https:/corsorr.com
Description:    Manage a very advanced recommendations system for posts, products, materials and any other type of content in your wordpress site
Version:        0.0.1
Author:         Ahmed Mansour
Author URI:     https://www.linkedin.com/in/amans199/
*/
// todo : change below code
/**
 * Classic Editor
 *
 * Plugin Name: Classic Editor
 * Plugin URI:  https://wordpress.org/plugins/classic-editor/
 * Description: Enables the WordPress classic editor and the old-style Edit Post screen with TinyMCE, Meta Boxes, etc. Supports the older plugins that extend this screen.
 * Version:     1.6
 * Author:      WordPress Contributors
 * Author URI:  https://github.com/WordPress/classic-editor/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: classic-editor
 * Domain Path: /languages
 * Requires at least: 4.9
 * Requires PHP: 5.2.4
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if (!defined('ABSPATH')) {
    die('Invalid request.');
}


if (!class_exists('rm199')) :
    final class rm199
    {
        private static $instance = null;

        private function __construct()
        {
            $this->initializeHooks();
            $this->setupDatabase();
            add_action('wp_enqueue_scripts', 'rm199_public_scripts');
            define('RM199_PATH', plugin_dir_path(__FILE__));
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
            add_action('wp_login', array('Rm199Database', 'setup'), 10, 2);
            require_once('uninstall.php');
            register_uninstall_hook(__FILE__, array('Rm199Uninstall', 'uninstall'));
        }
    }
endif;

rm199::getInstance();
