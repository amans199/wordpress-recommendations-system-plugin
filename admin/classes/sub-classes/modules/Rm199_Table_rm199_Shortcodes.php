<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199TableRm199Shortcodes
{

    public static function table_Structure()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_in  DESC");
        if (!empty($results)) {
?>
            <table class="rm199_table">
                <thead>
                    <tr>
                        <th scope="col"><?php _e('ShortCode', 'rm199'); ?></th>
                        <th scope="col"><?php _e('Description', 'rm199'); ?></th>
                        <th scope="col"><?php _e('Created In', 'rm199'); ?></th>
                        <th scope="col"><?php _e('Created By', 'rm199'); ?></th>
                        <th scope="col"><?php _e('Actions', 'rm199'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // to do get the parameter of shortcode_id from url to highlight the recently added rm-pack
                    foreach ($results as $row) {
                        $parsed_options = json_decode($row->options, true);

                    ?>
                        <tr onmouseover="table_mOvr(this,'#ddd');" onmouseout="table_mOut(this,'#f8f8f8');">
                            <td data-label="<?php _e('ShortCode', 'rm199'); ?>"><?php echo  '[rm199_posts id=' . $row->code . ']'; ?></td>
                            <td data-label="<?php _e('', 'rm199'); ?>"><?php
                                                                        if (array_key_exists('description', $parsed_options)) {
                                                                            if ($parsed_options['description'] !== "") {
                                                                                echo $parsed_options['description'];
                                                                            } else {
                                                                                echo __('No Description', 'rm199');
                                                                            }
                                                                        } else {
                                                                            echo __('No Description', 'rm199');
                                                                        }
                                                                        ?></td>
                            <td data-label="<?php _e('Created In', 'rm199'); ?>"><?php echo $row->created_in; ?></td>
                            <td data-label="<?php _e('Created By', 'rm199'); ?>">
                                <a href="<?php echo esc_url(get_author_posts_url($row->created_by)); ?>" title="<?php echo esc_attr(get_the_author_meta('user_login', $row->created_by)); ?>"><?php echo esc_attr(get_the_author_meta('user_login', $row->created_by)); ?></a>
                            </td>

                            <td data-label="<?php _e('Actions', 'rm199'); ?>" class="d-flex">
                                <button class="rm199_btn rm199_btn_edit cursor-pointer d-flex align-items-center " title="<?php _e('Edit', 'rm199'); ?>" style="text-decoration: none;margin:auto;">
                                    <span style="text-decoration: none;" class="dashicons dashicons-edit "></span>
                                </button>
                                <button class="rm199_btn rm199_btn_info cursor-pointer d-flex align-items-center " title="<?php _e('More Info and Stats', 'rm199'); ?>" style="text-decoration: none;margin:auto;">
                                    <span style="text-decoration: none;" class="dashicons dashicons-chart-line "></span>
                                </button>
                                <button class="rm199_btn rm199_btn_danger cursor-pointer d-flex align-items-center " title="<?php _e('Delete', 'rm199'); ?>" style="text-decoration: none;margin:auto;">
                                    <span style="text-decoration: none;" class="dashicons dashicons-trash "></span>

                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        <?php
        } else {
        ?>
            <h1>
                <?php _e('No Recommendation Packs', 'rm199'); ?>
            </h1>
            <a href="/wp-admin/admin.php?page=rm199_dashboard" rel="noopener noreferer"><button class="button button-primary button-large " onclick=""><?php _e('Create a New Pack', 'rm199') ?></button></a>
<?php
        }
    }
}
