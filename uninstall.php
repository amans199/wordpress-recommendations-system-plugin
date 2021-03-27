<?php

defined('ABSPATH') or die();

global $wpdb;
$shortcodes_table = $wpdb->prefix . 'rm199_shortcodes';
$topbar_options_table = $wpdb->prefix . 'rm199_topbar';
$wpdb->query("DROP TABLE IF EXISTS $shortcodes_table");
$wpdb->query("DROP TABLE IF EXISTS $topbar_options_table");
