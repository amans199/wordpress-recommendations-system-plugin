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
        $parsed_options = json_decode($results[0]->options, true);
        $custom_styles = $results[0]->custom_styles;
        ob_get_clean();

        if (!empty($results)) {
            // if (!($parsed_options['show_only_for_loggedin_users'] && !is_user_logged_in())) {}

            // todo : fix a problem that the loggedin-only posts are displayed to all users 

            // if there is no user preferences
            if (!is_user_logged_in() || !$parsed_options['can_user_select_keywords']) {
                // echo 'user not logger in ::: ';
                include_once('posts-cases/NoUserPreferences_rm199_class.php');
                $posts_when_user_not_loggedin = new NoUserPreferencesRm199();
                $posts_when_user_not_loggedin->showPosts($attr, $parsed_options, $custom_styles);
            }


            // if user is logged in and can add preferences 
            if (is_user_logged_in() && $parsed_options['can_user_select_keywords']) {
                // echo 'user is logged in ::: ';

                include_once('posts-cases/UserPreferences.php');
                $posts_when_user_is_loggedin_and_can_add_preferences = new UserPreferencesRm199();
                $posts_when_user_is_loggedin_and_can_add_preferences->showPosts($attr, $parsed_options, $custom_styles);
            }



            // 

        } else { // if results is empty or not
            ob_start();
            echo 'no results';
            ob_get_clean();
        }
    } //end of function : rm199_posts
} //end of class