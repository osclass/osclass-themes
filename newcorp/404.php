<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content error" style="font-size: 2.5em; text-align: center;">
                <h1><?php _e('Page not found', 'newcorp') ; ?></h1>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer'); ?>
    </body>
</html>