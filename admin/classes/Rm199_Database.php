<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199Database
{
    public static function setup()
    {
        global $wpdb;
        $shortcodes_table = $wpdb->prefix . 'rm199_shortcodes';
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $shortcodes_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            code text NOT NULL,
            options json NOT NULL,
            custom_styles text,
            created_by int(11) NOT NULL,
            created_in datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
            ) $charset_collate";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // $settings_table = $wpdb->prefix . 'rm199_settings';
        // $sql = "CREATE TABLE $settings_table (
        //     id int(11) NOT NULL AUTO_INCREMENT,
        //     code text NOT NULL,
        //     toolbar_options json NOT NULL,
        //     custom_styles text,
        //     created_by int(11) NOT NULL,
        //     created_in datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        //     PRIMARY KEY (id)
        //     ) $charset_collate";
        // dbDelta($sql);
    }

    // public static function createDatabaseEntry($user, $current_user)
    // {
    //     global $wpdb;
    //     $name = $current_user->user_login;
    //     $id = $current_user->ID;
    //     $table_name = $wpdb->prefix . 'rm199_shortcodes';

    //     $wpdb->insert(
    //         $table_name,
    //         array(
    //             'user_id' => $id,
    //             'shortcode_content' => $name,
    //             'created_in' => current_time('mysql')
    //         )
    //     );
    // }
}
