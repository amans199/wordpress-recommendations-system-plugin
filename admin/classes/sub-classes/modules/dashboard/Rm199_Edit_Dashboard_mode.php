<?php
if (!defined('ABSPATH')) {
    exit;
}

// dashboard mode : edit shortcode 
class Rm199_Edit_Dashboard_mode
{
    public static function dashboard_edit_mode()
    {
        // echo '<br><br><br><br>' .  $_GET['edit_shortcode'];
        $edit_shortcode = $_GET['edit_shortcode'];
        global $wpdb;

        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$edit_shortcode");
        if (!empty($results)) {
            $shortcode_decoded = json_decode($results[0]->options, true);
            print_r($shortcode_decoded);

?>

            <div class="rm199__home_col--lg">
                <h2 style="margin-top: 0px;"><?php _e('General ', 'rm199') ?></h2>

                <!-- title -->
                <div class="rm199_input">
                    <label for="rm199__title_input"><?php _e('Title', 'rm199') ?></label>
                    <input id="rm199__title_input" type="text" placeholder="<?php _e('We Recommend You Those Posts', 'rm199') ?>" onkeyup="rm199_title(this.value)" aria-describedby="rm199__title" value="<?php echo (isset($shortcode_decoded['title']) ? $shortcode_decoded['title'] : ''); ?>">
                    <small id="rm199__title"><?php _e('This Title is shown to the Users', 'rm199') ?></small>
                </div>

                <!-- Description -->
                <div class="rm199_input">
                    <label for="rm199__description_input"><?php _e('Description', 'rm199') ?></label>
                    <input id="rm199__description_input" type="text" placeholder="<?php _e('Enter a Description here', 'rm199') ?>" onkeyup="rm199_description(this.value)" aria-describedby="rm199__description" value="<?php echo (isset($shortcode_decoded['description']) ? $shortcode_decoded['description'] : ''); ?>">
                    <small id="rm199__description"><?php _e('What do you want this Shortcode to do !? ', 'rm199') ?></small>
                </div>

                <!-- filter by keyword -->
                <div class="rm199_input--row">
                    <input type="checkbox" id="filter_by_keyword" onclick="rm199_filter_by_keyword()" <?php echo ($shortcode_decoded['can_user_select_keywords'] == 'true' ?  'checked' : ''); ?>>
                    <label for="filter_by_keyword"><?php _e('Allow users to select Keywords', 'rm199') ?></label>
                </div>
                <!-- show only for logged in -->
                <div class="rm199_input--row">
                    <input type="checkbox" id="show_only_for_loggedin_users" onclick="rm199_show_only_for_loggedin_users()" <?php echo ($shortcode_decoded['show_only_for_loggedin_users'] == 'true' ? 'checked' : ''); ?>>
                    <label for="show_only_for_loggedin_users"><?php _e('Show Only For Logged In Users', 'rm199') ?></label>
                </div>

                <!-- number of posts to display -->
                <div class="rm199_input--row">
                    <label for="number_of_posts_2_show" class="mx-2"><?php _e('Number of Items', 'rm199') ?></label>
                    <input type="number" id="number_of_posts_2_show" name="number_of_posts_2_show" placeholder="<?php _e('3', 'rm199') ?>" style="max-width:80px;" min="-1" max="10" onkeyup="rm199_number_of_posts(this.value)" onchange="rm199_number_of_posts(this.value)" value="<?php echo (isset($shortcode_decoded['number_of_items']) ? $shortcode_decoded['number_of_items'] : ''); ?>">
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
                    $all_post_types = "";
                    $chosen_post_type = "";
                    if (isset($shortcode_decoded['post_types'])) {
                        if (strpos($shortcode_decoded['post_types'], ',')) {
                            $post_types_array = explode(",", $shortcode_decoded['post_types']);
                            for ($i = 0; $i < count($post_types_array); $i++) {
                                $all_post_types .= $post_types_array[$i] . (($i + 1) != count($post_types_array) ? ',' : '');
                            }
                        } else {
                            $chosen_post_type = $shortcode_decoded['post_types'];
                        }
                    }

                    $args = array(
                        'public'   => true,
                    );
                    // $output = 'objects'; // 'names' or 'objects' (default: 'names')
                    // $operator = 'and'; // 'and' or 'or' (default: 'and')
                    $post_types = get_post_types($args, 'objects');
                    if ($post_types) { // If there are any custom public post types.
                    ?>
                        <select name="rm199_post_type" id="rm199_post_type" onchange="rm199_post_type(this.value)" <?php echo ($all_post_types != '' ? 'disabled' : ''); ?>>
                            <option value="all"><?php _e('All', 'rm199') ?></option>
                            <?php foreach ($post_types  as $post_type) { ?>
                                <option value="<?php echo $post_type->name ?>" <?php echo ($chosen_post_type == $post_type->name ? 'selected' : ''); ?>><?php echo $post_type->labels->name ?></option>
                            <?php } ?>
                        </select>
                    <?php
                    }
                    ?>
                    <a style="margin-left:20px;margin-right:20px;" href="#" onclick="togglePostTypesBox()">
                        <?php _e('Or add more than one post type', 'rm199') ?></a>
                </div>
                <!-- add any number of post types  -->
                <div class="rm199_input rm199_input_more_post_types" <?php echo ($all_post_types != '' ?: 'style="display: none;"'); ?>>
                    <button class="rm199_input_more_post_types__close" onclick="togglePostTypesBox()">X</button>
                    <p id="rm199__more_post_types_input_info"> <?php _e('Add any Number of post types separated with commas', 'rm199') ?></p>
                    <input id="rm199__more_post_types_input" type="text" aria-describedby="rm199__more_post_types_input_info" placeholder="<?php _e('posts,products,materials', 'rm199') ?>" onkeyup="rm199_post_type(this.value)" value="<?php echo ($all_post_types ?: ''); ?>">
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
                    <div class="rm199_input--column">
                        <label for="choose_text_color" style="min-width: 220px;"><?php _e('Add Custom CSS', 'rm199') ?></label><br><br>
                        <textarea name="code-custom-css" class="w-100" id="code_custom_css" rows="10" onchange="choose_code_custom_css(this.value)" placeholder="<?php _e('.rm199_post__link {color:#000;}', 'rm199') ?>"></textarea>
                    </div>
                </div>
            </div>

<?php
        } else {
            echo '<h2>' .  _e('Sorry, an Error occurred', 'rm199') . '</h2>';
        }
    }
}