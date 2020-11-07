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

            <div class="rm199__home_col--lg">
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
                <!-- title -->
                <div class="rm199_input">
                    <h2 for="rm199__title_input" style="margin-bottom:0px;"><?php _e('Customize the Preferences', 'rm199') ?></h2>
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

            </div>
            <!-- start the right column  -->
            <div class="rm199__home_col--sm">
                <!-- generate shortcode  -->
                <div class="generator_box">
                    <h2 class="generator_box__header"><span><?php _e('The Preferences Handler', 'rm199') ?></span></h2>
                    <div class="generator_box__content">
                        <!-- todo : make the h3 show the real title  -->
                        <h3 id="rm199__overview__title" class="m-0"><?php _e('The user will be asked for his preferences using a popup like this', 'rm199') ?></h3>
                        <!-- todo : make the template interact with the custom css entered by the user  -->
                        <div class="rm199__post rm199__post--overview d-flex align-items-center" style="justify-content: space-around;margin: 40px 0;">
                            <img src="https://via.placeholder.com/500x150" alt="structured-rm199" class="mt-2 w-100">
                        </div>
                    </div>







                    <div class="generator_box__btn">
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>

                        <form method="post" id="rm199_save_preferences_handler">
                            <input type="submit" class="button button-primary button-large" id="save_changes" name="save_changes" onclick="" value=" <?php _e('Save', 'rm199');  ?>" />
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
