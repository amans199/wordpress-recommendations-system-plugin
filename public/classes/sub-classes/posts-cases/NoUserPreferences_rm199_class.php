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
        include_once('templates/Minimal_rm199.php');
        include_once('templates/Structured_rm199.php');
    }

    public static function showPosts($attr, $parsed_options, $custom_styles)
    {
        $Rm199_Minimal_Template = new Rm199_Minimal_Template();
        $Rm199_Structured_Template = new Rm199_Structured_Template();

        $args = array(
            'posts_per_page' => ($parsed_options['number_of_items'] ? $parsed_options['number_of_items'] : 3),
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {

            echo '<div class="rm199_front rm199__'  . $parsed_options['code'] . '" >';
            if (isset($parsed_options['title'])) {
                echo '<h2 class="rm199_front__title">' . $parsed_options['title'] . '</h2>';
            }


?>
            <!-- todo : styles is not read in the public if the user is not signed in  && todo : the style section's classes is not shown properly -->
            <style nonce="<?php echo wp_create_nonce('rm199'); ?>">
                <?php $styles_exploded_to_selectors = explode("}", $custom_styles);
                foreach ($styles_exploded_to_selectors as $selector) {
                    echo ' .rm199__' .  $parsed_options['code'] . ' ' .  $selector . '}';
                }
                ?>
            </style>
            <div class="all_recommendations">
                <?php

                while ($query->have_posts()) {
                    $query->the_post();

                    // ===================== post's views counter 
                    $set_post_views_counter = new SetPostViewsCounter_Rm199_class();
                    $set_post_views_counter->setPostViews(get_the_ID());
                    // Remove issues with prefetching adding extra views
                    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
                    // ===================== post's views counter 

                    // todo : ob_start();
                ?>

                    <?php
                    if ($parsed_options['template'] === 'structured') {
                        $Rm199_Structured_Template->structured_template_creator(get_the_ID());
                    } else {
                        $Rm199_Minimal_Template->minimal_template_creator(get_the_ID());
                    }
                    ?>

    <?php
                } // end while

                wp_reset_postdata();
                // todo : ob_clean();
                echo '</div>';
                echo '</div>';
            }
        }
    }
