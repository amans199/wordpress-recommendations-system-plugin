<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199ShortcodesHandlerClass
{
    /**
     * The main Class for website's frontend ... it manages all the outputs that generated by the ShortCode which has been inserted by the admin
     *
     * @since    1.0.0
     */
    public static function rm199_styles($main_color, $secondary_color, $text_color)
    {
        /**
         * this function is responsible for editing the styles of the output based on the styles the admin has chosen
         */

?>

        <style>
            .rm199_frontend_title {
                color: <?php echo $text_color; ?>
            }

            .rm199__keyword,
            .submit_keyword {
                background: <?php echo $main_color; ?>;
            }

            .rm199__keyword .dashicons,
            .submit_keyword:hover {
                background: <?php echo $secondary_color; ?>;
            }
        </style>

        <?php
    }

    public static function setPostViews($postID)
    {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }

    public static function rm199_posts($attr)
    {
        /**
         * this function is responsible for looping and outputting the posts
         */

        $main_color = (isset($attr['main_color']) ? $attr['main_color'] . ' !important' : '#007cba');
        $secondary_color = (isset($attr['secondary_color']) ?  $attr['secondary_color'] . ' !important' : '#000');
        $text_color = (isset($attr['text_color'])  ? $attr['text_color']   . ' !important'  : '#007cba');



        if (!isset($attr['keywords_selection']) || isset($attr['latest_posts']) || !is_user_logged_in()) {            // get the latest posts 
            $args = array(
                'posts_per_page' => ($attr['number_of_posts'] ? $attr['number_of_posts'] : 3),
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                Rm199ShortcodesHandlerClass::rm199_styles($main_color, $secondary_color, $text_color);

                // count all post views
                Rm199ShortcodesHandlerClass::setPostViews(get_the_ID());
                // Remove issues with prefetching adding extra views
                remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

                echo '<div class="rm199_front__content">';
                if (isset($attr['title'])) {
                    echo '<h2 class="rm199_frontend_title">' . $attr['title'] . '</h2>';
                }
                while ($query->have_posts()) {
                    $query->the_post();
        ?>
                    <a href="<?php the_permalink(); ?>" class="rm199_post__link"><?php the_title(); ?></a>
                    <?php echo get_the_post_thumbnail('thumbnail'); ?>
                    <!-- /* here add code what you need to display like above title, image and more */ -->
                    <?php
                    // echo 'fbffb' . $main_color, $secondary_color, $text_color;
                }
                echo '</div>';
                // todo : test this reset 
                wp_reset_postdata();
                return ob_get_clean();
            }
        } else {  // get the posts based on the user's chosen keywords

            // get the user preferences
            // $args = array(
            //     'author'        =>   get_current_user_id(),
            //     'post_type' => 'user_preference'
            // );
            // $current_user_preferences = get_posts($args);
            $specified_number_of_posts = ($attr['number_of_posts'] ? $attr['number_of_posts'] : 3);
            $number_of_shown_posts = 0;

            $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);

            // $all_keywords = explode(",", trim($current_us11er_preferences[0]->post_content));
            // for ($i = 0; $i < count($current_user_preferences); $i++) {
            foreach ($current_user_preferences as $preference) {
                // if (!empty(trim($all_keywords[$i]))) {
                // get all posts that related to those preferences
                $query = new WP_Query('s=' . $preference);

                // // to provide a better ux => if used specified more than 5 keywords then the preferences will be shown as a one recommendation for every preference 
                // if (count($all_keywords) > 5) {
                //     $query->set('posts_per_page', 1);
                //     $query->query($query->query_vars);
                // }


                // set the query to specific post type 
                if (isset($attr['postTypes'])) {
                    if (strpos($attr['postTypes'], ',')) {
                        $custom_post_type = explode(",", $attr['postTypes']);
                    } else {
                        $custom_post_type = $attr['postTypes'];
                    }
                    $query->set('post_type', $custom_post_type);
                    $query->query($query->query_vars);
                }

                // set the query to specific category
                if (isset($attr['categories'])) {
                    if (strpos($attr['categories'], ',')) {
                        $custom_category = explode(",", $attr['categories']);
                    } else {
                        $custom_category = $attr['categories'];
                    }
                    $query->set('category_name',  $custom_category);
                    $query->query($query->query_vars);
                }

                // set the query to specific tag
                if (isset($attr['tags'])) {
                    if (strpos($attr['tags'], ',')) {
                        $custom_tag = explode(",", $attr['tags']);
                    } else {
                        $custom_tag = $attr['tags'];
                    }
                    $query->set('tag', $custom_tag);
                    $query->query($query->query_vars);
                }
                $do_not_duplicate = array();
                if ($query->have_posts()) {
                    ob_start();
                    echo '<div class="rm199_front__content">';

                    Rm199ShortcodesHandlerClass::rm199_styles($main_color, $secondary_color, $text_color);
                    // count all post views
                    Rm199ShortcodesHandlerClass::setPostViews(get_the_ID());
                    // Remove issues with prefetching adding extra views
                    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


                    if (isset($attr['title'])) {
                        echo '<h2 class="rm199_frontend_title">' . $attr['title'] . '</h2>';
                    }
                    while ($query->have_posts()) {
                        $query->the_post();
                        $number_of_shown_posts++;
                        // if (in_array(get_the_ID(), $do_not_duplicate)) {
                        // todo : fix this to prevent post duplication 
                        if (array_key_exists(get_the_ID(), $do_not_duplicate)) {
                            // print_r($do_not_duplicate);
                            // echo 'is is in already';
                            continue;
                        } else {
                            // array_push($do_not_duplicate, get_the_ID());
                            $do_not_duplicate[get_the_ID()] = get_the_ID();
                            // print_r($do_not_duplicate);
                        }


                        // break if number of posts === the specified number by admin 
                        if ($number_of_shown_posts  > $specified_number_of_posts) break;
                        // add_post_meta(get_the_ID(), "testtting", "vvv");

                    ?>
                        <a href="<?php echo get_the_permalink(); ?>" class="rm199_post__link">
                            <?php // echo $all_keywords[$i];
                            echo get_the_title() . ' gggggg'; ?></a>
                        <?php echo get_the_post_thumbnail('thumbnail'); ?>
<?php
                    } //end while
                    echo '</div>';
                    return ob_get_clean();
                    // }
                }
            }
        }
    }


    public static function rm199_input($attr)
    {
        // wp_enqueue_script('rm199-js', plugins_url() . '/recommendations-master/public/js/rm199.js');



        if (is_user_logged_in()) {
            $main_color = (isset($attr['main_color']) ? $attr['main_color'] . ' !important' : '#007cba');
            $secondary_color = (isset($attr['secondary_color']) ?  $attr['secondary_color'] . ' !important' : '#000');
            $text_color = (isset($attr['text_color'])  ? $attr['text_color']   . ' !important'  : '#007cba');
            ob_start();
            echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post" id="rm199_preferences_form" name="rm199Form" onSubmit="window.location.reload()">';
            echo '<p>';
            echo 'Preferences<br/>';
            echo '<input type="text" size="40" placeholder="add keywords spectated with commas" name="rm199_preferences" class="rm199_preferences"  value="' . (isset($_POST["rm199_preferences"]) ? esc_attr($_POST["rm199_preferences"]) : '') . '"  />';
            echo '</p>';
            // todo : create a select tags functionality to allow users to choose from all tags in website and categories
            echo '<p><input type="submit" name="rm199-submitted" value="' . __('Add Keyword', 'rm199') . '" class="submit_keyword"></p>';
            echo '</form>';
            $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);
            // <!-- todo : allow user to delete a preference from the list below  -->
            // $all_preferences_shown = explode(",", trim($current_user_preferences[0]->post_content));
            echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post" class="rm199__keywords">';
            echo '<span class="rm199__keywords__title">all preferences : </span>';
            // echo ' <input id="rm199_user" type="hidden" value="' . $current_user->user_login . '" />';
            // echo ' <input id="rm199_post_id" type="hidden" value="' . $current_user_preferences[0]->ID . '" />';
            // echo ' <input id="rm199_all_keywords" type="hidden" value="' . trim($current_user_preferences[0]->post_content) . '" />';
            // for ($p = 0; $p < count($all_preferences_shown); $p++) {
            Rm199ShortcodesHandlerClass::rm199_styles($main_color, $secondary_color, $text_color);
            Rm199ShortcodesHandlerClass::setPostViews(get_the_ID());
            // Remove issues with prefetching adding extra views
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


            foreach ($current_user_preferences as $preference) {
                // if (!empty(trim($all_preferences_shown[$p]))) {
                echo '
                <span class="rm199__keyword"><span class="rm199__keyword__content">' .  $preference . '</span> 
                <button name="delete-this-keyword" value="' .  $preference . '" onClick="deleteThisKeyword(event)" style="padding:0px;">
                <span class="dashicons dashicons-no-alt" style="top:0px"></span>
                </button>
                </span>';
                // }
            }
            echo '</form>';
            if (isset($_POST['delete-this-keyword'])) {
                delete_user_meta(get_current_user_id(), 'preferences', sanitize_text_field($_POST['delete-this-keyword']));
            }
            if (isset($_POST['rm199-submitted'])) {
                add_user_meta(get_current_user_id(), 'preferences', sanitize_text_field(wp_strip_all_tags($_POST["rm199_preferences"])));
            }
            return ob_get_clean();
        }
    }
}