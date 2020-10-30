<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Minimal_Template
{
    public static function minimal_template_creator($rm199_mode)
    {
        if ($rm199_mode === 'public') {
            $post_url =  esc_url(get_the_permalink());
            $title =  esc_html(get_the_title());
        } else {
            $post_url =   "#";
            $title =  __('Example Post Title', 'rm199');
        }

?>
        <a href="<?php echo $post_url;  ?>" class="rm199_post__link effect1 text-decoration-none mr-1 my-1">
            <?php echo $title; ?>
        </a>
<?php
    }
}
