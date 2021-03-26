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
        global $wpdb;
        // $table_name = $wpdb->prefix . 'rm199_shortcodes';
        ob_start();
        // $row_id = $attr['id'];
        // $results = $wpdb->get_results("SELECT * FROM $table_name WHERE code='$row_id'");
        // $parsed_options = json_decode($results[0]->options, true);
        // $custom_styles = $results[0]->custom_styles;
        $topbar_settings_table_name = $wpdb->prefix . 'rm199_topbar';
        $topbar_settings = $wpdb->get_results("SELECT * FROM $topbar_settings_table_name ORDER BY ID DESC LIMIT 1");
        if ($topbar_settings) {
            $topbar_settings_obj = $topbar_settings[0];
            $parsed_topbar_settings_obj = json_decode($topbar_settings_obj->options, true);
            ob_get_clean();
            if (is_user_logged_in() && $parsed_topbar_settings_obj['enabled']) { ?>
                <!-- todo :: add templates :: topbar , side notice , send email , etc...  -->
                <div id="rm199_topbar_sys" style="display: none;">
                    <div class="rm199_topbar" data-background="<?php echo $parsed_topbar_settings_obj['bg_color']; ?>" data-color="<?php echo $parsed_topbar_settings_obj['text_color']; ?>" data-duration="<?php echo $parsed_topbar_settings_obj['duration']; ?>" data-enabled="<?php echo $parsed_topbar_settings_obj['enabled']; ?>" data-delay="<?php echo $parsed_topbar_settings_obj['delay']; ?>" data-preferences_include="<?php echo $parsed_topbar_settings_obj['preferences_include']; ?>">
                        <p class="rm199_preferences_example__txt">
                            <?php
                            echo $parsed_topbar_settings_obj['text'];
                            ?></p>
                        <?php
                        //  print_r($topbar_settings_obj);
                        $preferences_should_include = $parsed_topbar_settings_obj['preferences_include'];
                        // print_r(array_values($preferences_should_include));
                        // echo json_encode(array_values($preferences_should_include));
                        // echo  implode('/', array_values($preferences_should_include))
                        ?>
                        <!-- todo : add button styles  -->
                        <a href="#" role="button" id="rm199_preferences_modal_btn" class="rm199_btn rm199_btn_warning  effect1" data-btn_color="<?php echo $parsed_topbar_settings_obj['text_link_color']; ?>" onclick="add_preferences_handler('<?php echo implode('/', array_values($preferences_should_include)); ?>')">
                            <?php
                            echo $parsed_topbar_settings_obj['link_text'];
                            ?>
                        </a>
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
                                <?php
                                // print_r($parsed_topbar_settings_obj);
                                ?>
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
}
