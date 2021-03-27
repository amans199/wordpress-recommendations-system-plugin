<?php


/********* TinyMCE Buttons ***********/

// if (!function_exists('get_current_screen')) {
//     require_once ABSPATH . '/wp-admin/includes/screen.php';
// }

add_action('init', 'rm199_btn');

if (!function_exists('rm199_btn')) {
    function rm199_btn()
    {
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        if (get_user_option('rich_editing') !== 'true') {
            return;
        }
        //to do : make this appear only on the post pages 
        // get all rm199 shortcodes 
        global $wpdb;

        // ob_start();

        // $screen = get_current_screen();
        global $pagenow;
        if (($pagenow == 'post.php') || (get_post_type() == 'post') || ($pagenow ==   'post-new.php')) {
            // print_r($screen);
            // if (is_admin() && $screen->parent_base == 'edit') {

            $table_name = $wpdb->prefix . 'rm199_shortcodes';
            $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_in  DESC");
            if (count($results) > 0) {
                echo "<input id='rm199_tinymce_shortcodes' type='hidden' value='" . json_encode($results)  . "' />";
            } else {
                echo "<input id='rm199_tinymce_shortcodes' type='hidden' value='" . json_encode([])  . "' />";
            }
        }
        // todo : make this input appear only on the pages that contains editors 
        add_filter('mce_external_plugins', 'rm199_register_tinymce_javascript');
        add_filter('mce_buttons', 'rm199_register_buttons');
        // ob_flush();
    }
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function rm199_register_tinymce_javascript($plugin_array)
{
    $plugin_array['rm199_tinymceplugin'] = plugins_url() . '/recommendations-master/admin/js/rm199_tinymce.js';
    return $plugin_array;
}

function rm199_register_buttons($buttons)
{
    // array_push($buttons, 'separator', 'myblockquotebtn');
    $newBtns = array(
        'rm199_shortcode'
    );
    $buttons = array_merge($buttons, $newBtns);
    return $buttons;
}
