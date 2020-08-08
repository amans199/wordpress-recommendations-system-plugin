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
            __('Generator', 'rm199'),
            __('Generator', 'rm199'),
            'manage_options',
            'rm199_dashboard',
            array('Rm199_Menu_Class', 'dashboardCallback')
        );
        // add_submenu_page(
        //     'rm199_manager',
        //     __('All User\'s Preferences', 'rm199'),
        //     __('All Preferences', 'rm199'),
        //     'manage_options',
        //     'edit.php?post_type=user_preference'
        // );

        add_submenu_page(
            'rm199_manager',
            __('rm sub manager', 'rm199'),
            __('Settings', 'rm199'),
            'manage_options',
            'rm199_settings'
        );
    }
    public static function dashboardCallback()
    {
        wp_enqueue_script('ajax_handler', plugins_url() . '/recommendations-master/admin/js/rm199.js', array('jquery'));
        wp_localize_script('ajax_handler', 'AjaxHandler', array('security' => wp_create_nonce('abc')));
        // require_once('./sub-classes/Rm199_Home_Content_Class.php');
        // require_once(plugins_url() . '/recommendations-master/admin/sub-classes/Rm199_Home_Content_Class.php');
        require('sub-classes/Rm199_Admin_Dashboard_Class.php');
        $dashboard_content = new Rm199_Admin_Dashboard_Class();
        $dashboard_content->dashboard_content();
?>
        <!-- <form action="options.php" method="post" style="margin-top:2rem"> -->
        <?php
        // settings_fields('rm199_settings_group');
        ?>
        <!-- <input id="rm199_hide_admin" class="hide_adminbar_ajax" type="checkbox" name="rm199_test_option" value="yes" <?php //checked(get_option('rm199_test_option'), 'yes'); 
                                                                                                                            ?> />
            <label for="rm199_hide_admin">Hide admin bar in frontend</label> -->



        <?php
        // echo 'every thing will be hereeeeee';
        // submit_button('Save');
        ?>
        <!-- </form> -->
<?php
    }

    public static function overviewCallback()
    {
        require('sub-classes/Rm199_Admin_Overview_Class.php');
        $overview_content = new Rm199_Admin_Overview_Class();
        $overview_content->overview_content();
    }
    // public static function hideMenubar()
    // {
    //     $option = get_option('rm199_test_option');
    //     if ($option === 'yes') {
    //         add_filter('show_admin_bar', '__return_false');
    //     }
    // }

    // public static function registerSettings()
    // {
    //     register_setting('rm199_settings_group', 'rm199_test_option');
    // }
}
