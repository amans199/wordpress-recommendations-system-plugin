<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Transitioned_Template
{
    public static function transitioned_template_creator($rm199_mode)
    {
        if ($rm199_mode === 'public') {
            $post_url =  esc_url(get_the_permalink());
            $title =  esc_html(get_the_title());
        } else {
            $post_url =   "#";
            $title =  _e('Example Post Title', 'rm199');
        }

?>
        <!-- testing  -->
        <div class="articles">
            <li class="articles__article" style="--animation-order:1">
                <a class="articles__link" href="<?php echo $post_url; ?>">
                    <div class="articles__content articles__content--lhs">
                        <h2 class="articles__title"><?php echo  $title; ?></h2>
                    </div>
                    <div class="articles__content articles__content--rhs" aria-hidden="true">
                        <h2 class="articles__title"><?php echo  $title; ?></h2>
                    </div>
                </a>
            </li>
        </div>
        <!-- end testing  -->
<?php
    }
}
