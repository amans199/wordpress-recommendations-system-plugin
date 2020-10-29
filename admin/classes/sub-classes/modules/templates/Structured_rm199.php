<?php

if (!defined('ABSPATH')) {
    die();
}

class Rm199_Structured_Template
{
    public static function structured_template_creator()
    {
?>

        <article class="article">
            <figure>
                <img src="https://via.placeholder.com/150x150">
                <figcaption>
                    <h3 class="article__category">
                        Example-Category
                    </h3>
                </figcaption>
            </figure>
            <a href="#" class="text-decoration-none">
                <h2 class="article__title"><?php _e('Example Post Title', 'rm199') ?></h2>
                <p class="article__excerpt"><?php _e('Lorem ipsum dolor sit amet consectetur', 'rm199') ?>...</p>
            </a>
        </article>

<?php
    }
}
