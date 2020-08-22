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
                    <input id="rm199__title_input" type="text" placeholder="<?php _e('We Recommend You Those Posts', 'rm199') ?>" onkeyup="rm199_title(this.value)">
                </div>

                <!-- filter by keyword -->
                <div class="rm199_input--row">
                    <input type="checkbox" id="filter_by_keyword" onclick="rm199_filter_by_keyword()">
                    <label for="filter_by_keyword"><?php _e('Allow users to select Keywords', 'rm199') ?></label>
                </div>

                <!-- show only for logged in -->
                <div class="rm199_input--row">
                    <input type="checkbox" id="show_only_for_loggedin_users" onclick="rm199_show_only_for_loggedin_users()">
                    <label for="show_only_for_loggedin_users"><?php _e('Show Only For Logged In Users', 'rm199') ?></label>
                </div>

                <!-- number of posts to display -->
                <div class="rm199_input--row">
                    <label for="number_of_posts_2_show" class="mx-2"><?php _e('Number of Items', 'rm199') ?></label>
                    <input type="number" id="number_of_posts_2_show" name="number_of_posts_2_show" placeholder="<?php _e('3', 'rm199') ?>" style="max-width:80px;" min="-1" max="10" onkeyup="rm199_number_of_posts(this.value)" onchange="rm199_number_of_posts(this.value)">
                    <!-- todo : add an ( all ) button to disable the input number and make it assigned to -1  -->
                </div>

                <!-- types of posts  -->
                <div class=" rm199_input--row">
                    <label for="rm199_post_type" class="mx-2"><?php _e('Type', 'rm199') ?></label>
                    <!-- display all post types in select box -->
                    <?php
                    // $dropdown_args = array(
                    //     'name'             => 'parent_id',
                    //     'show_option_none' => __('(no parent)'),
                    //     'sort_column'      => 'menu_order, post_title',
                    //     'echo'             => 0,
                    // );
                    // echo  wp_dropdown_pages($dropdown_args);

                    // echo   wp_dropdown_categories();

                    $args = array(
                        'public'   => true,
                    );
                    // $output = 'objects'; // 'names' or 'objects' (default: 'names')
                    // $operator = 'and'; // 'and' or 'or' (default: 'and')
                    $post_types = get_post_types($args, 'objects');
                    if ($post_types) { // If there are any custom public post types.
                    ?>
                        <select name="rm199_post_type" id="rm199_post_type" onchange="rm199_post_type(this.value)">
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
                    <input id="rm199__more_post_types_input" type="text" aria-describedby="rm199__more_post_types_input_info" placeholder="<?php _e('posts,products,materials', 'rm199') ?>" onkeyup="rm199_post_type(this.value)">
                </div>
                <!-- end post type customizer  -->

                <!-- start category customizer  -->
                <div class="rm199_input--row">
                    <!-- display all categories  -->
                    <label for="rm199_categories" class="mx-2"><?php _e('Category', 'rm199') ?></label>
                    <select name="rm199_categories" id="rm199_categories" onchange="rm199_categories(this.value)">
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
                    <input id="rm199__more_categories_input" type="text" aria-describedby="rm199__more_categories_input_info" placeholder="<?php _e('books,pants,shirts', 'rm199') ?>" onkeyup="rm199_categories(this.value)">
                </div>
                <!-- end category customizer  -->


                <!-- start tags customizer  -->
                <div class="rm199_input--row">
                    <label for="rm199_tags" class="mx-2"><?php _e('Tag', 'rm199') ?></label>
                    <select name="rm199_tags" id="rm199_tags" onchange="rm199_tags(this.value)">
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
                    <input id="rm199__more_tags_input" type="text" aria-describedby="rm199__more_tags_input_info" placeholder="<?php _e('football,english,europe', 'rm199') ?>" onkeyup="rm199_tags(this.value)">
                </div>
                <!-- end tags customizer  -->



                <hr style="margin-bottom: 20px;">

                <!-- choose template for recommendations -->
                <h2><?php _e('Templates ', 'rm199') ?></h2>
                <div class="rm199_input--col">
                    <div class="mb-4">
                        <input type="radio" id="minimal" name="template" value="minimal" onclick="template(this.value)">
                        <label for="minimal"><?php _e('Minimal', 'rm199') ?></label><br>
                        <label for="minimal"><img src="https://via.placeholder.com/500x150" alt="minimal-rm199" class="mt-2"></label>
                    </div>
                    <div class="mb-4">
                        <input type="radio" id="structured" name="template" value="structured" onclick="template(this.value)">
                        <label for="structured"><?php _e('Structured', 'rm199') ?></label><br>
                        <label for="structured"><img src="https://via.placeholder.com/500x150" alt="structured-rm199" class="mt-2"></label>
                    </div>

                    <!-- <a href="#"><?php //_e('Or Customize your own template', 'rm199') 
                                        ?></a> -->
                </div>
                <hr style="margin-bottom: 10px;">
                <div class="">
                    <h2 class="mr-2"><span class="dashicons dashicons-admin-customizer mr-2"></span><?php _e('Styles', 'rm199') ?></h2>
                    <!-- <button class="button button-primary ml-2 d-flex align-items-center"><span class="dashicons dashicons-admin-customizer mr-2"></span><?php //_e('Edit', 'rm199') 
                                                                                                                                                                ?></button> -->
                </div>
                <!-- style the keywords input  -->
                <div class="choose_global_styles">
                    <div class="rm199_input--row">
                        <label for="choose_main_color" style="min-width: 220px;"><?php _e('Choose your brand\'s main color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_main_color" name="main-color" value="#0073aa" onchange="choose_main_color(this.value)">
                    </div>
                    <div class="rm199_input--row">
                        <label for="choose_secondary_color" style="min-width: 220px;"><?php _e('Choose secondary color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_secondary_color" name="secondary-color" value="#000000" onchange="choose_secondary_color(this.value)">
                    </div>
                    <div class="rm199_input--row">
                        <label for="choose_text_color" style="min-width: 220px;"><?php _e('Choose text color ', 'rm199') ?></label><br>
                        <input class="mx-2" type="color" id="choose_text_color" name="text-color" value="#ffffff" onchange="choose_text_color(this.value)">
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
                        <!-- <h2><?php //_e('Overview', 'rm199') 
                                    ?></h2> -->
                        <h3 id="rm199__overview__title" class="m-0"><?php _e('Recommended for you:', 'rm199') ?></h3>
                        <div class="rm199__post rm199__post--overview d-flex align-items-center" style="justify-content: space-around;margin: 40px 0;">
                            <div id="rm199__structured__template" class="text-center">
                                <div id="rm199__post__img">
                                    <img src="https://via.placeholder.com/150x150" alt="amas199 post image" width="150" height="150" />
                                </div>
                                <a id="rm199__post__title" rel="noopener noreferer" href="#"><?php _e('Example Post Title', 'rm199') ?></a>
                                <p id="rm199__post__excerpt"><?php _e('Lorem ipsum dolor sit amet consectetur', 'rm199') ?>...</p>
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
                        <button type="submit" class="button button-primary button-large " name="generate_shortcode" id="generate_shortcode" onclick="generate_shortcode()"><?php _e('Generate ShortCodes', 'rm199') ?></button>
                        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="rm199_generator_form" name="rm199Generate">
                            <!-- all options  -->
                            <input type="hidden" name="rm199_so_title" id="rm199_so_title" value="">
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

        <?php
        if (!current_user_can('manage_options')) {
            exit;
        }

        // insert the shortcode's options into database 
        if (isset($_POST['save_shortcode']) && current_user_can('manage_options')) {

            global $wpdb;
            $current_user = wp_get_current_user();

            // create nonce 
            $code = 515151;
            $rm199_shortcode_content = json_encode([
                "title" => $_POST['rm199_so_title'] !== '' ? $_POST['rm199_so_title'] : "Recommended for you:",
                "can_user_select_keywords" => $_POST['rm199_so_can_user_select_keywords'] !== '' ? $_POST['rm199_so_can_user_select_keywords'] : false,
                "show_only_for_loggedin_users" => $_POST['rm199_so_show_only_for_loggedin_users'] !== '' ? $_POST['rm199_so_show_only_for_loggedin_users'] : false,
                "number_of_items" => $_POST['rm199_so_number_of_items'] !== '' ? $_POST['rm199_so_number_of_items'] : 3,
                "post_types" => $_POST['rm199_so_post_types'] !== '' ? $_POST['rm199_so_post_types'] : "all",
                "categories" => $_POST['rm199_so_categories'] !== '' ? $_POST['rm199_so_categories'] : "all",
                "tags" =>  $_POST['rm199_so_tags'] !== '' ? $_POST['rm199_so_tags'] : "all",
                "main_color" => $_POST['rm199_so_main_color'] !== '' ? $_POST['rm199_so_main_color'] : null,
                "secondary_color" => $_POST['rm199_so_secondary_color'] !== '' ? $_POST['rm199_so_secondary_color'] :  null,
                "text_color" => $_POST['rm199_so_text_color'] !== '' ? $_POST['rm199_so_text_color'] : null,
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
