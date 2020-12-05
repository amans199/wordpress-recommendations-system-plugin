<?php
defined('ABSPATH') or die();

// =====================================
// Menu pages
// =====================================
require_once('classes/Rm199_Menu_Class.php');
add_action('admin_menu', array('Rm199_Menu_Class', 'createMenu'));


// =====================================
// Main Scripts used in Admin
// =====================================
function rm199_admin_scripts()
{
    // register CSS 
    wp_enqueue_style('rm199-admin-css', plugins_url() . '/recommendations-master/admin/css/rm199-admin.css');

    // register js 
    wp_enqueue_script('rm199-admin-js', plugins_url() . '/recommendations-master/admin/js/rm199.js');
}
add_action('admin_enqueue_scripts', 'rm199_admin_scripts');


// =====================================
// ADD new shortcode  
// =====================================
function add_new_shortcode_handler()
{
    $plugin_url  = plugins_url() . '/recommendations-master';     // Used to keep our Template Directory URL
    $ajax_url   = admin_url('admin-ajax.php');        // Localized AJAX URL
    // Register Our Script for Localization
    wp_register_script(
        'add_new_shortcode_um_cb',
        "{$plugin_url}/admin/js/add_new_shortcode_handler.js",
        array('jquery'),
        '1.0',
        true
    );


    // Localize Our Script so we can use `ajax_url`
    wp_localize_script(
        'add_new_shortcode_um_cb',
        'add_new_shortcode_rm199Obj',
        array(
            'ajax_url' => $ajax_url,
            'security'  => wp_create_nonce('rm199'),
            'siteurl'  => get_site_url(),
            'user' => get_current_user_id(),
            'rm199_code' => uniqid(),
        )
    );

    // Finally enqueue our script
    wp_enqueue_script('add_new_shortcode_um_cb');
}
add_action('admin_enqueue_scripts', 'add_new_shortcode_handler');

function add_new_shortcode_handler_callback()
{
    if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {
        header('HTTP/1.1 400 Empty POST Values');
        echo 'Could Not Verify POST Values.';
        exit;
    }
    $user_id        = get_current_user_id();
    if (!current_user_can('manage_options')) {
        exit;
    }
    global $wpdb;
    $rm199_shortcode_content = json_encode([
        "title" => $_POST['shortcode_content']['title'],
        "description" => $_POST['shortcode_content']['description'],
        "can_user_select_keywords" => $_POST['shortcode_content']['can_user_select_keywords'],
        "show_only_for_loggedin_users" => $_POST['shortcode_content']['show_only_for_loggedin_users'],
        "number_of_items" => $_POST['shortcode_content']['number_of_items'],
        "post_types" => $_POST['shortcode_content']['post_types'],
        "categories" => $_POST['shortcode_content']['categories'],
        "tags" => $_POST['shortcode_content']['tags'],
        "main_color" => $_POST['shortcode_content']['main_color'],
        "secondary_color" => $_POST['shortcode_content']['secondary_color'],
        "text_color" => $_POST['shortcode_content']['text_color'],
        "template" => $_POST['shortcode_content']['template'],
        'code' => $_POST['shortcode_uniqid']
    ]);

    $table_name = $wpdb->prefix . 'rm199_shortcodes';
    $current_user = wp_get_current_user();
    if ($_POST['edit_mode_id'] != '') {
        $wpdb->update(
            $table_name,
            array(
                'code' =>  $_POST['shortcode_uniqid'],
                'options' => $rm199_shortcode_content,
                'custom_styles' => $_POST['rm199_custom_css'],
                'created_by' => $current_user->ID,
                'created_in' =>  $_POST['created_in']
            ),
            array('id' =>  $_POST['edit_mode_id'])
        );
    } else {
        $wpdb->insert(
            $table_name,
            array(
                'code' =>  $_POST['shortcode_uniqid'],
                'options' =>  $rm199_shortcode_content,
                'custom_styles' => $_POST['rm199_custom_css'],
                'created_by' => $current_user->ID,
                'created_in' => $_POST['created_in']
            )
        );
    }
    exit;
}
add_action('wp_ajax_nopriv_add_new_shortcode_cb', 'add_new_shortcode_handler_callback');
add_action('wp_ajax_add_new_shortcode_cb', 'add_new_shortcode_handler_callback');


// =====================================
// DELETE shortcode  
// =====================================

function rm199_delete_shortcode()
{
    $plugin_url  = plugins_url() . '/recommendations-master';
    $ajax_url   = admin_url('admin-ajax.php');
    wp_register_script(
        'delete_shortcode_rm199',
        "{$plugin_url}/admin/js/delete_shortcode_rm199.js",
        array('jquery'),
        '1.0',
        true
    );
    wp_localize_script(
        'delete_shortcode_rm199',
        'rm199Obj',
        array(
            'ajax_url' => $ajax_url,
            'security'  => wp_create_nonce('rm199'),
            'siteurl'  => get_site_url(),
            'user' => get_current_user_id()
        )
    );
    wp_enqueue_script('delete_shortcode_rm199');
}
add_action('admin_enqueue_scripts', 'rm199_delete_shortcode');

function delete_shortcode_rm199_callback()
{
    if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {
        header('HTTP/1.1 400 Empty POST Values');
        echo 'Could Not Verify POST Values.';
        exit;
    }

    $user_id        = get_current_user_id();

    if (!current_user_can('manage_options')) {
        exit;
    }

    // delete  the shortcode from database 
    if (isset($_POST['delete_shortcode']) && current_user_can('manage_options')) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $wpdb->delete($table_name, array('code' => $_POST['delete_shortcode']));
        echo 'This ShortCode has been Deleted';
    }


    exit;
}
add_action('wp_ajax_nopriv_delete_shortcode_rm199', 'delete_shortcode_rm199_callback');
add_action('wp_ajax_delete_shortcode_rm199', 'delete_shortcode_rm199_callback');
