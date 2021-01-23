<?php


/********* TinyMCE Buttons ***********/
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

        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_in  DESC");
        // todo : make this input appear only on the pages that contains editors 
        echo "<input id='rm199_tinymce_shortcodes' type='hidden' value='" . json_encode($results)  . "' />";
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
