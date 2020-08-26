<?php
if (!defined('ABSPATH')) {
    exit;
}
class Rm199_Admin_Overview_Class
{

    public static function overview_content()
    {
?>
        <span class="d-flex align-items-center">
            <h1 class="mr-2"><?php _e('Overview', 'rm199') ?></h1>
            <button title="<?php _e('update data', 'rm199') ?>" class="button button-primary mx-2 cursor-pointer d-flex align-items-center justify-content-center" onclick="location.reload()" style="height: 30px;width: 30px;"><span class="dashicons dashicons-update-alt "></span></button>
        </span>
        <div class="custom_row">
            <div class="rm199__home_col w-100">
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span class="mr-2"><?php _e('All Recommendation Packs', 'rm199') ?></span>
                        <a href="/wp-admin/admin.php?page=rm199_dashboard" rel="noopener noreferer"><button class="button button-primary button-large " onclick=""><?php _e('Create a New Pack', 'rm199') ?></button></a>
                    </h2>
                    <!-- <div class="table__overlay" onclick="unlockThis(event)"><span class="table__overlay__content"><?php //_e('Click To See Table', 'rm199') 
                                                                                                                        ?></span></div> -->

                    <div class="generator_box__content">
                        <?php
                        require('modules/Rm199_Table_rm199_Shortcodes.php');
                        $table_Structure_shrotcodes = new Rm199TableRm199Shortcodes();
                        $table_Structure_shrotcodes->table_Structure();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom_row">
            <div class="rm199__home_col w-100">
                <div class="generator_box">
                    <h2 class="generator_box__header">
                        <span class="mr-2"><?php _e('Recommendation Packs are Used In ', 'rm199') ?>:</span>
                    </h2>
                    <!-- <div class="table__overlay" onclick="unlockThis(event)"><span class="table__overlay__content"><?php //_e('Click To See Table', 'rm199') 
                                                                                                                        ?></span></div> -->
                    <div class="generator_box__content">
                        <?php
                        require('modules/Rm199_Table_rm199_posts.php');
                        $table_Structure_posts = new Rm199Tablerm199posts();
                        $table_Structure_posts->table_Structure();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom_row">
            <div class="rm199__home_col">

                <!-- <div class="generator_box mr-2">
                    <h2 class="generator_box__header">
                        <span class="mr-2"><?php //_e('Posts Performance', 'rm199') 
                                            ?></span>
                    </h2>
                    <div class="generator_box__content">
                        <?php
                        // require('modules/Rm199_Table_rm199_posts_clicks.php');
                        // $table_posts_clicks = new Rm199TableRm199PostsClicks();
                        // $table_posts_clicks->postsClicks();
                        ?>
                    </div>
                </div> -->
                <div class="generator_box mr-2">
                    <h2 class="generator_box__header">
                        <span><?php _e('User can Edit his preferences in : ', 'rm199') ?></span>
                        <!-- <button class="button button-primary button-large " onclick=""><?php // _e('add another keyword', 'rm199') 
                                                                                            ?></button> -->
                    </h2>
                    <!-- <div class="table__overlay" onclick="unlockThis(event)"><span class="table__overlay__content"><?php //_e('Click To See Table', 'rm199') 
                                                                                                                        ?></span></div> -->
                    <div class="generator_box__content">
                        <?php
                        require('modules/Rm199_Table_rm199_input.php');
                        $keywords_table_structure = new Rm199TableRm199Input();
                        $keywords_table_structure->keywords_table_structure();
                        ?>
                    </div>
                </div>
            </div>
            <div class="rm199__home_col">

                <div class="generator_box ml-2">
                    <h2 class="generator_box__header">
                        <span><?php _e('Credits', 'rm199') ?></span>
                        <!-- <button class="button button-primary button-large " onclick=""><?php // _e('add another keyword', 'rm199') 
                                                                                            ?></button> -->
                    </h2>
                    <div class="generator_box__content">
                        <?php
                        require('modules/Rm199_Credits_Class.php');
                        $credits = new Rm199Credits();
                        $credits->credits();
                        ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
