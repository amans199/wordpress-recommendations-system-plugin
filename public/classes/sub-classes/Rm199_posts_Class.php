<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199Posts
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
        $row_id = $attr['id'];
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE code='$row_id'");
        $parsed_options = json_decode($results[0]->options, true);
        print_r($results);

        if (!empty($results)) {
            if (!($parsed_options['show_only_for_loggedin_users'] && !is_user_logged_in())) {





                // if there is no user preferences
                if (!is_user_logged_in() || !$parsed_options['can_user_select_keywords']) {
                    require('posts-cases/NoUserPreferences_rm199_class.php');
                    $posts_when_user_not_loggedin = new NoUserPreferencesRm199();
                    $posts_when_user_not_loggedin->showPosts($attr, $parsed_options);
                }







                // end testing 




            } // end condition whether to show_only_for_loggedin_users or not 
        } else { // if results is empty or not
            echo 'no results';
        }
    } //end of function : rm199_posts
} //end of class