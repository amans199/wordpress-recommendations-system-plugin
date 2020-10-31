<?php
if (!defined('ABSPATH')) {
    exit;
}
class RM199_Users_Preferences
{
    function __construct()
    {
        foreach (glob(RM199_PATH . "assets/templates/*.php") as $file) {
            include_once $file;
        }
    }

    public static function customize_the_preferences_input()
    {
        echo "customize_the_preferences_input";
    }
}
