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
                            <td data-label="<?php _e('ShortCode', 'rm199'); ?>" class="d-flex align-items-center">
                                <input type="text" value="<?php echo  '[rm199_posts id=' . $row->code . ']'; ?>" readonly>
                                <!-- <span class="ml-2 dashicons dashicons-admin-page cursor-pointer" onclick="copy_shortcode_for_shortcode(event , '<?php // echo  '[rm199_posts id=' . $row->code . ']'; 
                                                                                                                                                        ?>')"></span> -->
                            </td>
                            <td data-label="<?php _e('', 'rm199'); ?>">
                                <?php
                                if (array_key_exists('description', $parsed_options)) {
                                    if ($parsed_options['description'] !== "") {
                                        echo $parsed_options['description'];
                                    } else {
                                        echo __('No Description', 'rm199');
                                    }
                                } else {
                                    echo __('No Description', 'rm199');
                                }
                                ?>
                            </td>
                            <td data-label="<?php _e('Created In', 'rm199'); ?>"><?php echo $row->created_in; ?></td>
                            <td data-label="<?php _e('Created By', 'rm199'); ?>">
                                <a href="<?php echo esc_url(get_author_posts_url($row->created_by)); ?>" title="<?php echo esc_attr(get_the_author_meta('user_login', $row->created_by)); ?>">
                                    <?php echo esc_attr(get_the_author_meta('user_login', $row->created_by)); ?>
                                </a>
                            </td>

                            <td data-label="<?php _e('Actions', 'rm199'); ?>" class="d-flex" style="width:50%;margin:auto">
                                <a href="/wp-admin/admin.php?page=rm199_dashboard&edit_shortcode=<?php echo $row->id ?>" rel="noopener noreferer" style="text-decoration: none;margin:auto">
                                    <button class="rm199_btn rm199_btn_edit cursor-pointer d-flex align-items-center " title="<?php _e('Edit', 'rm199'); ?>" style="text-decoration: none;margin:auto;">
                                        <span style="text-decoration: none;" class="dashicons dashicons-edit "></span>
                                    </button>
                                </a>
                                <!-- todo : create a popup box with all the stats needed for the shortcode -> just like views , clicks and bounce rate ... also give some advices about how to make it perform better  -->
                                <!-- <button class="rm199_btn rm199_btn_info cursor-pointer d-flex align-items-center " title="<?php //_e('More Info and Stats', 'rm199'); 
                                                                                                                                ?>" style="text-decoration: none;margin:auto;">
                                    <span style="text-decoration: none;" class="dashicons dashicons-chart-line "></span>
                                </button> -->
                                <form action="<?php echo esc_url($_SERVER['REQUEST_URI']) . '&req_id=' . $row->id; ?>" method="post" id="rm199_shortcode_actions" class="d-flex" style="margin:auto;">
                                    <input type="hidden" name="rm199_shrotcode_id" value="<?php echo $row->id ?>">

                                    <button type="submit" class="rm199_btn rm199_btn_danger cursor-pointer d-flex align-items-center " title="<?php _e('Delete', 'rm199'); ?>" style="text-decoration: none;margin:auto;" name="rm199_delete_shortcode">
                                        <span style="text-decoration: none;" class="dashicons dashicons-trash "></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php
                    if (!current_user_can('manage_options')) {
                        exit;
                    }

                    // delete  the shortcode from database 
                    if (isset($_POST['rm199_delete_shortcode']) && current_user_can('manage_options')) {
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'rm199_shortcodes';
                        $wpdb->delete($table_name, array('id' => $_POST['rm199_shrotcode_id']));
                        echo 'This ShortCode has been Deleted';
                        // header(esc_url($_SERVER['REQUEST_URI']));
                        // wp_redirect(esc_url($_SERVER['REQUEST_URI']));
                        echo '<script>Location.reload()</script>';
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
