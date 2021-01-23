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
        $shortcodes_table_sql = "CREATE TABLE $shortcodes_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            code text NOT NULL,
            options json NOT NULL,
            custom_styles text,
            created_by int(11) NOT NULL,
            created_in datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
            ) $charset_collate";
        $topbar_options_table = $wpdb->prefix . 'rm199_topbar';
        $topbar_options_table_sql = "CREATE TABLE $topbar_options_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            code text NOT NULL,
            options json NOT NULL,
            custom_styles text,
            created_by int(11) NOT NULL,
            created_in datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
            ) $charset_collate";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($shortcodes_table_sql);
        dbDelta($topbar_options_table_sql);
    }
}
