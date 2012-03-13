<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container margin-top-10">
            <?php osc_render_file(); ?>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>