<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199_Admin_Dashboard_Class
{
    public static function dashboard_content()
    {


?>
        <h1><?php _e('Generate a new Recommendation Pack ', 'rm199') ?></h1>
        <div class="rm199__home_cols">
            <?php
            if (isset($_GET['edit_shortcode'])) {
                require('modules/dashboard/Rm199_Edit_Dashboard_mode.php');
                $dashboard_edit_shortcode = new Rm199_Edit_Dashboard_mode();
                $dashboard_edit_shortcode->dashboard_edit_mode();
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
                    <!-- todo : add a preview feature  -->
                    <h2 class="generator_box__header"><span><?php _e('Generate ShortCodes', 'rm199') ?></span></h2>
                    <div class="generator_box__content">
                        <!-- <h2><?php //_e('Overview', 'rm199') 
                                    ?></h2> -->
                        <h3 id="rm199__overview__title" class="m-0"><?php _e('Recommended for you:', 'rm199') ?></h3>
                        <div class="rm199__post rm199__post--overview d-flex align-items-center" style="justify-content: space-around;margin: 40px 0;">
                            <div id="rm199__structured__template" class="text-center" style="    max-width: 150px;">
                                <div id="rm199__post__img" style="margin-bottom: 2px;">
                                    <img src="https://via.placeholder.com/150x150" alt="amas199 post image" width="150" height="150" />
                                </div>
                                <a id="rm199__post__title" rel="noopener noreferer" href="#" style="margin-top: 2px;"><?php _e('Example Post Title', 'rm199') ?></a>
                                <p id="rm199__post__excerpt" style="margin-top: 2px;"><?php _e('Lorem ipsum dolor sit amet consectetur', 'rm199') ?>...</p>
                            </div>
                            <div id="rm199__minimal__template" class="" style="display: none;">
                                <a id="rm199__post__title" rel="noopener noreferer" class="mr-2" href="#"><?php _e('Example Post Title', 'rm199') ?></a>
                            </div>
                            <div class="d-flex align-items-center text-left">
                                <span class="dashicons dashicons-no-alt" style="font-size: 45px;display: inline-table;"></span>
                                <h2 id="rm199__overview__number" style="font-size: 45px;display: inline-table;">3</h2>
                            </div>
                        </div>
                    </div>
                    <div class="generator_box__btn">
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>

                        <!-- <button type="submit" class="button button-primary button-large " name="generate_shortcode" id="generate_shortcode" onclick="generate_shortcode()"><?php //_e('Generate ShortCodes', 'rm199') 
                                                                                                                                                                                ?></button> -->
                        <?php
                        $rm199_code = uniqid();
                        ?>
                        <!-- todo : url=www.google.com -->
                        <form action="<?php echo esc_url($_SERVER['REQUEST_URI'] . '&redirect_url=www.google.com'); ?>" method="post" id="rm199_generator_form" name="rm199Generate">

                            <!-- all options  -->
                            <input type="hidden" name="rm199_so_title" id="rm199_so_title" value="">
                            <input type="hidden" name="rm199_so_description" id="rm199_so_description" value="">
                            <input type="hidden" name="rm199_so_can_user_select_keywords" id="rm199_so_can_user_select_keywords" value="">
                            <input type="hidden" name="rm199_so_show_only_for_loggedin_users" id="rm199_so_show_only_for_loggedin_users" value="">
                            <input type="hidden" name="rm199_so_number_of_items" id="rm199_so_number_of_items" value="">
                            <input type="hidden" name="rm199_so_post_types" id="rm199_so_post_types" value="">
                            <input type="hidden" name="rm199_so_categories" id="rm199_so_categories" value="">
                            <input type="hidden" name="rm199_so_tags" id="rm199_so_tags" value="">
                            <input type="hidden" name="rm199_so_template" id="rm199_so_template" value="">
                            <input type="hidden" name="rm199_so_main_color" id="rm199_so_main_color" value="">
                            <input type="hidden" name="rm199_so_secondary_color" id="rm199_so_secondary_color" value="">
                            <input type="hidden" name="rm199_so_text_color" id="rm199_so_text_color" value="">
                            <input type="hidden" name="rm199_so_custom_css" id="rm199_so_custom_css" value="">
                            <button type="submit" class="button button-primary button-large " name="save_shortcode" id="save_shortcode"><?php _e('Publish ShortCodes', 'rm199') ?></button>
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
        if (!current_user_can('manage_options')) {
            exit;
        }

        // insert the shortcode's options into database 
        if (isset($_POST['save_shortcode']) && current_user_can('manage_options')) {

            global $wpdb;
            $current_user = wp_get_current_user();

            // create nonce 
            $rm199_shortcode_content = json_encode([
                "title" => $_POST['rm199_so_title'] !== '' ? $_POST['rm199_so_title'] : "Recommended for you:",
                "description" => $_POST['rm199_so_description'] !== '' ? $_POST['rm199_so_description'] : "",
                "can_user_select_keywords" => $_POST['rm199_so_can_user_select_keywords'] !== '' ? $_POST['rm199_so_can_user_select_keywords'] : false,
                "show_only_for_loggedin_users" => $_POST['rm199_so_show_only_for_loggedin_users'] !== '' ? $_POST['rm199_so_show_only_for_loggedin_users'] : false,
                "number_of_items" => $_POST['rm199_so_number_of_items'] !== '' ? $_POST['rm199_so_number_of_items'] : 3,
                "post_types" => $_POST['rm199_so_post_types'] !== '' ? $_POST['rm199_so_post_types'] : "all",
                "categories" => $_POST['rm199_so_categories'] !== '' ? $_POST['rm199_so_categories'] : "all",
                "tags" =>  $_POST['rm199_so_tags'] !== '' ? $_POST['rm199_so_tags'] : "all",
                "main_color" => $_POST['rm199_so_main_color'] !== '' ? $_POST['rm199_so_main_color'] : null,
                "secondary_color" => $_POST['rm199_so_secondary_color'] !== '' ? $_POST['rm199_so_secondary_color'] :  null,
                "text_color" => $_POST['rm199_so_text_color'] !== '' ? $_POST['rm199_so_text_color'] : null,
                "template" => "minimal",
                'code' => $rm199_code
            ]);
            $created_by = $current_user->ID;
            $table_name = $wpdb->prefix . 'rm199_shortcodes';
            $rm199_so_custom_css = $_POST['rm199_so_custom_css'];
            $wpdb->insert(
                $table_name,
                array(
                    'code' => $rm199_code,
                    'options' => $rm199_shortcode_content,
                    'custom_styles' => $rm199_so_custom_css,
                    'created_by' => $created_by,
                    'created_in' => current_time('mysql')
                )
            );
            // dashboard_content::redirect('www.google.com');
            // header('Location: http://www.google.com/');

            exit;
        }
        ?>
<?php
    }
}
