<?php
if (!defined('ABSPATH')) {
    die();
}
// register scripts 
// wp_enqueue_script('rm199-js', plugins_url() . '/recommendations-master/public/js/rm199.js');
function rm199_public_scripts()
{
    wp_enqueue_style('rm199-css', plugins_url() . '/recommendations-master/public/css/rm199.css');
}
add_action('wp_enqueue_scripts', 'rm199_public_scripts');


add_action('wp_enqueue_scripts', 'rm199js_enqueue');
function rm199js_enqueue()
{
    wp_enqueue_script('rm199-js',  plugins_url() . '/recommendations-master/public/js/rm199.js', array('jquery'), null, true);
    wp_localize_script(
        'rm199-js',
        'rm199Obj',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'security'  => wp_create_nonce('rm199'),
            'siteurl'  => get_site_url(),
            'user' => get_current_user_id()
        )
    );
}


// customize excerpt length 
add_filter('excerpt_length', function ($length) {
    return 10;
});

function new_excerpt_more($more)
{
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');
/**
 * Enqueue our Scripts and Styles Properly
 */
function rm199_preferences_input_enqueue()
{

    $plugin_url  = plugins_url() . '/recommendations-master';     // Used to keep our Template Directory URL
    $ajax_url   = admin_url('admin-ajax.php');        // Localized AJAX URL

    // Register Our Script for Localization
    wp_register_script(
        'rm199_um-modifications',
        "{$plugin_url}/public/js/rm199_um-modifications.js",
        array('jquery'),
        '1.0',
        true
    );

    // Localize Our Script so we can use `ajax_url`
    wp_localize_script(
        'rm199_um-modifications',
        'rm199Obj',
        array(
            'ajax_url' => $ajax_url,
            'security'  => wp_create_nonce('rm199'),
            'siteurl'  => get_site_url(),
            'user' => get_current_user_id()
        )

    );

    // Finally enqueue our script
    wp_enqueue_script('rm199_um-modifications');
}
add_action('wp_enqueue_scripts', 'rm199_preferences_input_enqueue');

// localize script for deleting keyword
// function rm199_delete_keyword()
// {

//     $plugin_url  = plugins_url() . '/recommendations-master';     // Used to keep our Template Directory URL
//     $ajax_url   = admin_url('admin-ajax.php');        // Localized AJAX URL

//     // Register Our Script for Localization
//     wp_register_script(
//         'delete_keyword_rm199_um',
//         "{$plugin_url}/public/js/delete_keyword_rm199_um.js",
//         array('jquery'),
//         '1.0',
//         true
//     );

//     // Localize Our Script so we can use `ajax_url`
//     wp_localize_script(
//         'delete_keyword_rm199_um',
//         'rm199Obj',
//         array(
//             'ajax_url' => $ajax_url,
//             'security'  => wp_create_nonce('rm199'),
//             'siteurl'  => get_site_url(),
//             'user' => get_current_user_id()
//         )

//     );

//     // Finally enqueue our script
//     wp_enqueue_script('delete_keyword_rm199_um');
// }
// add_action('wp_enqueue_scripts', 'rm199_delete_keyword');

/**
 * AJAX Callback
 * Always Echos and Exits
 */
function rm199_um_modifications_callback()
{

    // Ensure we have the data we need to continue
    if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {

        // If we don't - return custom error message and exit
        header('HTTP/1.1 400 Empty POST Values');
        echo 'Could Not Verify POST Values.';
        exit;
    }

    $user_id                        = get_current_user_id();
    delete_user_meta($user_id, 'preferences');

    $arr_of_preferences       = array_filter($_POST['preferences']);
    $arr_of_preferences_sanitized = [];
    foreach ($arr_of_preferences as $el) {
        $value_sanitized = sanitize_text_field(wp_strip_all_tags($el));
        if ($value_sanitized !== '' && !in_array($value_sanitized, $arr_of_preferences_sanitized)) {
            array_push($arr_of_preferences_sanitized,  $value_sanitized);
            add_user_meta($user_id, 'preferences', $value_sanitized);
        }
    }
    // print_r($arr_of_preferences);
    // print_r($arr_of_preferences_sanitize);
    // $arr_of_preferences_sanitize_values = array_combine( $arr_of_preferences_sanitize ), $_POST['days'] );

    // delete_user_meta($user_id, 'preferences');
    // update_user_meta($user_id, 'preferences',  "block", "image");
    // add_user_meta($user_id, 'preferences', $arr_of_preferences_sanitized);

    exit;
}
add_action('wp_ajax_nopriv_um_cb', 'rm199_um_modifications_callback');
add_action('wp_ajax_um_cb', 'rm199_um_modifications_callback');


// listen to the script for deleting keyword
// function delete_keyword_rm199_um_callback()
// {

//     // Ensure we have the data we need to continue
//     if (!isset($_POST) || empty($_POST) || !is_user_logged_in()) {

//         // If we don't - return custom error message and exit
//         header('HTTP/1.1 400 Empty POST Values');
//         echo 'Could Not Verify POST Values.';
//         exit;
//     }

//     $user_id        = get_current_user_id();
//     $rm199_keyword_um_val    = sanitize_text_field(wp_strip_all_tags($_POST['delete_keyword']));

//     delete_user_meta($user_id, 'preferences', $rm199_keyword_um_val);

//     exit;
// }
// add_action('wp_ajax_nopriv_um_delete_keyword_cb', 'delete_keyword_rm199_um_callback');
// add_action('wp_ajax_um_delete_keyword_cb', 'delete_keyword_rm199_um_callback');


// start shortcode functions
require_once('classes/Rm199_Shortcode_Class.php');

// add shortCode to show posts 
add_shortcode('rm199_posts',  array('Rm199ShortCodeManager', 'rm199_posts'));

// add shortCode to show the tags input for user 
// todo ::: fox problem with this shortcode 
add_shortcode('rm199_input',  array('Rm199ShortCodeManager', 'rm199_input'));


// add user preferences meta 
require_once('classes/Rm199_Handel_User_Meta_Class.php');
new Rm199HandelUserMetaClass();



function process_post()
{
    if (!is_admin() && is_user_logged_in()) {
        require_once('classes/sub-classes/Rm199_Input_Class.php');
        $Rm199Input = new Rm199Input();
        $Rm199Input->rm199_input();
    }
}
add_action('init', 'process_post');
