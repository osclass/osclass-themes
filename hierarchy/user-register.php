<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content user_forms">
                <div class="inner">
                    <h1><?php _e('Register an account for free', 'hierarchy') ; ?></h1>
                    <ul id="error_list"></ul>
                    <form name="register" id="register" action="<?php echo osc_base_url(true) ; ?>" method="post" >
                        <input type="hidden" name="page" value="register" />
                        <input type="hidden" name="action" value="register_post" />
                        <fieldset>
                            <label for="name"><?php _e('Name', 'hierarchy') ; ?></label> <?php UserForm::name_text() ; ?><br />
                            <label for="password"><?php _e('Password', 'hierarchy') ; ?></label> <?php UserForm::password_text() ; ?><br />
                            <label for="password"><?php _e('Re-type password', 'hierarchy') ; ?></label> <?php UserForm::check_password_text() ; ?><br />
                            <p id="password-error" style="display:none;">
                                <?php _e('Passwords don\'t match', 'hierarchy') ; ?>.
                            </p>
                            <label for="email"><?php _e('E-mail', 'hierarchy') ; ?></label> <?php UserForm::email_text() ; ?><br />
                            <?php osc_show_recaptcha('register') ; ?>
                            <button type="submit"><?php _e('Create', 'hierarchy') ; ?></button>
                            <?php osc_run_hook('user_register_form') ; ?>
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php UserForm::js_validation() ; ?>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>