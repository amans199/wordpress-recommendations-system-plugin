<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Rm199Database')) :

    class Rm199Database
    {
        private static function getShortcodesTableName()
        {
            global $wpdb;

            return $wpdb->prefix . 'rm199_shortcodes';
        }

        private static function getTopbarTableName()
        {
            global $wpdb;

            return $wpdb->prefix . 'rm199_topbar';
        }

        public static function setup()
        {
            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();
            $shortcodes_table =  self::getShortcodesTableName();

            $shortcodes_table_sql = "CREATE TABLE $shortcodes_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            code text NOT NULL,
            options json NOT NULL,
            custom_styles text,
            created_by int(11) NOT NULL,
            created_in datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
            ) $charset_collate";

            $topbar_options_table =  self::getTopbarTableName();
            $topbar_options_table_sql = "CREATE TABLE $topbar_options_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            enabled Boolean  DEFAULT 0 NOT NULL,
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
endif;
