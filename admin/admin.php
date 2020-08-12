<?php
defined('ABSPATH') or die();

require_once('classes/Rm199_Menu_Class.php');

function rm199_admin_scripts()
{
    // register CSS 
    wp_enqueue_style('rm199-admin-css', plugins_url() . '/recommendations-master/admin/css/rm199-admin.css');

    // register js 
    wp_enqueue_script('rm199-admin-js', plugins_url() . '/recommendations-master/admin/js/rm199.js');
}
add_action('admin_enqueue_scripts', 'rm199_admin_scripts');


// start menu functions 
add_action('admin_menu', array('Rm199_Menu_Class', 'createMenu'));


// start admin bar functions 
require_once('classes/Rm199_Adminbar_Class.php');
add_action('admin_bar_menu', array('Rm199_Adminbar_Class', 'add_to_adminbar'));


// start footer functions 
require_once('classes/Rm199_Footer_Class.php');
add_filter('admin_footer_text', array('Rm199_Footer_Class', 'add_to_footer'));



// // register post type 
// require_once('classes/Rm199_PostType_Class.php');
// add_action('init', array('Rm199PostTypesClass', 'rmTemplates'));
