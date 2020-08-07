<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199_Table_rm199_posts_clicks
{
    public static function postsClicks()
    {
?>

        <table class="rm199_table">
            <thead>
                <tr>
                    <th scope="col"><?php _e('Post / Page Title', 'rm199'); ?></th>
                    <th scope="col"><?php _e('Edit Post / Page', 'rm199'); ?></th>
                    <!-- <th scope="col"><?php// _e('Clicks', 'rm199'); ?></th> -->
                    <!-- <th scope="col"><?php// _e('Views', 'rm199'); ?></th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="<?php _e('Title', 'rm199'); ?>"></td>
                    <td data-label="<?php _e('Edit', 'rm199'); ?>">
                        <a href="#" target="_blank" class="d-flex align-items-center justify-content-center" style="text-decoration: none;">
                            <button class="button button-primary d-flex align-items-center " style="text-decoration: none;">
                                <?php _e('Edit', 'rm199'); ?>
                                <span style="text-decoration: none;" class="dashicons dashicons-external ml-2"></span>
                            </button>
                        </a>
                    </td>
                    <!-- <td data-label="<?php //_e('Clicks', 'rm199'); 
                                            ?>">1213</td> -->
                    <!-- <td data-label="<?php //_e('Views', 'rm199'); 
                                            ?>">2234</td> -->
                </tr>
            </tbody>
        </table>

<?php
    }
}
