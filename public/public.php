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
            'ajaxurl' => admin_url('admin-ajax.php'),
            'security'  => wp_create_nonce('rm199'),
            'siteurl'  => get_site_url()
        )
    );
}

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

// start shortcode functions
require_once('classes/Rm199_Shortcodes_Class.php');

// add shortCode to show posts 
add_shortcode('rm199_posts',  array('Rm199_Shortcodes_Class', 'rm199_posts'));


// add shortCode to show the tags input for user 
add_shortcode('rm199_input',  array('Rm199_Shortcodes_Class', 'rm199_input'));
