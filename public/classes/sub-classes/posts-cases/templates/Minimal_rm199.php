<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Minimal_Template
{
    public static function minimal_template_creator($id)
    {
        // $post = get_post($id);
        // $title = $post->post_title;
        // $excerpt = $post->post_excerpt;

?>
        <a href="<?php echo get_the_permalink(); ?>" class="rm199_post__link">
            <?php echo get_the_title(); ?>
        </a>
<?php
    }
}
