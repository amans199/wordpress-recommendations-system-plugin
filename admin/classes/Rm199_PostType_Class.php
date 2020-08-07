<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199_PostType_Class
{
    public static function custom_post_type()
    {
        // $labels = array(
        //     'name'               => __('Users Preferences', 'rm199'),
        //     'singular_name'      => __('Users Preference', 'rm199'),
        // );
        // $args = array(
        //     'labels'        => $labels,
        //     'description'   => 'Contains all your users preferences',
        //     'public'        => true,
        //     'supports'      => array('title', 'editor'),
        //     'menu_icon'           => 'dashicons-heart',
        //     'show_in_rest' => true
        // );
        $custom_args = array(
            'capability_type' => 'post',
            'supports' => array('title', 'editor'),
            'public' => true,
            'show_ui' => true,
            'has_archive' => true,
            'labels' => array(
                'name' => __('All User\'s\' Preferences', 'rm199'),
                'add_new_item' => __('add new', 'rm199'),
                'edit_item' =>  __('edit User\'s Preference', 'rm199'),
                'all_items' => __('User\'s\' Preferences', 'rm199'),
                'singular_name' => __('User\'s\' Preference', 'rm199'),
                'menu_name'          => __('User\'s\' Preferences', 'rm199')
            ),
            'menu_icon' => 'dashicons-heart',
            'show_in_rest' => true,
            'show_in_menu' => 'edit.php?post_type=user_preference'
        );
        register_post_type('user_preference', $custom_args);
    }

    // public static function custom_args($args, $post_type)
    // {
    //     if ('user_preference' === $post_type) {
    //         $args['show_in_rest'] = true;
    //         $args['rest_base'] = 'user_preference';
    //         $args['rest_controller_class'] = 'WP_REST_Posts_Controller';
    //     }
    //     return $args;
    // }
}
