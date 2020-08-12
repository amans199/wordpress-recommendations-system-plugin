<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199TableRm199Input
{
    public static function getPostViews($postID)
    {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0 View";
        }
        return $count . ' Views';
    }
    public static function keywords_table_structure()
    {
        $the_query_args = array(
            's' => 'rm199_input'
        );

        $the_query = new WP_Query($the_query_args);


?>
        <table class="rm199_table">
            <thead>
                <tr>
                    <th scope="col"><?php _e('Post / Page Title', 'rm199'); ?></th>
                    <th scope="col"><?php _e('Edit Post / Page', 'rm199'); ?></th>
                    <th scope="col"><?php _e('Views', 'rm199'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post(); ?>
                        <tr>
                            <td data-label="<?php _e('Title', 'rm199'); ?>"><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?><span class="dashicons dashicons-external mx-2"></span></a></td>
                            <td data-label="<?php _e('Edit', 'rm199'); ?>">
                                <a href="<?php echo get_edit_post_link(); ?>" target="_blank" class="d-flex align-items-center justify-content-center" style="text-decoration: none;">
                                    <button class="button button-primary d-flex align-items-center " style="text-decoration: none;">
                                        <?php _e('Edit', 'rm199'); ?>
                                        <span style="text-decoration: none;" class="dashicons dashicons-external ml-2"></span>
                                    </button>
                                </a>
                            </td>
                            <td data-label="<?php _e('Views', 'rm199');
                                            ?>"><?php echo Rm199TableRm199Input::getPostViews(get_the_ID()); ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>

<?php
    }
}
