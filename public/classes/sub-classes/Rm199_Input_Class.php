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
            <div id="rm199_topbar_sys" style="display: none;">
                <div class="rm199_topbar">
                    <p class="rm199_preferences_example__txt"><?php _e('Preferences helps us to provide you with the best experience', 'rm199'); ?></p>
                    <a href="#" id="rm199_preferences_modal_btn" onclick="add_preferences_handler()"><?php _e('Add Preferences', 'rm199'); ?></a>
                    <!-- <div class="rm199_preferences_modal_status_topbar">
                        topbar status
                    </div> -->
                </div>

                <div id="rm199_preferences_modal" class="modal">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="button button-secondary close"><?php _e('Cancel', 'rm199'); ?></button>
                            <form id="rm199_preferences_form" method="POST" style="display: none;">
                                <input type="submit" value="<?php _e('Save Preferences', 'rm199'); ?>" />
                            </form>
                            <!-- <span class="close">&times;</span> -->
                        </div>
                        <div class="modal-body">
                            <div class="modal_loader">
                                <span class="icon dashicons dashicons-update w-100"></span>
                                <div class="rm199_preferences_modal_status"></div>
                            </div>
                            <div class="rm199_modal_cards">

                                <!-- preferences cards :: credits to mednabouli -> https://codepen.io/mednabouli/pen/KoRmyE -->
                                <!-- todo : enhance the design and make a better performance in loading the cards and add a loader after saving the preferences  -->
                                <h3><?php _e('What is your Preferences !?', 'rm199'); ?></h3>

                                <div class="grid-wrapper">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }
}
