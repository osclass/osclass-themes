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
            <div class="content page">
                <?php View::newInstance()->_erase('pages'); ?>
                <div id="main">
                    <h1><strong><?php echo osc_static_page_title() ; ?></strong></h1>
                    <div class="text"><?php echo osc_static_page_text() ; ?></div>
                </div>
                <div id="sidebar">
                    <div class="publish_box companies">
                        <h2><strong><?php _e('Upload your CV and', 'newcorp') ; ?>:</strong></h2>
                        <p>
                            <?php _e('We will automatically receive your information and we will study your candidature', 'newcorp') ; ?>
                        </p>
                        <strong class="button_link"><a href="<?php echo osc_contact_url( ) ; ?>"><?php _e('Upload your CV now', 'newcorp') ; ?>!</a></strong>
                    </div>
                </div>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>