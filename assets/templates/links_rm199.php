<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Links_Template
{
    public static function links_template_creator($rm199_mode)
    {
        if ($rm199_mode === 'public') {
            $post_url =  esc_url(get_the_permalink());
            $title =  esc_html(get_the_title());
        } else {
            $post_url =   "#";
            $title =  __('Example Post Title', 'rm199');
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
        <a href="<?php echo $post_url;  ?>" class="rm199_post__link mr-1 my-1">
            <?php echo $first_words_of_title; ?>
        </a>
<?php
    }
}
