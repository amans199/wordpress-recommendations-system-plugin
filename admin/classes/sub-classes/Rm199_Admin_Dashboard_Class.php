<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199_Admin_Dashboard_Class
{
    public static function dashboard_content()
    {
        // wp_enqueue_script('rm199-admin-js', plugins_url() . '/recommendations-master/admin/js/rm199.js');

?>
        <h1><?php _e('Generate a new Recommendation Pack ', 'rm199') ?></h1>
        <div class="rm199__home_cols">
            <div class="rm199__home_col--lg">
                <h2 style="margin-top: 0px;"><?php _e('General ', 'rm199') ?></h2>

                <!-- title -->
                <div class="rm199_input">
                    <label for="rm199__title_input"><?php _e('Title', 'rm199') ?></label>
                    <input id="rm199__title_input" type="text" placeholder="<?php _e('We Recommend You Those Posts', 'rm199') ?>">
                </div>

                <!-- filter by keyword -->
                <div class="rm199_input--row">
                    <input type="checkbox" id="filter_by_keyword">
                    <label for="filter_by_keyword"><?php _e('Allow users to select Keywords', 'rm199') ?></label>
                </div>

                <div class="rm199_input--row">
                    <input type="checkbox" id="show_only_for_loggedin_users">
                    <label for="show_only_for_loggedin_users"><?php _e('Show Only For Logged In Users', 'rm199') ?></label>
                </div>

                <div class="rm199_input--row">
                    <label for="number_of_posts_2_show" class="mx-2"><?php _e('Number of Items', 'rm199') ?></label>
                    <input type="number" id="number_of_posts_2_show" name="number_of_posts_2_show" placeholder="<?php _e('3', 'rm199') ?>" style="max-width:80px;">
                </div>
                <div class=" rm199_input--row">
                    <label for="rm199_post_type" class="mx-2"><?php _e('Type', 'rm199') ?></label>
                    <!-- display all post types in select box -->
                    <?php
                    $args = array(
                        'public'   => true,
                    );
                    $output = 'objects'; // 'names' or 'objects' (default: 'names')
                    $operator = 'and'; // 'and' or 'or' (default: 'and')
                    $post_types = get_post_types($args, 'objects');
                    if ($post_types) { // If there are any custom public post types.
                    ?>
                        <select name="rm199_post_type" id="rm199_post_type">
                            <option value="all"><?php _e('All', 'rm199') ?></option>
                            <?php foreach ($post_types  as $post_type) { ?>
                                <option value="<?php echo $post_type->name ?>"><?php echo $post_type->labels->name ?></option>
                            <?php } ?>
                        </select>
                    <?php
                    }
                    ?>
                    <a style="margin-left:20px;margin-right:20px;" href="#" onclick="togglePostTypesBox()">
                        <?php _e('Or add more than one post type', 'rm199') ?></a>
                </div>
                <!-- add any number of post types  -->
                <div class="rm199_input rm199_input_more_post_types" style="display: none;">
                    <button class="rm199_input_more_post_types__close" onclick="togglePostTypesBox()">X</button>
                    <p id="rm199__more_post_types_input_info"> <?php _e('Add any Number of post types separated with commas', 'rm199') ?></p>
                    <input id="rm199__more_post_types_input" type="text" aria-describedby="rm199__more_post_types_input_info" placeholder="<?php _e('posts,products,materials', 'rm199') ?>">
                </div>
                <!-- end post type customizer  -->

                <!-- start category customizer  -->
                <div class="rm199_input--row">
                    <!-- display all categories  -->
                    <label for="rm199_categories" class="mx-2"><?php _e('Category', 'rm199') ?></label>
                    <select name="rm199_categories" id="rm199_categories">
                        <option value="all"><?php _e('All', 'rm199') ?></option>
                        <?php
                        $categories = get_categories();
                        foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->name ?>"><?php echo $category->name ?></option>
                        <?php  } ?>
                    </select>
                    <a style="margin-left:20px;margin-right:20px;" href="#" onclick="toggleCategoryBox()"><?php _e('Or add more than one category', 'rm199') ?></a>
                </div>
                <!-- add any number of categories  -->
                <div class="rm199_input rm199_input_more_categories" style="display: none;">
                    <button class="rm199_input_more_categories__close" onclick="toggleCategoryBox()">X</button>
                    <p id="rm199__more_categories_input_info"> <?php _e('Add any Number of categories separated with commas', 'rm199') ?></p>
                    <input id="rm199__more_categories_input" type="text" aria-describedby="rm199__more_categories_input_info" placeholder="<?php _e('books,pants,shirts', 'rm199') ?>">
                </div>
                <!-- end category customizer  -->


                <!-- start tags customizer  -->
                <div class="rm199_input--row">
                    <label for="rm199_tags" class="mx-2"><?php _e('Tag', 'rm199') ?></label>
                    <select name="rm199_tags" id="rm199_tags">
                        <option value="all"><?php _e('All', 'rm199') ?></option>
                        <?php
                        $tags = get_tags('post_tag');
                        foreach ($tags as $tag) { ?>
                            <option value="<?php echo $tag->name ?>"><?php echo $tag->name ?></option>
                        <?php  } ?>
                    </select>
                    <a style="margin-left:20px;margin-right:20px;" href="#" onclick="toggleTagsBox()"><?php _e('Or add more than one tag', 'rm199') ?></a>
                </div>
                <!-- add any number of tags  -->
                <div class="rm199_input rm199_input_more_tags" style="display: none;">
                    <button class="rm199_input_more_tags__close" onclick="toggleTagsBox()">X</button>
                    <p id="rm199__more_tags_input_info"> <?php _e('Add any Number of tags separated with commas', 'rm199') ?></p>
                    <input id="rm199__more_tags_input" type="text" aria-describedby="rm199__more_tags_input_info" placeholder="<?php _e('football,english,europe', 'rm199') ?>">
                </div>
                <!-- end tags customizer  -->



                <hr style="margin-bottom: 20px;">

                <!-- choose template for recommendations -->
                <h2><?php _e('Templates ', 'rm199') ?></h2>
                <div class="rm199_input--col">
                    <div class="mb-4">
                        <input type="radio" id="minimal" name="template" value="minimal">
                        <label for="minimal"><?php _e('Minimal', 'rm199') ?></label><br>
                        <label for="minimal"><img src="https://via.placeholder.com/500x150" alt="minimal-rm199"></label>
                    </div>
                    <div class="mb-4">
                        <input type="radio" id="structured" name="template" value="structured">
                        <label for="structured"><?php _e('Structured', 'rm199') ?></label><br>
                        <label for="structured"><img src="https://via.placeholder.com/500x150" alt="structured-rm199"></label>
                    </div>

                    <!-- <a href="#"><?php //_e('Or Customize your own template', 'rm199') 
                                        ?></a> -->
                </div>
                <hr style="margin-bottom: 20px;">
                <h2><?php _e('Choose Global Styles ', 'rm199') ?></h2>
                <!-- style the keywords input  -->
                <div class="choose_global_styles">
                    <div class="rm199_input--row">
                        <label for="choose_main_color" style="min-width: 220px;"><?php _e('Choose your brand\'s main color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_main_color" name="main-color" value="#0073aa">
                    </div>
                    <div class="rm199_input--row">
                        <label for="choose_secondary_color" style="min-width: 220px;"><?php _e('Choose secondary color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_secondary_color" name="secondary-color" value="#000000">
                    </div>
                    <div class="rm199_input--row">
                        <label for="choose_text_color" style="min-width: 220px;"><?php _e('Choose text color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_text_color" name="text-color" value="#ffffff">
                    </div>
                </div>
            </div>



            <!-- start the right column  -->
            <div class="rm199__home_col--sm">
                <!-- generate shortcode  -->
                <div class="generator_box">
                    <!-- todo : add a preview feature  -->
                    <h2 class="generator_box__header"><span><?php _e('Generate ShortCodes', 'rm199') ?></span></h2>
                    <div class="generator_box__content">
                        ddddddd
                    </div>
                    <div class="generator_box__btn">
                        <a href="#" class="generator_box__btn_cancel" onclick="location.reload()"><?php _e('Clear page', 'rm199') ?></a>
                        <button type="submit" class="button button-primary button-large " name="generate_shortcode" id="generate_shortcode" onclick="generate_shortcode()"><?php _e('Generate ShortCodes', 'rm199') ?></button>
                        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="rm199_generator_form" name="rm199Generate">
                            <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                            <button type="submit" class="button button-primary button-large " name="save_shortcode" id="save_shortcode"><?php _e('Publish', 'rm199') ?></button>
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

        <!-- start the overlay shortcode box  -->
        <div class="shortcodes_box--container">
            <span class="shortcodes_box_backdrop" onclick="closeSshortcodeBox()"></span>
            <div class="shortcodes_box">
                <div class="shortcodes_box_content">
                    <div class="mb-4">
                        <h3 class="m-0"><?php _e('Generated ShotCodes', 'rm199') ?></h3>
                        <small><?php _e('Copy the ShortCode and Paste into any post, page or inside your code', 'rm199') ?></small>
                    </div>
                    <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
                        <div class="rm199_input">
                            <label for="shortcode_for_recommendations"><?php _e('ShortCode for Recommendations', 'rm199') ?></label>
                            <div class="rm199_input__shortcode_action">
                                <input type="text" readonly id="shortcode_for_recommendations" name="shortcode_for_recommendations" value="dvdvdvdvdv">
                                <button class="button" onclick="copy_shortcode_for_recommendations()"><?php _e('Copy', 'rm199') ?></button>
                            </div>
                        </div>
                        <div class=" rm199_input">
                            <label for="shortcode_for_user_preferences"><?php _e('ShortCode for User Keywords', 'rm199') ?></label>
                            <div class="rm199_input__shortcode_action">
                                <input type="text" readonly id="shortcode_for_user_preferences" name="shortcode_for_recommendations" value="">
                                <button class="button" onclick="copy_shortcode_for_user_preferences()"><?php _e('Copy', 'rm199') ?></button>
                            </div>
                        </div>
                        <!-- all options  -->
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <input type="hidden" name="rm199_shortcode_content" class="rm199_shortcode_content" value="">
                        <button type="submit" class="button button-primary button-large " name="save_shortcode__from_popup"><?php _e('Publish', 'rm199') ?></button>
                    </form>
                </div>
                <span class="dashicons dashicons-no-alt cursor-pointer" onclick="closeSshortcodeBox()"></span>
            </div>
        </div>
        <?php
        // insert the shortcode into database 
        if (isset($_POST['save_shortcode']) || isset($_POST['save_shortcode__from_popup'])) {
            // check if user can (editposts)
            // dashboard_content::insertShortcodeIntoDatabase();
            global $wpdb;
            $current_user = wp_get_current_user();
            // $rm199_shortcode_content = $_POST['rm199_shortcode_content'];
            // $rm199_shortcode_content = '[rm199_posts title="Recommended for you:"   latest_posts="true"  show_for_all_users="true"  number_of_posts="3"   main_color="#0073aa"   secondary_color="#000000"   text_color="#ffffff"   postTypes="all"   template=""   categories="all" tags="all" ]';
            // create nonce 
            $code = 515151;
            $rm199_shortcode_content = json_encode([
                "title" => "Recommended for you:",
                "can_user_select_keywords" => false,
                "show_only_for_loggedin_users" => false,
                "number_of_items" => 5,
                "post_types" => "posts",
                "categories" => null,
                "tags" => null,
                "main_color" => "#000",
                "secondary_color" => "#f00",
                "text_color" => "#00f",
                "template" => "minimal"
            ]);
            $created_by = $current_user->ID;
            $table_name = $wpdb->prefix . 'rm199_shortcodes';
            // $data_json = json_decode()
            $wpdb->insert(
                $table_name,
                array(
                    'code' => $code,
                    'options' => $rm199_shortcode_content,
                    'created_by' => $created_by,
                    'created_in' => current_time('mysql')
                )
            );
        }
        ?>
<?php
    }

    // public static function insertShortcodeIntoDatabase()
    // {
    // }
}
