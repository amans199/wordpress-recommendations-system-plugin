<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199Posts
{
    /**
     * The main Class to manage displaying posts/products based on Users' preferences ..
     *
     * @since    1.0.0
     */

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

        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $row_id = $attr['id'];
        $results = $wpdb->get_results("SELECT * FROM $table_name WHERE code='$row_id'");
        $parsed_options = json_decode($results[0]->options, true);
        if (!empty($results)) {
            print_r($parsed_options['can_user_select_keywords']);
        } else {
            echo 'no results';
        }


        // start testing 


        if (!empty($results) && (!$parsed_options['can_user_select_keywords'] || $parsed_options['latest_posts'] || !is_user_logged_in())) {            // get the latest posts 
            $args = array(
                'posts_per_page' => ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3),
                'orderby' => 'post_date',
                'order' => 'DESC',
                'post_type' => 'post',
                'post_status' => 'publish'
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                ob_start();
                // Rm199Posts::rm199_styles($main_color, $secondary_color, $text_color);

                // count all post views
                Rm199Posts::setPostViews(get_the_ID());
                // Remove issues with prefetching adding extra views
                remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

                echo '<div class="rm199_front__content">';
                if (isset($parsed_options['title'])) {
                    echo '<h2 class="rm199_frontend_title">' . $parsed_options['title'] . '</h2>';
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
            $specified_number_of_posts = ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3);
            $number_of_shown_posts = 0;

            $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);

            // $all_keywords = explode(",", trim($current_us11er_preferences[0]->post_content));
            // for ($i = 0; $i < count($current_user_preferences); $i++) {
            foreach ($current_user_preferences as $preference) {
                // if (!empty(trim($all_keywords[$i]))) {
                // get all posts that related to those preferences
                $query = new WP_Query('s=' . $preference);

                // set the query to specific post type 
                if (isset($parsed_options['postTypes'])) {
                    if (strpos($parsed_options['postTypes'], ',')) {
                        $custom_post_type = explode(",", $parsed_options['postTypes']);
                    } else {
                        $custom_post_type = $parsed_options['postTypes'];
                    }
                    $query->set('post_type', $custom_post_type);
                    $query->query($query->query_vars);
                }

                // set the query to specific category
                if (isset($parsed_options['categories'])) {
                    if (strpos($parsed_options['categories'], ',')) {
                        $custom_category = explode(",", $parsed_options['categories']);
                    } else {
                        $custom_category = $parsed_options['categories'];
                    }
                    $query->set('category_name',  $custom_category);
                    $query->query($query->query_vars);
                }

                // set the query to specific tag
                if (isset($parsed_options['tags'])) {
                    if (strpos($parsed_options['tags'], ',')) {
                        $custom_tag = explode(",", $parsed_options['tags']);
                    } else {
                        $custom_tag = $parsed_options['tags'];
                    }
                    $query->set('tag', $custom_tag);
                    $query->query($query->query_vars);
                }
                $do_not_duplicate = array();
                if ($query->have_posts()) {
                    ob_start();
                    echo '<div class="rm199_front__content">';

                    // Rm199Posts::rm199_styles($main_color, $secondary_color, $text_color);
                    // count all post views
                    Rm199Posts::setPostViews(get_the_ID());
                    // Remove issues with prefetching adding extra views
                    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


                    if (isset($parsed_options['title'])) {
                        echo '<h2 class="rm199_frontend_title">' . $parsed_options['title'] . '</h2>';
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




        // end testing 





    }
}
