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


// // start admin bar functions 
// require_once('classes/Rm199_Adminbar_Class.php');
// add_action('admin_bar_menu', array('Rm199_Adminbar_Class', 'add_to_adminbar'));


// // start footer functions 
// require_once('classes/Rm199_Footer_Class.php');
// add_filter('admin_footer_text', array('Rm199_Footer_Class', 'add_to_footer'));



// // register post type 
// require_once('classes/Rm199_PostType_Class.php');
// add_action('init', array('Rm199PostTypesClass', 'rmTemplates'));

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
        'rm199Obj',
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

    // Ensure we have the data we need to continue


    // echo 'testing ';
    if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {

        // If we don't - return custom error message and exit
        header('HTTP/1.1 400 Empty POST Values');
        echo 'Could Not Verify POST Values.';
        exit;
    }


    $user_id        = get_current_user_id();
    // $rm199_keyword_um_val    = sanitize_text_field(wp_strip_all_tags($_POST['delete_keyword']));

    // delete_user_meta($user_id, 'preferences', $rm199_keyword_um_val);
    if (!current_user_can('manage_options')) {
        exit;
    }

    // insert the shortcode's options into database 
    // if (isset($_POST['save_shortcode']) && current_user_can('manage_options')) {
    // echo 'testing';
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
    // $edit_shortcode = isset($_GET['edit_shortcode']) ?  $_GET['edit_shortcode'] : false;
    $current_user = wp_get_current_user();
    if ($_POST['edit_mode_id']) {
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

    // dashboard_content::redirect('www.google.com');
    // header('Location: http://www.google.com/');
    // }

    exit;
}
add_action('wp_ajax_nopriv_add_new_shortcode_cb', 'add_new_shortcode_handler_callback');
add_action('wp_ajax_add_new_shortcode_cb', 'add_new_shortcode_handler_callback');
