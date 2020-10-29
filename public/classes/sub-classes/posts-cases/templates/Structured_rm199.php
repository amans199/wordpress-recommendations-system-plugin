<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Structured_Template
{
    public static function structured_template_creator($id)
    {
        // $post = get_post($id);
        // $title = $post->post_title;
        // $excerpt = $post->post_excerpt;
?>
        <!-- <?php //echo get_the_post_thumbnail('thumbnail'); 
                ?>
        <a href="<?php // echo get_the_permalink(); 
                    ?>" class="rm199_post__link">
            <?php // echo get_the_title(); 
            ?>
        </a>
        <p><?php // echo get_the_excerpt(); 
            ?></p> -->
        <?php

        $categories = get_the_category();
        // if (!empty($categories)) {
        //     echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
        // }
        // foreach ($categories as $category) {
        //     echo $category->name;
        // }
        ?>
        <article class="article">

            <?php

            if (has_post_thumbnail()) {
                $image = get_the_post_thumbnail_url();
            } else {
                $image =  plugins_url() . '/recommendations-master/assets/images/no_image_available.svg.png';
            }

            echo '<a href="' . get_permalink() . '" title="' . esc_attr(get_the_title()) . '">';
            ?>
            <figure>
                <img src="<?php echo $image; ?>" alt="<?php echo  esc_attr(get_the_title()); ?>">
                <figcaption>
                    <h3 class="article__category">
                        <?php
                        $categories = get_the_category();
                        $separator = ' ';
                        $output = '';
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'rm199'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                            }
                            echo trim($output, $separator);
                        }
                        ?>
                    </h3>
                </figcaption>
            </figure>
            <?php
            echo '</a>';
            ?>


            <a href="<?php echo get_permalink(); ?>" class="text-decoration-none">
                <h2 class="article__title"><?php echo esc_html(get_the_title()); ?></h2>
                <p class="article__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
            </a>
        </article>

<?php
    }
}
