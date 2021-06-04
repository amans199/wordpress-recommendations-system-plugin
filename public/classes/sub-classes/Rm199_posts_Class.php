<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199AllPosts
{
    /**
     * The main Class to manage displaying posts/products based on Users' preferences ..
     *
     * @since    1.0.0
     */

    public static function rm199_posts($attr)
    {

        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        ob_start();
        $row_id = $attr['id'];
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE code='$row_id'");
        if (count($results) == 0) {
            return;
        }
        $parsed_options = json_decode($results[0]->options, true);
        $custom_styles = $results[0]->custom_styles;
        ob_get_clean();
        if (!empty($results)) {
                include_once('posts-cases/NoUserPreferences_rm199_class.php');
                $posts_when_user_not_loggedin = new NoUserPreferencesRm199();
                $posts_when_user_not_loggedin->showPosts($attr, $parsed_options, $custom_styles);

        } 
    } //end of function : rm199_posts
} //end of class