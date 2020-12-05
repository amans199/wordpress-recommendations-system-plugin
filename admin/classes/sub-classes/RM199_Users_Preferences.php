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

?>
        <h1><?php _e('Create A Preferences Handler: ', 'rm199') ?></h1>
        <div class="rm199__home_cols">

            <div class="rm199__home_col--lg " style="position: relative;">
                <div class="add_blur_if_disabled"></div>
                <div class="rm199_input">
                    <div class="rm199_preferences_example" style="margin-bottom:10px">
                        <p class="rm199_preferences_example__txt">Preferences helps us to provide you with the best experience</p>
                        <a href="#">Add Preferences</a>
                    </div>
                    <!-- title -->
                    <div class="rm199_input">
                        <label for="rm199__title_input"><?php _e('Message', 'rm199') ?></label>
                        <input id="rm199__title_input" type="text" placeholder="<?php _e('Preferences helps us to provide you with the best experience', 'rm199') ?>" onkeyup="rm199_preferences_title(event)" aria-describedby="rm199__title">
                    </div>
                </div>
                <hr style="margin-bottom: 10px;">
                <!-- options -->
                <div class="rm199_input">
                    <h2 for="rm199__title_input" style="margin-bottom:0px;"><?php _e('Options', 'rm199') ?></h2>
                    <small for="rm199__title_input" style="margin-bottom:10px"><?php _e('What do you want users to choose from !?', 'rm199') ?></small>
                    <div class="mb-4">
                        <input type="checkbox" id="categories" name="preferences_handler" value="categories" onclick="">
                        <label for="categories">
                            <span>
                                <?php _e('Categories', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Categories', 'rm199') ?>)</small>
                        </label>
                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="tags" name="preferences_handler" value="tags" onclick="">
                        <label for="tags">
                            <span>
                                <?php _e('Tags', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Show A set of the most populated Tags', 'rm199') ?>)</small>
                        </label>

                    </div>
                    <div class="mb-4">
                        <input type="checkbox" id="add_manual" name="preferences_handler" value="add_manual" onclick="">
                        <label for="add_manual">
                            <span>
                                <?php _e('Add Manual', 'rm199') ?>
                            </span>
                            <small>(<?php _e('Add Keywords Manually', 'rm199') ?>)</small></label>
                    </div>
                </div>
                <hr style="margin-bottom: 10px;">


                <!-- Settings  -->
                <!-- options -->
                <div class="rm199_input">
                    <h2 for="rm199__title_input"><?php _e('Options', 'rm199') ?></h2>
                    <div class="rm199_input--row mb-3">
                        <h4><?php _e('Display After', 'rm199') ?></h4>
                        <input type="number" style="margin: 0 10px;" placeholder="<?php _e('30', 'rm199') ?>" style="max-width:80px;" min="10" onkeyup="" onchange="">
                        <h4><?php _e('Seconds', 'rm199') ?></h4>
                    </div>
                </div>
                <hr style=" margin-bottom: 10px;">




                <!-- Customization -->
                <div class="rm199_input">
                    <h2 for="rm199__title_input mb-4"><?php _e('Styles', 'rm199') ?></h2>
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
                                <input type="checkbox" id="toggle_preferences_input" value="yes" <?php checked(get_option('rm199_topbar_display'), 'yes'); ?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <!-- <form method="post" action="options.php"> -->

                    <?php // settings_fields('rm199_preferences_topbar'); 
                    ?>
                    <?php //do_settings_sections('rm199_preferences'); 
                    ?>
                    <?php //register_setting(
                    // 'rm199_preferences_topbar', // Option group
                    // 'my_option_name', // Option name
                    // '' // Sanitize
                    // );
                    ?>
                    <?php// submit_button(); ?>
                    <!-- </form> -->
                    <div class="generator_box__btn">
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>
                        <input type="submit" class="button button-primary button-large" id="save_changes" name="save_changes" onclick="update_preferences_settings(event)" value=" <?php _e('Save', 'rm199');  ?>" />
                    </div>
                </div>
                <?php // submit_button(__('Save', 'rm199'));
                ?>
                <!-- </form> -->

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
