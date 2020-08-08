<?php
if (!defined('ABSPATH')) {
    exit;
}

class Rm199HandelUserMetaClass
{
    // public $user_preferences =;
    function __construct()
    {
        add_action('show_user_profile', array('Rm199HandelUserMetaClass', 'displayUserPreferencesInHisProfile'));
    }
    // public static function getAllMetaData()
    // {
    //     return 
    // }

    public static function displayUserPreferencesInHisProfile()
    {
        $user_preferences =  get_user_meta(
            get_current_user_id(),
            'preferences',
            false
        );
        ob_start();

        print('<h3>Preferences:</h3>');
        if (is_array($user_preferences) || is_object($user_preferences)) {
            foreach ($user_preferences as $preference) {
                echo $preference . '<br>';
            }
        }
        ob_flush();
        // $out = ob_get_clean();
        // $out = strtolower($out);
        // var_dump($out);
    }
}
