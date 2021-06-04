<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199_Menu_Class
{



    public static function createMenu()
    {
        add_menu_page(
            __('Recommendations', 'rm199'),
            __('Recommendations', 'rm199'),
            'manage_options',
            'rm199_manager',
            array('Rm199_Menu_Class', 'overviewCallback'),
            'dashicons-schedule'
        );
        add_submenu_page(
            'rm199_manager',
            __('Overview', 'rm199'),
            __('Overview', 'rm199'),
            'manage_options',
            'rm199_manager'
        );
        add_submenu_page(
            'rm199_manager',
            __('Dashboard', 'rm199'),
            __('Dashboard', 'rm199'),
            'manage_options',
            'rm199_dashboard',
            array('Rm199_Menu_Class', 'dashboardCallback')
        );
        add_submenu_page(
            'rm199_manager',
            __('Settings', 'rm199'),
            __('Settings', 'rm199'),
            'manage_options',
            'rm199_settings',
            array('Rm199_Menu_Class', 'settingsCallback')
        );
    }
    public static function dashboardCallback()
    {
        wp_enqueue_script('ajax_handler', plugins_url() . '/recommendations-master/admin/js/rm199.js', array('jquery'));
        wp_localize_script('ajax_handler', 'AjaxHandler', array('security' => wp_create_nonce('abc')));
        require('sub-classes/Rm199_Admin_Dashboard_Class.php');
        $dashboard_content = new Rm199_Admin_Dashboard_Class();
        $dashboard_content->dashboard_content();
    }

    public static function overviewCallback()
    {
        require('sub-classes/Rm199_Admin_Overview_Class.php');
        $overview_content = new Rm199_Admin_Overview_Class();
        $overview_content->overview_content();
    }

    public static function settingsCallback()
    {
        // if (is_admin())
        require('sub-classes/RM199_Settings.php');
        // $settings_page = new Rm199SettingsPage();
        // add_action('admin_init', array('Rm199SettingsPage', 'page_init'));

    }


    // public static function templateCreator()
    // {
    //     require('sub-classes/Rm199_Templates_Class.php');
    //     $template_creator = new Rm199TemplatesClass();
    //     $template_creator->allTemplates();
    // }
}
