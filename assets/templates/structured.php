<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Structured_Template
{
    public static function structured_template_creator($rm199_mode)
    {
        if ($rm199_mode === 'public') {
            $post_url =  get_permalink();
            $title =  esc_html(get_the_title());
            $excerpt = esc_html(get_the_excerpt());

            // categories 
            $categories = get_the_category();
            $separator = ' , ';
            $output = '';
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'rm199'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
                }
                $categories_output = trim($output, $separator);
            }
        } else {
            $post_url =  "#";
            $title =  __('Example Post Title', 'rm199');
            $excerpt =  __('Lorem ipsum dolor sit amet consectetur', 'rm199');
            $categories_output = __('Example-Category', 'rm199');
        }

        if (str_word_count($title) > 5) {
            $title_words_arr = explode(' ', trim($title));
            $first_5_words =  array_slice($title_words_arr, 0, 5, true);
            array_push($first_5_words, "...");
            $first_words_of_title = implode(" ", $first_5_words);
        } else {
            $first_words_of_title = $title;
        }
?>
        <article class="article">

            <?php

            if (has_post_thumbnail()) {
                $image = get_the_post_thumbnail_url();
            } else {
                $image =  plugins_url() . '/recommendations-master/assets/images/example_img.jpg';
            }

            echo '<a href="' . $post_url . '" title="' .  $first_words_of_title  . '">';
            ?>
            <figure>
                <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" <?php echo ($rm199_mode === 'admin' ? 'style="object-fit: contain;"' : ''); ?>>
                <figcaption>
                    <h3 class="article__category">
                        <?php echo $categories_output; ?>
                    </h3>
                </figcaption>
            </figure>
            <?php
            echo '</a>';
            ?>


            <a href="<?php echo $post_url; ?>" class="text-decoration-none">
                <h2 class="article__title"><?php echo $first_words_of_title; ?></h2>
                <p class="article__excerpt"><?php echo $excerpt; ?></p>
            </a>
        </article>

<?php
    }
}
