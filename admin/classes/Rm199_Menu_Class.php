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
            __('User Preferences', 'rm199'),
            __('User Preferences', 'rm199'),
            'manage_options',
            'rm199_preferences',
            array('Rm199_Menu_Class', 'preferencesCallback')
        );
        add_submenu_page(
            'rm199_manager',
            __('Settings', 'rm199'),
            __('Settings', 'rm199'),
            'manage_options',
            'rm199_settings',
            array('Rm199_Menu_Class', 'settingsCallback')
        );
        // add_submenu_page(
        //     'rm199_templates',
        //     __('All Templates', 'rm199'),
        //     __('All Templates', 'rm199'),
        //     'manage_options',
        //     'edit.php?post_type=rm_templates'
        // );
        // add_submenu_page(
        //     'rm199_manager',
        //     __('Templates', 'rm199'),
        //     __('Templates', 'rm199'),
        //     'manage_options',
        //     'rm199_templates',
        //     array('Rm199_Menu_Class', 'templateCreator')
        // );



        // add_submenu_page(
        //     'rm199_manager',
        //     __('rm sub manager', 'rm199'),
        //     __('Settings', 'rm199'),
        //     'manage_options',
        //     'rm199_settings',
        //     array('Rm199_Menu_Class', 'Settings')
        // );
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

    public static function preferencesCallback()
    {
        require('sub-classes/RM199_Users_Preferences.php');
        $preferences_customizer = new RM199_Users_Preferences();
        $preferences_customizer->customize_the_preferences_input();
    }
    public static function settingsCallback()
    {
        echo 'settingsCallback';
    }


    // public static function templateCreator()
    // {
    //     require('sub-classes/Rm199_Templates_Class.php');
    //     $template_creator = new Rm199TemplatesClass();
    //     $template_creator->allTemplates();
    // }
}
