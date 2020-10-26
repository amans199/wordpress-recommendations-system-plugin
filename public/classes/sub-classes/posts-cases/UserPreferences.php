<?php
if (!defined('ABSPATH')) {
    die();
}

// if the user is logged in and can add preferences
class UserPreferencesRm199
{
    function __construct()
    {
        include_once('SetPostViewsCounter_Rm199_class.php');
    }

    public static function showPosts($attr, $parsed_options, $custom_styles)
    {

        $specified_number_of_posts = ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3);
        $number_of_shown_posts = 0;

        $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);
        echo '<div class="rm199_front__content rm199__'  . $parsed_options['code'] . '" >';

        if (isset($parsed_options['title'])) {
            echo '<h2 class="rm199_frontend_title">' . $parsed_options['title'] . '</h2>';
        }
        $do_not_duplicate = array();

        foreach ($current_user_preferences as $preference) {
            if ($preference !== null) {
                // $query = new WP_Query('s=' . $preference);
                $query = new WP_Query(array('s' =>  $preference));

                if (isset($parsed_options['post_types'])) { // set the query post type 
                    if ($parsed_options['post_types'] !== 'all') {
                        if (strpos($parsed_options['post_types'], ',')) {
                            $custom_post_type = explode(",", $parsed_options['post_types']);
                        } else {
                            $custom_post_type = $parsed_options['post_types'];
                        }
                        $query->set('post_type', $custom_post_type);
                        $query->query($query->query_vars);
                    }
                } //end post_types

                if (isset($parsed_options['categories'])) {  // set the query category
                    if ($parsed_options['categories'] !== 'all') {
                        if (strpos($parsed_options['categories'], ',')) {
                            $custom_category = explode(",", $parsed_options['categories']);
                        } else {
                            $custom_category = $parsed_options['categories'];
                        }
                        $query->set('category_name',  $custom_category);
                        $query->query($query->query_vars);
                    }
                } // end categories

                if (isset($parsed_options['tags'])) { // set the query tag
                    if ($parsed_options['tags'] !== 'all') {
                        if (strpos($parsed_options['tags'], ',')) {
                            $custom_tag = explode(",", $parsed_options['tags']);
                        } else {
                            $custom_tag = $parsed_options['tags'];
                        }
                        $query->set('tag', $custom_tag);
                        $query->query($query->query_vars);
                    }
                } //end tags
                // print_r($parsed_options);
                if ($query->have_posts()) { // get all posts related to those preferences
?>
                    <!-- && todo : the style section's classes is not shown properly   -->
                    <style nonce="<?php echo wp_create_nonce('rm199'); ?>">
                        <?php $styles_exploded_to_selectors = explode("}", $custom_styles);
                        foreach ($styles_exploded_to_selectors as $selector) {
                            echo ' .rm199__' .  $parsed_options['code'] . ' ' .  $selector . '}';
                        }
                        ?>
                    </style>
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        if ($number_of_shown_posts  > $specified_number_of_posts - 1) break;  // get only number_of_items

                        $number_of_shown_posts++;
                        // echo 'eeeee';
                        // if (in_array(get_the_ID(), $do_not_duplicate)) {
                        // todo : fix this to prevent post duplication 
                        if (array_key_exists(get_the_ID(), $do_not_duplicate)) {
                            continue;
                        } else {
                            $do_not_duplicate[get_the_ID()] = get_the_ID();
                        }


                        // ===================== post's views counter 
                        $set_post_views_counter = new SetPostViewsCounter_Rm199_class();
                        $set_post_views_counter->setPostViews(get_the_ID());
                        // Remove issues with prefetching adding extra views
                        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
                        // ===================== post's views counter 

                    ?>
                        <a href="<?php echo get_the_permalink(); ?>" class="rm199_post__link">
                            <?php echo get_the_title(); ?>
                        </a>
                        <?php echo get_the_post_thumbnail('thumbnail'); ?>
            <?php
                    } //end while
                    wp_reset_postdata();
                }
            }
        }
        if ($number_of_shown_posts < $parsed_options['number_of_items']) {
            $queryIfNoPosts = new WP_Query(array(
                'numberposts' => $number_of_shown_posts - $parsed_options['number_of_items']
            ));
            // echo wp_count_posts('post')->publish;
            ?>
            <!-- && todo : the style section's classes is not shown properly   -->
            <style nonce="<?php echo wp_create_nonce('rm199'); ?>">
                <?php $styles_exploded_to_selectors = explode("}", $custom_styles);
                foreach ($styles_exploded_to_selectors as $selector) {
                    echo ' .rm199__' .  $parsed_options['code'] . ' ' .  $selector . '}';
                }
                ?>
            </style>
            <?php
            while ($queryIfNoPosts->have_posts()) {
                $queryIfNoPosts->the_post();
                $number_of_shown_posts++;

                // if (in_array(get_the_ID(), $do_not_duplicate)) {
                // todo : fix this to prevent post duplication 
                if (array_key_exists(get_the_ID(), $do_not_duplicate)) {
                    continue;
                } else {
                    $do_not_duplicate[get_the_ID()] = get_the_ID();
                }

                if ($number_of_shown_posts  > $specified_number_of_posts) break;  // get only number_of_items

                // ===================== post's views counter 
                $set_post_views_counter = new SetPostViewsCounter_Rm199_class();
                $set_post_views_counter->setPostViews(get_the_ID());
                // Remove issues with prefetching adding extra views
                remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
                // ===================== post's views counter 

            ?>
                <a href="<?php echo get_the_permalink(); ?>" class="rm199_post__link">
                    <?php echo get_the_title(); ?>
                </a>
                <?php echo get_the_post_thumbnail('thumbnail'); ?>
<?php
            } //end while
            wp_reset_postdata();
        }

        echo '</div>';
    } //end method :: showPosts
} //end class
