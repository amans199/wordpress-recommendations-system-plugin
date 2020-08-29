<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199ShortCodeManager
{
    /**
     * The main Class for website's frontend ... it manages all the outputs that generated by the ShortCode which has been inserted by the admin
     *
     * @since    1.0.0
     */


    public static function rm199_input($attr)
    {
        require('sub-classes/Rm199_Input_Class.php');
        $Rm199Input = new Rm199Input();
        $Rm199Input->rm199_input($attr);
    }
    public static function rm199_posts($attr)
    {
        require('sub-classes/Rm199_posts_Class.php');
        $Rm199Posts = new Rm199Posts();
        $Rm199Posts->rm199_posts($attr);
    }
}
