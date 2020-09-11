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

    public static function showPosts($attr, $parsed_options)
    {

        $specified_number_of_posts = ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3);
        $number_of_shown_posts = 0;

        $current_user_preferences = get_user_meta(get_current_user_id(), 'preferences', false);

        foreach ($current_user_preferences as $preference) {

            $query = new WP_Query('s=' . $preference);

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
        }

        $do_not_duplicate = array();
        if ($query->have_posts()) { // get all posts related to those preferences
            echo '<div class="rm199_front__content">';

            if (isset($parsed_options['title'])) {
                echo '<h2 class="rm199_frontend_title">' . $parsed_options['title'] . '</h2>';
            }
            while ($query->have_posts()) {
                $query->the_post();
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

                ob_start();
?>
                <a href="<?php echo get_the_permalink(); ?>" class="rm199_post__link">
                    <?php echo get_the_title(); ?>
                </a>
                <?php echo get_the_post_thumbnail('thumbnail'); ?>
<?php
            } //end while
            echo '</div>';
            wp_reset_postdata();
            return ob_get_clean();
        }
    } //end method :: showPosts
} //end class
