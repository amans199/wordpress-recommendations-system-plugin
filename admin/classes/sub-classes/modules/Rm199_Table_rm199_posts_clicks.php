<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199TableRm199PostsClicks
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

    public static function postsClicks()
    {
        $the_query_args = array(
            'post_type' => 'post',
            'orderby'    => 'ID',
            'post_status' => 'publish',
            'order'    => 'DESC',
            'posts_per_page' => -1
        );

        $the_query = new WP_Query($the_query_args);

?>

        <table class="rm199_table">
            <thead>
                <tr>
                    <th scope="col"><?php _e('Title', 'rm199'); ?></th>
                    <th scope="col"><?php _e('Edit', 'rm199'); ?></th>
                    <!-- todo : clicks and views is not working yet  -->
                    <th scope="col"><?php _e('Clicks', 'rm199'); ?></th>
                    <th scope="col"><?php _e('Views', 'rm199'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post(); ?>
                        <tr onmouseover="table_mOvr(this,'#ddd');" onmouseout="table_mOut(this,'#f8f8f8');">
                            <td data-label="<?php _e('Title', 'rm199'); ?>"><a href="<?php the_permalink() ?>" target="_blank"><?php the_title(); ?><span class="dashicons dashicons-external mx-2"></span></a></td>
                            <td data-label="<?php _e('Edit', 'rm199'); ?>">
                                <a href="#" target="_blank" class="d-flex align-items-center justify-content-center" style="text-decoration: none;">
                                    <button class="button button-primary d-flex align-items-center " style="text-decoration: none;">
                                        <?php _e('Edit', 'rm199'); ?>
                                        <span style="text-decoration: none;" class="dashicons dashicons-external ml-2"></span>
                                    </button>
                                </a>
                            </td>
                            <td data-label="<?php _e('Clicks', 'rm199'); ?>">1213</td>
                            <td data-label="<?php _e('Views', 'rm199');  ?>"><?php echo Rm199TableRm199PostsClicks::getPostViews(get_the_ID()); ?></td>
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
