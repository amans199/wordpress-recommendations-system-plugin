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
    function __construct()
    {
        // 
    }

    public static function rm199_input()
    {
        if (is_user_logged_in()) { ?>
            <!-- todo :: add templates :: topbar , side notice , send email , etc...  -->
            <div class="rm199_topbar">
                <p class="rm199_preferences_example__txt">Preferences helps us to provide you with the best experience</p>
                <a href="#" id="modal-btn">Add Preferences</a>
            </div>
            <!-- <div class="rm199_side_notice">
              
            </div> -->
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="rm199_modal_cards">
                            <form id="um_form" method="POST">
                                <p>
                                    <label for="um_key">
                                        Add New Keyword:
                                        <input type="text" name="um_key" id="um_key" value="" style="width:100%;" placeholder="<?php _e('add keywords spectated with commas', 'rm199'); ?>" />
                                    </label>
                                    <input type="submit" value="<?php _e('Add Keyword', 'rm199'); ?>" class="mt-3" />
                                </p>
                            </form>
                            <?php $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false); ?>

                            <span class="rm199__keywords__title">all preferences : </span>

                            <div class="all_keywords_shown">
                                <?php foreach ($current_user_preferences as $preference) {  ?>
                                    <span class="rm199__keyword rm199__keyword-<?php echo str_replace(' ', '', $preference); ?>">
                                        <span class="rm199__keyword__content"><?php echo $preference; ?></span>
                                        <button type="submit" class="delete_this_keyword_handler" name="delete-this-keyword" value="<?php echo $preference; ?>" style="padding:0px;" onclick="delete_this_keyword_handler(event,'<?php echo $preference; ?>')">
                                            <span class="dashicons dashicons-no-alt" style="top:0px"></span>
                                        </button>
                                    </span>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

<?php
            // if (isset($_POST['delete-this-keyword'])) {
            //     delete_user_meta(get_current_user_id(), 'preferences', sanitize_text_field($_POST['delete-this-keyword']));
            // }
            // if (isset($_POST['rm199-submitted'])) {
            //     add_user_meta(get_current_user_id(), 'preferences', sanitize_text_field(wp_strip_all_tags($_POST["rm199_preferences"])));
            // }
            // wp_die();
            // return ob_get_clean();
        }
    }
}
