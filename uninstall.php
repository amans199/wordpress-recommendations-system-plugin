<?php
// todo : it doesn't work : table doesn't get dropped after un installation

// if (!defined('ABSPATH')) {
//     die();
// }


// global $wpdb;

// $wpdb->prepare('SELECT * FROM xy WHERE id = %d',5);


// remember '' is different from ""  
// $wpdb->query('DROP TABLE IF EXISTS $table_name');
// $wpdb->query("DROP TABLE IF EXISTS $table_name");
class Rm199Uninstall
{

    public static function uninstall($wpdb)
    {
        if (!defined('WP_UNINSTALL_PLUGIN')) exit();
        global $wpdb;
        $table_name = $wpdb->prefix . 'rm199_shortcodes';
        $wpdb->query("DROP TABLE IF EXISTS $table_name");
    }
}
// delete_option("my_plugin_db_version");
