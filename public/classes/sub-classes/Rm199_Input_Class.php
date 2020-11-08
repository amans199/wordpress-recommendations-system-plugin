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
            <!-- modal :: credits to bradtraversy -> https://codepen.io/bradtraversy/pen/zEOrPp -->
            <div id="my-modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <form id="um_form" method="POST">
                            <!-- <label for="um_key"> -->
                            <!-- Add New Keyword: -->
                            <!-- <input type="text" name="um_key" id="um_key" value="" style="width:100%;" placeholder="<?php //_e('add keywords spectated with commas', 'rm199'); 
                                                                                                                        ?>" /> -->
                            <!-- </label> -->
                            <input type="submit" value="<?php _e('Save Preferences', 'rm199'); ?>" class="mt-3" />
                        </form>
                        <span class="close">&times;</span>
                    </div>
                    <?php // $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false); 
                    ?>
                    <!-- <span class="rm199__keywords__title">all preferences : </span> -->
                    <?php //print_r($current_user_preferences); 
                    ?>
                    <!-- <div class="all_keywords_shown">
                        <?php //foreach ($current_user_preferences as $preference) {  
                        ?>
                            <?php //if ($preference !== '') {
                            ?>
                                <span class="rm199__keyword rm199__keyword-<?php //echo str_replace(' ', '', $preference); 
                                                                            ?>">
                                    <span class="rm199__keyword__content"><?php //echo $preference; 
                                                                            ?></span>
                                    <button type="submit" class="delete_this_keyword_handler" name="delete-this-keyword" value="<?php //echo $preference; 
                                                                                                                                ?>" style="padding:0px;" onclick="delete_this_keyword_handler(event,'<?php //echo $preference; 
                                                                                                                                                                                                        ?>')">
                                        <span class="dashicons dashicons-no-alt" style="top:0px"></span>
                                    </button>
                                </span>
                        <?php // }
                        //} 
                        ?>
                    </div> -->
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

                            <!-- end testing cards  -->




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
