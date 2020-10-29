<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Minimal_Template
{
    public static function minimal_template_creator()
    {
?>
        <!-- <a href="<?php  // echo get_the_permalink(); 
                        ?>" class="rm199_post__link">
            <?php // echo get_the_title(); 
            ?>
        </a> -->
        <a id="rm199__post__title" rel="noopener noreferer" class="mr-2" href="#"><?php _e('Exampkle Post Title', 'rm199') ?></a>
<?php
    }
}
