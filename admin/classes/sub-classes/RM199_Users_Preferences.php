<?php
if (!defined('ABSPATH')) {
    exit;
}
class RM199_Users_Preferences
{
    function __construct()
    {
        foreach (glob(RM199_PATH . "assets/user_preferences_templates/*.php") as $file) {
            include_once $file;
        }
    }

    public static function customize_the_preferences_input()
    {
        // todo :: add show it in  specific pages option 
        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_topbar';
        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC LIMIT 1");
        $last_row = $results[0];
        // print_r($last_row->enabled);
?>
        <h1><?php _e('Create A Preferences Handler: ', 'rm199') ?></h1>
        <div class="rm199__home_cols">

            <div class="rm199__home_col--lg " style="position: relative;">
                <div class="add_blur_if_disabled"></div>
                <div class="rm199_input">
                    <div class="rm199_preferences_example" style="margin-bottom:10px">
                        <p class="rm199_preferences_example__txt"><?php _e('Preferences helps us to provide you with the best experience'); ?></p>
                        <a href="#" class="rm199_preferences_example__link_txt"></a>
                        <button class="button button-primary"><?php _e('Add Preferences'); ?></button>
                    </div>

                </div>
                <h3 for="rm199__title_input" style="margin-bottom:10px;"><?php _e('Settings', 'rm199') ?></h3>
                <hr style="margin-bottom: 10px;">

                <!-- =============  title =============  -->
                <div class="rm199_input">
                    <h4 for="rm199__title_input"><?php _e('Text inside Topbar', 'rm199') ?></h4>
                    <div class="row">
                        <input id="rm199__title_input" type="text" placeholder="<?php _e('Preferences helps us to provide you with the best experience', 'rm199') ?>" onkeyup="rm199_topbar_title(event)" aria-describedby="rm199__topbar_text" style="margin-bottom: 10px;    width: 65%;">
                        <input id="rm199_topbar_link" type="text" placeholder="<?php _e('Add preferences', 'rm199') ?>" onkeyup="rm199_topbar_link(event)" aria-describedby="rm199__link_text" style="margin-bottom: 10px;    width: 30%;">
                    </div>
                </div>

                <hr style="margin-bottom: 10px;">
                <!-- ============= preferences include ============= -->
                <div class="rm199_input">

                    <h4 for="preferences" style="margin-bottom:10px"><?php _e('Preferences may include:', 'rm199') ?></h4>
                    <div class="mb-4" id="preferences">
                        <input type="checkbox" id="categories" name="preferences_handler" value="categories" onchange="add_to_preferences_include_handler(event)" class="preferences_include_handler">
                        <label for="categories">
                            <span>
                                <?php _e('Categories', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Categories', 'rm199') ?>)</small>
                        </label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="tags" name="preferences_handler" value="tags" onchange="add_to_preferences_include_handler(event)" class="preferences_include_handler">
                        <label for="tags">
                            <span>
                                <?php _e('Tags', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Tags', 'rm199') ?>)</small>
                        </label>

                    </div>
                    <div class="mb-4">
                        <button class="button button-primary" onclick="add_to_preferences_include_handler(event)"><?php _e('Add Manual', 'rm199') ?></button>
                    </div>
                </div>
                <hr style="margin-bottom: 10px;">

                <!-- ============= Delay ============= -->
                <div class="rm199_input">
                    <h4 for="rm199__title_input" style="margin-bottom:0"><?php _e('Delay', 'rm199') ?></h4>
                    <div class="rm199_input--row mb-3">
                        <p><?php _e('Display After', 'rm199') ?></p>
                        <input class="topbar_delay_seconds" type="number" style="margin: 0 10px;" placeholder="<?php _e('30', 'rm199') ?>" style="max-width:80px;" min="10">
                        <p><?php _e('Seconds', 'rm199') ?></p>
                    </div>
                </div>
                <hr style=" margin-bottom: 10px;">

                <!-- ============= Duration ============= -->
                <!-- todo : add toggle to allow to display it until user choose preferences -->
                <div class="rm199_input">
                    <h4 for="rm199__title_input" style="margin-bottom:0"><?php _e('Duration', 'rm199') ?></h4>
                    <div class="rm199_input--row mb-3">
                        <p><?php _e('Display for', 'rm199') ?></p>
                        <input type="number" style="margin: 0 10px;" placeholder="<?php _e('30', 'rm199') ?>" style="max-width:80px;" min="10" class="topbar_duration_seconds">
                        <p><?php _e('Seconds', 'rm199') ?></p>
                    </div>
                </div>
                <hr style=" margin-bottom: 10px;">


                <!-- ============= Styles ============= -->
                <div class="rm199_input">
                    <h4 for="rm199__title_input mb-4"><?php _e('Styles', 'rm199') ?></h4>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_main_color" style="min-width: 220px;"><?php _e('Choose background Color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_main_color" name="main-color" value="#0073aa">
                    </div>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_text_color" style="min-width: 220px;"><?php _e('Choose  Text color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_text_color" name="text-color" value="#f00000">
                    </div>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_button_link_color" style="min-width: 220px;"><?php _e('Choose  Link color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_button_link_color" name="link-color" value="#00ff00">
                    </div>
                </div>
            </div>
            <!-- start the right column  -->
            <div class="rm199__home_col--sm">
                <!-- generate shortcode  -->
                <!-- <form action="options.php" method="post" id="rm199_save_preferences_handler"> -->
                <div class="generator_box">
                    <h2 class="generator_box__header"><span><?php _e('The Preferences Handler', 'rm199') ?></span></h2>
                    <div class="generator_box__content">


                        <?php //settings_fields('rm199_topbar_settings_group'); 
                        ?>


                        <?php // $rm199_topbar_display = get_option('rm199_topbar_display');  
                        ?>


                        <div class="d-flex align-items-center" style="gap:20px">
                            <label for="toggle_preferences_input" class="m-0">
                                <h3 id="rm199__overview__title"><?php _e('Enable Preferences Bar ', 'rm199') ?></h3>
                            </label>
                            <label class="switch">
                                <input type="checkbox" id="toggle_preferences_input" value="<?php echo $results[0]->enabled ?>" <?php checked($results[0]->enabled); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>

                    <div class="generator_box__btn">
                        <!-- <input type="hidden" id="preferences_may_include_obj"> -->
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>
                        <input type="submit" class="button button-primary button-large" id="save_changes" name="save_changes" onclick="topbar_options_handler(event)" value=" <?php _e('Save', 'rm199');  ?>" />
                    </div>
                </div>
                <?php // submit_button(__('Save', 'rm199'));
                ?>
                <!-- </form> -->

                <!-- how to use  -->
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span><?php _e('How To Use', 'rm199') ?></span>
                    </h2>
                    <div class="generator_box__content">
                        <?php
                        require('modules/RM199_how_to_use.php');
                        $rm199_how_to_use = new Rm199HowToUse();
                        $rm199_how_to_use->howToUse();
                        ?>
                    </div>
                </div>

                <!-- credits  -->
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span><?php _e('Credits', 'rm199') ?></span>
                    </h2>
                    <div class="generator_box__content">
                        <?php
                        require('modules/Rm199_Credits_Class.php');
                        $credits = new Rm199Credits();
                        $credits->credits();
                        ?>
                    </div>
                </div>
            </div>


        </div>

<?php
    }
}
