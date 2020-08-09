<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199PostTypesClass
{
    // public static function rmPacks()
    // {
    //     $custom_args = array(
    //         'capability_type' => 'post',
    //         'supports' => array('title', 'editor'),
    //         'public' => true,
    //         'show_ui' => true,
    //         'has_archive' => true,
    //         'labels' => array(
    //             'name' => __('All Rm-Packs', 'rm199'),
    //             'add_new_item' => __('Add Rm-Packs', 'rm199'),
    //             'edit_item' =>  __('Edit Rm-Pack', 'rm199'),
    //             'all_items' => __('All Rm-Pack', 'rm199'),
    //             'singular_name' => __('Rm-Pack', 'rm199'),
    //             'menu_name'          => __('Rm-Packs', 'rm199')
    //         ),
    //         'show_in_rest' => true,
    //         'show_in_menu' => 'edit.php?post_type=all_shortcodes'
    //     );
    //     register_post_type('all_shortcodes',  $custom_args);
    // }

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
