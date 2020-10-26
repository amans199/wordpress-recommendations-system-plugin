<?php
if (!defined('ABSPATH')) {
    exit;
}

// dashboard mode : edit shortcode 
class Rm199_Edit_Dashboard_mode
{
    public static function dashboard_edit_mode($results, $shortcode_decoded)
    {
        // 

        $code = isset($shortcode_decoded['code']) ? $shortcode_decoded['code'] : '';
        $title = isset($shortcode_decoded['title']) ? $shortcode_decoded['title'] : '';
        $description = isset($shortcode_decoded['description']) ? $shortcode_decoded['description'] : '';
        $can_user_select_keywords = isset($shortcode_decoded['can_user_select_keywords']) ? ($shortcode_decoded['can_user_select_keywords'] == 'true' ?  'checked' : '') : '';
        $show_only_for_loggedin_users = isset($shortcode_decoded['show_only_for_loggedin_users']) ? ($shortcode_decoded['show_only_for_loggedin_users'] == 'true' ?  'checked' : '') : '';
        $number_of_items = isset($shortcode_decoded['number_of_items']) ? $shortcode_decoded['number_of_items'] : '';
        $post_types = isset($shortcode_decoded['post_types']) ? $shortcode_decoded['post_types'] : '';
        $categories = isset($shortcode_decoded['categories']) ? $shortcode_decoded['categories'] : '';
        $tags = isset($shortcode_decoded['tags']) ? $shortcode_decoded['tags'] : '';
        $template = isset($shortcode_decoded['template']) ? $shortcode_decoded['template'] : 'minimal';
        $main_color = isset($shortcode_decoded['main_color']) ? $shortcode_decoded['main_color'] :  '#0073aa';
        $secondary_color = isset($shortcode_decoded['secondary_color']) ? $shortcode_decoded['secondary_color'] : '#000000';
        $text_color = isset($shortcode_decoded['text_color']) ? $shortcode_decoded['text_color'] : '#ffffff';
        $custom_styles =  isset($results[0]->custom_styles) ?   $results[0]->custom_styles : '';
?>

        <div class="rm199__home_col--lg">
            <h2 style="margin-top: 0px;"><?php _e('General ', 'rm199') ?></h2>

            <!-- title -->
            <div class="rm199_input">
                <label for="rm199__title_input"><?php _e('Title', 'rm199') ?></label>
                <input id="rm199__title_input" type="text" placeholder="<?php _e('We Recommend You Those Posts', 'rm199') ?>" onkeyup="rm199_title(this.value)" aria-describedby="rm199__title" value="<?php echo $title; ?>">
                <small id="rm199__title"><?php _e('This Title is shown to the Users', 'rm199') ?></small>
            </div>

            <!-- Description -->
            <div class="rm199_input">
                <label for="rm199__description_input"><?php _e('Description', 'rm199') ?></label>
                <input id="rm199__description_input" type="text" placeholder="<?php _e('Enter a Description here', 'rm199') ?>" aria-describedby="rm199__description" value="<?php echo $description; ?>">
                <small id="rm199__description"><?php _e('What do you want this Shortcode to do !? ', 'rm199') ?></small>
            </div>

            <!-- filter by keyword -->
            <div class="rm199_input--row">
                <input type="checkbox" id="filter_by_keyword" <?php echo $can_user_select_keywords; ?>>
                <label for="filter_by_keyword"><?php _e('Allow users to select Keywords', 'rm199') ?></label>
            </div>
            <!-- show only for logged in -->
            <div class="rm199_input--row">
                <input type="checkbox" id="show_only_for_loggedin_users" <?php echo $show_only_for_loggedin_users; ?>>
                <label for="show_only_for_loggedin_users"><?php _e('Show Only For Logged In Users', 'rm199') ?></label>
            </div>

            <!-- number of posts to display -->
            <div class="rm199_input--row">
                <label for="number_of_posts_2_show" class="mx-2"><?php _e('Number of Items', 'rm199') ?></label>
                <input type="number" id="number_of_posts_2_show" name="number_of_posts_2_show" placeholder="<?php _e('3', 'rm199') ?>" style="max-width:80px;" min="-1" max="10" onkeyup="rm199_number_of_posts(this.value)" onchange="rm199_number_of_posts(this.value)" value="<?php echo $number_of_items; ?>">
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
                if ($post_types != '') {
                    if (strpos($post_types, ',')) {
                        $post_types_array = explode(",", $post_types);
                        for ($i = 0; $i < count($post_types_array); $i++) {
                            $all_post_types .= $post_types_array[$i] . (($i + 1) != count($post_types_array) ? ',' : '');
                        }
                    } else {
                        $chosen_post_type = $post_types;
                    }
                }

                $args = array(
                    'public'   => true,
                );
                $post_types = get_post_types($args, 'objects');
                if ($post_types) { // If there are any custom public post types.
                ?>
                    <select name="rm199_post_type" id="rm199_post_type" <?php echo ($all_post_types != '' ? 'disabled' : ''); ?>>
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
                <div class="all_posttypes d-flex" style="gap:10px; margin-bottom: 10px;flex-wrap: wrap;">
                    <?php
                    $post_types = get_post_types(array('public' => true, '_builtin' => true), 'names', 'and');
                    // remove attachment from the list
                    unset($post_types['attachment']);
                    foreach ($post_types  as $post_type) { ?>
                        <a onclick="add_to_types_list(event,'rm199__more_post_types_input')" class="button"><?php echo  $post_type; ?></a>
                    <?php } ?>
                </div>
                <input id="rm199__more_post_types_input" type="text" aria-describedby="rm199__more_post_types_input_info" placeholder="<?php _e('posts,products,materials', 'rm199') ?>" value="<?php echo ($all_post_types ?: ''); ?>">
            </div>
            <!-- end post type customizer  -->

            <!-- start category customizer  -->

            <?php
            $all_categories = "";
            $chosen_category = "";
            if ($categories != '') {
                if (strpos($categories, ',')) {
                    $categories_array = explode(",", $categories);
                    for ($i = 0; $i < count($categories_array); $i++) {
                        $all_categories .= $categories_array[$i] . (($i + 1) != count($categories_array) ? ',' : '');
                    }
                } else {
                    $chosen_category = $categories;
                }
            }

            ?>


            <div class="rm199_input--row">
                <!-- display all categories  -->
                <label for="rm199_categories" class="mx-2"><?php _e('Category', 'rm199') ?></label>
                <select name="rm199_categories" id="rm199_categories" <?php echo ($all_categories != '' ? 'disabled' : ''); ?>>
                    <option value="all"><?php _e('All', 'rm199') ?></option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->name ?>" <?php echo ($chosen_category == $category->name ? 'selected' : ''); ?>><?php echo $category->name ?></option>
                    <?php  } ?>
                </select>
                <a style="margin-left:20px;margin-right:20px;" href="#" onclick="toggleCategoryBox()"><?php _e('Or add more than one category', 'rm199') ?></a>
            </div>
            <!-- add any number of categories  -->
            <div class="rm199_input rm199_input_more_categories" <?php echo ($all_categories != '' ?: 'style="display: none;"'); ?>>
                <button class="rm199_input_more_categories__close" onclick="toggleCategoryBox()">X</button>
                <p id="rm199__more_categories_input_info"> <?php _e('Add any Number of categories separated with commas', 'rm199') ?></p>
                <div class="all_categories d-flex" style="gap:10px; margin-bottom: 10px;flex-wrap: wrap;">
                    <?php
                    $get_categories_args = array(
                        'hide_empty'      => true,
                    );
                    $all_categories_list = get_categories($get_categories_args);
                    // remove attachment from the list
                    foreach ($all_categories_list  as $category) { ?>
                        <a onclick="add_to_types_list(event,'rm199__more_categories_input')" class="button"><?php echo  $category->name; ?></a>
                    <?php } ?>
                </div>
                <input id="rm199__more_categories_input" type="text" aria-describedby="rm199__more_categories_input_info" placeholder="<?php _e('books,pants,shirts', 'rm199') ?>" value="<?php echo ($all_categories ?: ''); ?>">
            </div>
            <!-- end category customizer  -->


            <!-- start tags customizer  -->

            <?php
            $all_tags = "";
            $chosen_tag = "";
            if ($tags != '') {
                if (strpos($tags, ',')) {
                    $tags_array = explode(",", $tags);
                    for ($i = 0; $i < count($tags_array); $i++) {
                        $all_tags .= $tags_array[$i] . (($i + 1) != count($tags_array) ? ',' : '');
                    }
                } else {
                    $chosen_tag = $tags;
                }
            }
            ?>

            <div class="rm199_input--row">
                <label for="rm199_tags" class="mx-2"><?php _e('Tag', 'rm199') ?></label>
                <select name="rm199_tags" id="rm199_tags" <?php echo ($all_tags != '' ? 'disabled' : ''); ?>>
                    <option value="all"><?php _e('All', 'rm199') ?></option>
                    <?php
                    $tags = get_tags('post_tag');
                    foreach ($tags as $tag) { ?>
                        <option value="<?php echo $tag->name ?>" <?php echo ($chosen_tag == $tag->name ? 'selected' : ''); ?>><?php echo $tag->name ?></option>
                    <?php  } ?>
                </select>
                <a style="margin-left:20px;margin-right:20px;" href="#" onclick="toggleTagsBox()"><?php _e('Or add more than one tag', 'rm199') ?></a>
            </div>
            <!-- add any number of tags  -->
            <div class="rm199_input rm199_input_more_tags" <?php echo ($all_tags != '' ?: 'style="display: none;"'); ?>>
                <button class="rm199_input_more_tags__close" onclick="toggleTagsBox()">X</button>
                <p id="rm199__more_tags_input_info"> <?php _e('Add any Number of tags separated with commas', 'rm199') ?></p>
                <div class="all_categories d-flex" style="gap:10px; margin-bottom: 10px;flex-wrap: wrap;">
                    <?php
                    $all_tags_list = get_tags();
                    // remove attachment from the list
                    foreach ($all_tags_list  as $tag) { ?>
                        <a onclick="add_to_types_list(event,'rm199__more_tags_input')" class="button"><?php echo  $tag->name; ?></a>
                    <?php } ?>
                </div>
                <input id="rm199__more_tags_input" type="text" aria-describedby="rm199__more_tags_input_info" placeholder="<?php _e('football,english,europe', 'rm199') ?>" value="<?php echo ($all_tags ?: ''); ?>">
            </div>
            <!-- end tags customizer  -->



            <hr style="margin-bottom: 20px;">

            <!-- choose template for recommendations -->
            <h2><?php _e('Templates ', 'rm199') ?></h2>
            <div class="rm199_input--col">
                <div class="mb-4">
                    <input type="radio" id="minimal" name="template" value="minimal" onclick="template(this.value)" <?php echo ($template  != 'structured' ?  'checked' : ''); ?>>
                    <label for="minimal"><?php _e('Minimal', 'rm199') ?></label><br>
                    <label for="minimal"><img src="https://via.placeholder.com/500x150" alt="minimal-rm199" class="mt-2"></label>
                </div>
                <div class="mb-4">
                    <input type="radio" id="structured" name="template" value="structured" onclick="template(this.value)" <?php echo ($template == 'structured' ?  'checked' : ''); ?>>
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
                    <input class="mx-2" type="color" id="choose_main_color" name="main-color" value="<?php echo $main_color; ?>">
                </div>
                <div class="rm199_input--row">
                    <label for="choose_secondary_color" style="min-width: 220px;"><?php _e('Choose secondary color ', 'rm199') ?></label><br>
                    <input class="mx-2" type="color" id="choose_secondary_color" name="secondary-color" value="<?php echo $secondary_color; ?>">
                </div>
                <div class="rm199_input--row">
                    <label for="choose_text_color" style="min-width: 220px;"><?php _e('Choose text color ', 'rm199') ?></label><br>
                    <input class="mx-2" type="color" id="choose_text_color" name="text-color" value="<?php echo $text_color; ?>">
                </div>
                <?php
                // echo 'stttt ' . $results[0]->custom_styles;
                // print_r($results[0]);
                ?>
                <div class="rm199_input--column">
                    <label for="choose_text_color" style="min-width: 220px;"><?php _e('Add Custom CSS', 'rm199') ?></label><br><br>
                    <textarea name="code-custom-css" class="w-100" id="code_custom_css" rows="10" placeholder="<?php _e('.rm199_post__link {color:#000;}', 'rm199') ?>"><?php echo $custom_styles; ?></textarea>
                </div>
                <p>or <a class="cursor-pointer" target="_blank" href="https://www.linkedin.com/in/amans199/">contact me</a> to help you customize the best recommendations' templates for your website.</p>
            </div>
        </div>

<?php

    }
}
