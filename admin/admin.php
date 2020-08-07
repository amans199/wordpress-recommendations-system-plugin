<?php
defined('ABSPATH') or die();

require_once('classes/Rm199_Menu_Class.php');
// require_once('css/rm199_css.php');



function rm199_admin_scripts()
{
    // register CSS 
    wp_enqueue_style('rm199-admin-css', plugins_url() . '/recommendations-master/admin/css/rm199-admin.css');

    // register js 
    wp_enqueue_script('rm199-admin-js', plugins_url() . '/recommendations-master/admin/js/rm199.js');
}
add_action('admin_enqueue_scripts', 'rm199_admin_scripts');


// add_post_meta(39, 'new_test', 47);
// add_metadata('post', 39, 'tsting', 23);
// // start testing 
// require_once('classes/sub-classes/modules/Rm199_Views_Setter_Class.php');
// add_filter('the_content', array('Rm199_Views_Setter_Class', 'set_views_filter_the_content'));
// // end testing 

//todo views setter doesn't add the post_views_count key .. solve this
//detect post views
// function setPostViews($postID)
// {
//     $count_key = 'post_views_count';
//     $count = get_post_meta($postID, $count_key, true);
//     if ($count == '') {
//         $count = 0;
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key, '0');
//     } else {
//         $count++;
//         update_post_meta($postID, $count_key, $count);
//     }
// }
// Remove issues with prefetching adding extra views

// function set_views_filter_the_content($content)
// {
//     // if (function_exists('setPostViews')) {
//     $content .=  'testttt';
//     // }
//     // return $content;
//     return $content;
// }
// add_action('after_setup_theme', 'setPostViews');
add_filter('the_content', 'set_views_filter_the_content');

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);



// function pippin_filter_content_sample($content)
// {
//     $content    =   wpautop(get_the_content());
//     $new_content .= '<p>This is added to the bottom of all post and page content, as well as custom post types.</p>';
//     $content .= $new_content;
//     return $content;
// }
// add_filter('the_content', 'pippin_filter_content_sample');

// add_filter('the_content', 'post_add_me');

// function post_add_me($content)
// {
//     $text = 'Test text here';
//     $content = $content . $text;

//     return $content;
// }

// function my_added_page_content($content)
// {
//     return $content . '<p>Your content added to all pages (not posts).</p>';
//     return $content . '<p>Your content added to all pages (not posts).</p>';
//     return $content . '<p>Your content added to all pages (not posts).</p>';
// }
// add_filter('the_content', 'my_added_page_content');


// functions 
// add_action('init', array('Rm199_Menu_Class', 'hideMenubar'));
// add_action('admin_init', array('Rm199_Menu_Class', 'registerSettings'));

// start menu functions 
add_action('admin_menu', array('Rm199_Menu_Class', 'createMenu'));

// add_action('wp_ajax_hide_adminbar_action', 'wp_ajax_hide_adminbar_action_handler');
// function wp_ajax_hide_adminbar_action_handler()
// {
//     if (check_ajax_referer('abc', 'security')) {
//         $current_option = get_option('rm199_test_option');
//         if (false === $current_option || 'yes' !== $current_option) {
//             update_option('rm199_test_option', 'yes');
//         } else {
//             update_option('rm199_test_option', 'no');
//         }
//         wp_send_json_success();
//     } else {
//         wp_send_json_error();
//     }
//     wp_die();
// }

// start admin bar functions 
require_once('classes/Rm199_Adminbar_Class.php');
add_action('admin_bar_menu', array('Rm199_Adminbar_Class', 'add_to_adminbar'));


// start footer functions 
require_once('classes/Rm199_Footer_Class.php');
add_filter('admin_footer_text', array('Rm199_Footer_Class', 'add_to_footer'));



// register post type 
require_once('classes/Rm199_PostType_Class.php');
add_action('init', array('Rm199_PostType_Class', 'custom_post_type'));
// add_filter('register_post_type_args', array('Rm199_PostType_Class', 'custom_args'), 10, 2);
