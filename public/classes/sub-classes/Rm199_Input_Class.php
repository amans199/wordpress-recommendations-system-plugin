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
                <p class="rm199_preferences_example__txt"><?php _e('Preferences helps us to provide you with the best experience', 'rm199'); ?></p>
                <a href="#" id="rm199_preferences_modal_btn"><?php _e('Add Preferences', 'rm199'); ?></a>
            </div>
            <div id="rm199_preferences_modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <form id="rm199_preferences_form" method="POST">
                            <input type="submit" value="<?php _e('Save Preferences', 'rm199'); ?>" class="mt-3" />
                        </form>
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-body">

                        <div class="rm199_modal_cards">

                            <!-- preferences cards :: credits to mednabouli -> https://codepen.io/mednabouli/pen/KoRmyE -->
                            <!-- todo : enhance the design and make a better performance in loading the cards and add a loader after saving the preferences  -->
                            <h3> What do you like the most !? </h3>

                            <div class="grid-wrapper">
                                <?php $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);
                                foreach (get_categories() as $category) {
                                    if ($category->count > 0) {
                                ?>
                                        <div class="card-wrapper">
                                            <input class="c-card" type="checkbox" id="<?php echo  $category->term_id; ?>" value="<?php echo $category->cat_name; ?>" <?php echo (in_array($category->cat_name, $current_user_preferences) ? "checked" : ''); ?>>
                                            <div class="card-content">
                                                <div class="card-state-icon"></div>
                                                <label for="<?php echo  $category->term_id; ?>">
                                                    <h4><?php echo $category->cat_name; ?></h4>
                                                </label>
                                            </div>
                                        </div>

                                <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<?php
        }
    }
}
