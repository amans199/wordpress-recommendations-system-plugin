<?php
if (!defined('ABSPATH')) {
    die();
}

// if the user not logged in or if user not allowed to register preferences show the latest posts

class NoUserPreferencesRm199
{
    function __construct()
    {
        include_once('SetPostViewsCounter_Rm199_class.php');
    }

    public static function showPosts($attr, $parsed_options)
    {
        $args = array(
            'posts_per_page' => ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3),
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {

            echo '<div class="rm199_front">';
            if (isset($parsed_options['title'])) {
                echo '<h2 class="rm199_front__title">' . $parsed_options['title'] . '</h2>';
            }
            while ($query->have_posts()) {
                $query->the_post();

                // ===================== post's views counter 
                $set_post_views_counter = new SetPostViewsCounter_Rm199_class();
                $set_post_views_counter->setPostViews(get_the_ID());
                // Remove issues with prefetching adding extra views
                remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
                // ===================== post's views counter 

                ob_start(); ?>

                <a href="<?php the_permalink(); ?>" class="rm199_front__post__link"><?php the_title(); ?></a>
                <?php echo get_the_post_thumbnail('thumbnail'); ?>
                <!-- /* todo :  here add code what you need to display like above title, image and more */ -->

<?php  }
            echo '</div>';
            wp_reset_postdata();
            return ob_get_clean();
        }
    }
}
