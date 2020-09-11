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

/**
 * Enqueue our Scripts and Styles Properly
 */
function rm199_preferences_input_enqueue()
{

    $plugin_url  = plugins_url() . '/recommendations-master';     // Used to keep our Template Directory URL
    $ajax_url   = admin_url('admin-ajax.php');        // Localized AJAX URL

    // Register Our Script for Localization
    wp_register_script(
        'rm199_um-modifications',                             // Our Custom Handle
        "{$plugin_url}/public/js/rm199_um-modifications.js",  // Script URL, this script is located for me in `theme-name/scripts/rm199_um-modifications.js`
        array('jquery'),                              // Dependant Array
        '1.0',                                          // Script Version ( Arbitrary )
        true                                            // Enqueue in Footer
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

    $user_id        = get_current_user_id();
    $rm199_um_val    = sanitize_text_field(wp_strip_all_tags($_POST['preferences']));

    // update_user_meta($user_id, 'first_name', $um_val);                // Update our user meta
    add_user_meta($user_id, 'preferences', $rm199_um_val);

    exit;
}
add_action('wp_ajax_nopriv_um_cb', 'rm199_um_modifications_callback');
add_action('wp_ajax_um_cb', 'rm199_um_modifications_callback');

// function rm199_js()
// {
//     // Register our script just like we would enqueue it - for WordPress references
//     wp_register_script('rm199-js', plugins_url() . 'recommendations-master/public/js/rm199.js', array('jquery'), false, true);

//     // Create any data in PHP that we may need to use in our JS file
//     $local_arr = array(
//         'ajaxurl'   => admin_url('admin-ajax.php'),
//         'security'  => wp_create_nonce('rm199')
//     );
//     // Assign that data to our script as an JS object
//     wp_localize_script('rm199-js-localized', 'rm199Obj', $local_arr);
//     // Enqueue our script
//     wp_enqueue_script('rm199-js');
// }
// add_action('wp_enqueue_scripts', 'rm199_js');

// // start shortcode functions
// require_once('classes/Rm199_Shortcodes_Class.php');

// // add shortCode to show posts 
// add_shortcode('rm199_posts',  array('Rm199ShortcodesHandlerClass', 'rm199_posts'));


// // add shortCode to show the tags input for user 
// add_shortcode('rm199_input',  array('Rm199ShortcodesHandlerClass', 'rm199_input'));

// start shortcode functions
require_once('classes/Rm199_Shortcode_Class.php');

// add shortCode to show posts 
add_shortcode('rm199_posts',  array('Rm199ShortCodeManager', 'rm199_posts'));

// add shortCode to show the tags input for user 
add_shortcode('rm199_input',  array('Rm199ShortCodeManager', 'rm199_input'));


// add user preferences meta 
require_once('classes/Rm199_Handel_User_Meta_Class.php');
new Rm199HandelUserMetaClass();
// add_action('edit_user_profile', array('Rm199HandelUserMetaClass', 'displayUserPreferencesInHisProfile'));
