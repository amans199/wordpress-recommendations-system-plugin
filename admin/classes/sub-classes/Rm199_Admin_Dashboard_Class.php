<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199_Admin_Dashboard_Class
{
    public static function dashboard_content()
    {
        $plugin_dir = ABSPATH . 'wp-content/plugins/recommendations-master/assets/templates/';
        $edit_shortcode = isset($_GET['edit_shortcode']) ?  $_GET['edit_shortcode'] : false;
        // connect to db 
        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_shortcodes';

        $results = "";
        $custom_styles = "";
        $number_of_items = "3";
        $template = "minimal";
        if ($edit_shortcode) {
            $results = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$edit_shortcode");
            $shortcode_decoded = json_decode($results[0]->options, true);
            $custom_styles =  isset($results[0]->custom_styles) ?   $results[0]->custom_styles : '';
            $uniq_code =  isset($results[0]->code) ?   $results[0]->code : '';
            $shortcode_created_in = isset($results[0]->created_in) ?   $results[0]->created_in : '';
            $number_of_items = isset($shortcode_decoded['number_of_items']) ? $shortcode_decoded['number_of_items'] : '3';
            $template = isset($shortcode_decoded['template']) ? $shortcode_decoded['template'] : 'minimal';
        }

?>
        <h1><?php _e('Generate a new Recommendation Pack ', 'rm199') ?></h1>
        <div class="rm199__home_cols">
            <?php


            if ($edit_shortcode && !empty($results)) {
                require('modules/dashboard/Rm199_Edit_Dashboard_mode.php');
                $dashboard_edit_shortcode = new Rm199_Edit_Dashboard_mode();
                $dashboard_edit_shortcode->dashboard_edit_mode($results, $shortcode_decoded);
            } else {
                require('modules/dashboard/Rm199_New_Dashboard_mode.php');
                $dashboard_new_shortcode = new Rm199_New_Dashboard_mode();
                $dashboard_new_shortcode->dashboard_new_mode();
            }

            ?>

            <!-- start the right column  -->
            <div class="rm199__home_col--sm">
                <!-- generate shortcode  -->
                <div class="generator_box">
                    <h2 class="generator_box__header"><span><?php _e('Generate ShortCodes', 'rm199') ?></span></h2>
                    <div class="generator_box__content">
                        <!-- todo : make the h3 show the real title  -->
                        <h3 id="rm199__overview__title" class="m-0"><?php _e('Recommended for you:', 'rm199') ?></h3>
                        <!-- todo : make the template interact with the custom css entered by the user  -->
                        <div class="rm199__post rm199__post--overview d-flex align-items-center" style="justify-content: space-around;margin: 40px 0;">

                            <!-- todo : add a real examples from the website with realtime update whenever eny argument change  -->

                            <!-- structured template  -->
                            <div id="rm199__structured__template" class="text-center" <?php echo ($template == 'structured' ? '' : 'style="display: none;"'); ?>>
                                <?php
                                // require('modules/templates/Structured_rm199.php');
                                include_once($plugin_dir . 'Structured_rm199.php');
                                $Rm199_Structured_Template = new Rm199_Structured_Template();
                                $Rm199_Structured_Template->structured_template_creator($rm199_mode = 'admin');

                                ?>
                            </div>

                            <!-- minimal template  -->
                            <div id="rm199__minimal__template" class="rm199__minimal__template" <?php echo ($template !== 'structured' ? '' : 'style="display: none;"'); ?>>
                                <?php
                                // require('modules/templates/Minimal_rm199.php');
                                include_once($plugin_dir . 'Minimal_rm199.php');

                                $Rm199_Minimal_Template = new Rm199_Minimal_Template();
                                $Rm199_Minimal_Template->minimal_template_creator($rm199_mode = 'admin');
                                ?>
                            </div>




                            <div class="d-flex align-items-center text-left">
                                <span class="dashicons dashicons-no-alt" style="font-size: 45px;display: inline-table;"></span>
                                <h2 id="rm199__overview__number" style="font-size: 45px;display: inline-table;"><?php echo $number_of_items; ?></h2>
                            </div>
                        </div>
                    </div>







                    <div class="generator_box__btn">
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>

                        <form method="post" id="rm199_generator_form">
                            <input type="hidden" name="rm199_so_template" id="rm199_so_template" value="minimal">
                            <input type="hidden" name="rm199_if_edit_mode" id="rm199_if_edit_mode" value="<?php echo (($edit_shortcode  && !empty($results)) ?  $uniq_code  : '');  ?>">
                            <input type="hidden" name="shortcode_created_in" id="shortcode_created_in" value="<?php echo (($edit_shortcode  && !empty($results)) ?  $shortcode_created_in  : current_time('mysql'));  ?>">
                            <!-- <button type="submit" class="button button-primary button-large " name="save_shortcode" id="save_shortcode"> -->
                            <input type="submit" class="button button-primary button-large" id="save_shortcode" name="save_shortcode" onclick="add_new_shortcode_handler(event)" value=" <?php ($edit_shortcode  && !empty($results)) ? _e('Update', 'rm199') : _e('Publish', 'rm199')  ?>" />
                        </form>
                    </div>

                </div>

                <!-- how to use  -->
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span><?php _e('How To Use', 'rm199') ?></span></h2>
                    <div class="generator_box__content">
                        dddddd
                    </div>
                </div>

                <!-- credits  -->
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span><?php _e('Credits', 'rm199') ?></span></h2>
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
