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
        $all_results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC") ?: [];
        if (count($all_results) > 0) {
        }
        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY ID DESC LIMIT 1");
        // $last_row = $results[0];
        // print_r($last_row->enabled);
?>
        <h1><?php _e('Create A Preferences Handler: ', 'rm199') ?></h1>
        <div class="rm199__home_cols">

            <div class="rm199__home_col--lg " style="position: relative;">
                <div class="add_blur_if_disabled"></div>
                <div class="rm199_input">
                    <div class="rm199_preferences_example" style="margin-bottom:10px">
                        <p class="rm199_preferences_example__txt"><?php _e('Your preferences helps us providing you with the best experience'); ?></p>
                        <a href="#" class="rm199_preferences_example__link_txt">
                            <button class="button button-primary"><?php _e('Add Preferences'); ?></button></a>
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
                        <input type="checkbox" id="preferences_handler_categories" name="preferences_handler" value="categories" class="preferences_include_handler">
                        <label for="preferences_handler_categories">
                            <span>
                                <?php _e('Categories', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Categories', 'rm199') ?>)</small>
                        </label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="preferences_handler_tags" name="preferences_handler" value="tags" class="preferences_include_handler">
                        <label for="preferences_handler_tags">
                            <span>
                                <?php _e('Tags', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Tags', 'rm199') ?>)</small>
                        </label>

                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="preferences_handler_select_all" name="preferences_handler" value="select_all" class="preferences_include_handler" onchange="select_all_tags_and_categories(event)">
                        <label for="preferences_handler_select_all">
                            <span>
                                <?php _e('Select All', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Select all tags and categories', 'rm199') ?>)</small>
                        </label>
                    </div>
                    <!-- <div class="mb-4">
                        <button class="button button-primary" onclick="add_to_preferences_include_handler(event)"><?php //_e('Add Manual', 'rm199') 
                                                                                                                    ?></button>
                    </div> -->
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
                    <div class="row">
                        <div class="rm199_input--row mb-3">
                            <p><?php _e('Display for', 'rm199') ?></p>
                            <input type="number" style="margin: 0 10px;" placeholder="<?php _e('30', 'rm199') ?>" style="max-width:80px;" min="10" class="topbar_duration_seconds">
                            <p><?php _e('Seconds', 'rm199') ?></p>
                        </div>
                        <input type="checkbox" name="display_topbar_till_user_choose_preferences" id="display_topbar_till_user_choose_preferences" onchange="display_topbar_till_user_choose_preferences(event)">
                        <label for="display_topbar_till_user_choose_preferences"><?php _e('Display topbar till user choose preferences') ?></label>
                    </div>
                </div>
                <hr style=" margin-bottom: 10px;">


                <!-- ============= Styles ============= -->
                <div class="rm199_input">
                    <h4 for="rm199__title_input mb-4"><?php _e('Styles', 'rm199') ?></h4>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_main_color" style="min-width: 220px;"><?php _e('Choose background Color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_main_color_topbar" name="main-color" value="" onchange="topbar_change_the_bg_color(event)">
                    </div>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_text_color" style="min-width: 220px;"><?php _e('Choose  Text color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_text_color_topbar" name="text-color" value="" onchange="topbar_change_the_txt_color(event)">
                    </div>
                    <div class="rm199_input--row mb-3">
                        <label for="choose_button_link_color" style="min-width: 220px;"><?php _e('Choose  Link color ', 'rm199') ?></label>
                        <input class="mx-2" type="color" id="choose_button_link_color_topbar" name="link-color" value="" onchange="topbar_change_the_link_color(event)">
                    </div>
                </div>
            </div>
            <!-- start the right column  -->
            <div class="rm199__home_col--sm">
                <!-- generate shortcode  -->
                <!-- <form action="options.php" method="post" id="rm199_save_preferences_handler"> -->






                <div class="generator_box">
                    <h2 class="generator_box__header"><span><?php _e('Save Topbar Settings', 'rm199') ?></span></h2>
                    <div class="generator_box__content">


                        <div class="d-flex align-items-center" style="gap:20px">
                            <label for="toggle_preferences_input" class="m-0">
                                <h3 id="rm199__overview__title"><?php _e('Enable Preferences Bar ', 'rm199') ?></h3>
                            </label>
                            <label class="switch">
                                <?php if (count($results) > 0) { ?>
                                    <input type="checkbox" id="toggle_preferences_input" value="<?php echo $results[0]->enabled ?>" <?php checked($results[0]->enabled); ?>>
                                <?php } else {
                                ?>
                                    <input type="checkbox" id="toggle_preferences_input" value="false">
                                <?php
                                }
                                ?>
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
                <div class="generator_box">
                    <h2 class="generator_box__header"><span><?php _e('The Topbar Logger (History)', 'rm199') ?></span></h2>
                    <div class="generator_box__content">

                        <section class="preferences_logger overflow-y-auto">
                            <!-- todo : add functionality to restore or delete any logger history -->
                            <?php if (count($all_results) > 0) { ?>

                                <?php
                                foreach ($all_results as $key => $result) {
                                    if (count($all_results) - $key === count($all_results)) {
                                        $the_current = __('Current');
                                    } else {
                                        $the_current = "";
                                    }
                                ?>
                                    <!-- todo : add a modal of info  -->
                                    <div class="preferences_logger_item d-flex ">
                                        <div>
                                            <small> <?php echo  count($all_results) - $key; ?> )
                                            </small>
                                            <span style="margin:0 2px;"></span>

                                            <small><?php _e('last saved in ') ?>
                                                <?php
                                                echo  date_i18n(get_option('date_format'), $result->created_in);
                                                ?></small>
                                            <span style="margin:0 2px;"></span>
                                            <small><?php _e('by ') ?> <?php echo get_the_author_meta('nicename', $result->created_by); ?></small>
                                            <?php //print_r($result); 
                                            ?>
                                        </div>
                                        <section class="preferences_logger_item_actions d-flex">
                                            <?php
                                            if (count($all_results) - $key !== count($all_results)) {
                                            ?>
                                                <!-- todo : add functionality of deleting a row or restoring another one -->
                                                <button class="rm199_btn rm199_btn_danger cursor-pointer d-flex align-items-center "><span class="dashicons dashicons-trash"></span></button>
                                                <!-- todo : show info -->
                                                <button class="rm199_btn rm199_btn_warning cursor-pointer d-flex align-items-center "><span class="dashicons dashicons-update"></span></span></button>
                                            <?php
                                            } else {
                                                echo  "( " . $the_current . " )";
                                            }
                                            ?>
                                        </section>

                                    </div>
                            <?php
                                }
                            } else {
                                echo 'You have not enabled the topbar yet';
                            }
                            ?>
                        </section>
                    </div>
                    <!-- todo : add functionality to clear history button  -->
                    <?php if (count($all_results) > 0) { ?>
                        <div class="generator_box__btn">
                            <button class="rm199_btn rm199_btn_danger cursor-pointer d-flex align-items-center "><?php _e('Clear History', 'rm199');  ?></button>
                        </div>
                    <?php } ?>
                </div>

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
