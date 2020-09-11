<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199Input
{
    /**
     * The main Class to manage Users' preferences ..
     *
     * @since    0.0.1
     */


    public static function rm199_input($attr)
    {

        if (is_user_logged_in()) {
            // $main_color = (isset($attr['main_color']) ? $attr['main_color'] . ' !important' : '#007cba');
            // $secondary_color = (isset($attr['secondary_color']) ?  $attr['secondary_color'] . ' !important' : '#000');
            // $text_color = (isset($attr['text_color'])  ? $attr['text_color']   . ' !important'  : '#007cba');
            // ob_start();
?>
            <form id="um_form" method="POST">
                <p>
                    <label for="um_key">
                        User Meta Value:
                        <input type="text" name="um_key" id="um_key" value="" style="width:100%;" placeholder="<?php _e('add keywords spectated with commas', 'rm199'); ?>" />
                    </label>
                    <input type="submit" value="<?php _e('Add Keyword', 'rm199'); ?>" />
                </p>
            </form>
            <!-- <form action="<?php// echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="rm199_preferences_form" name="rm199Form" onSubmit="window.location.reload()">
                <p> Preferences<br />
                    <input type="text" size="40" placeholder="add keywords spectated with commas" name="rm199_preferences" class="rm199_preferences" value="<?php //echo (isset($_POST[" rm199_preferences"]) ? esc_attr($_POST["rm199_preferences"]) : ''); 
                                                                                                                                                            ?>" />' ; echo '</p>' ; // todo : create a select tags functionality to allow users to choose from all tags in website and categories echo '<p><input type="submit" name="rm199-submitted" value="' . __('Add Keyword', 'rm199' ) . '" class="submit_keyword">
                </p>
            </form> -->

<?php


            $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);
            // <!-- todo : allow user to delete a preference from the list below  -->
            // $all_preferences_shown = explode(",", trim($current_user_preferences[0]->post_content));
            echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post" class="rm199__keywords">';
            echo '<span class="rm199__keywords__title">all preferences : </span>';
            // echo ' <input id="rm199_user" type="hidden" value="' . $current_user->user_login . '" />';
            // echo ' <input id="rm199_post_id" type="hidden" value="' . $current_user_preferences[0]->ID . '" />';
            // echo ' <input id="rm199_all_keywords" type="hidden" value="' . trim($current_user_preferences[0]->post_content) . '" />';
            // for ($p = 0; $p < count($all_preferences_shown); $p++) {
            // Rm199ShortcodesHandlerClass::rm199_styles($main_color, $secondary_color, $text_color);
            // Rm199ShortcodesHandlerClass::setPostViews(get_the_ID());
            // Remove issues with prefetching adding extra views
            // remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

            // print_r($current_user_preferences);
            foreach ($current_user_preferences as $preference) {
                // if (!empty(trim($all_preferences_shown[$p]))) {
                echo '
                <span class="rm199__keyword"><span class="rm199__keyword__content">' .  $preference . '</span> 
                <button name="delete-this-keyword" value="' .  $preference . '" onClick="deleteThisKeyword(event)" style="padding:0px;">
                <span class="dashicons dashicons-no-alt" style="top:0px"></span>
                </button>
                </span>';
                // }
            }
            echo '</form>';
            if (isset($_POST['delete-this-keyword'])) {
                delete_user_meta(get_current_user_id(), 'preferences', sanitize_text_field($_POST['delete-this-keyword']));
                // wp_die();
            }
            if (isset($_POST['rm199-submitted'])) {
                add_user_meta(get_current_user_id(), 'preferences', sanitize_text_field(wp_strip_all_tags($_POST["rm199_preferences"])));
                // wp_die();
            }
            // return ob_get_clean();
        }
    }
}
