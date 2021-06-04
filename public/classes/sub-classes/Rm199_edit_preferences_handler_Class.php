<?php
if (!defined('ABSPATH')) {
    die();
}

class Rm199_edit_preferences_handler_Class
{
    /**
     * The main Class to edit Users' preferences ..
     *
     * @since    0.0.1
     */
    function __construct()
    {
        // 
    }

    public static function rm199_input()
    {
        if (is_user_logged_in()) { ?>
            <section>
                <!-- todo : add a design for the input for users to edit their preferences -->
                <?php
                // echo 'heeloooooo i am hereeeeeee';
                require_once('Rm199_Input_Class.php');
                $Rm199Input = new Rm199Input();
                $Rm199Input->rm199_input();
                ?>
            </section>
<?php
        }
    }
}
