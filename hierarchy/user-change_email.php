<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content user_account">
                <h1>
                    <strong><?php _e('User account manager', 'hierarchy') ; ?></strong>
                </h1>
                <div id="sidebar">
                    <?php echo osc_private_user_menu() ; ?>
                </div>
                <div id="main" class="modify_profile">
                    <h2><?php _e('Change your e-mail', 'hierarchy') ; ?></h2>
                    <form action="<?php echo osc_base_url(true) ; ?>" method="post">
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="action" value="change_email_post" />
                        <fieldset>
                            <p>
                                <label for="email"><?php _e('Current e-mail', 'hierarchy') ; ?></label>
                                <span><?php echo osc_logged_user_email(); ?></span>
                            </p>
                            <p>
                                <label for="new_email"><?php _e('New e-mail', 'hierarchy') ; ?> *</label>
                                <input type="text" name="new_email" id="new_email" value="" />
                            </p>
                            <div style="clear:both;"></div>
                            <button type="submit"><?php _e('Update', 'hierarchy') ; ?></button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>