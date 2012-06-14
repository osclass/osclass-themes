<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container">
            <div class="margin-top-10">
                <?php echo twitter_breadcrumb('&raquo;') ; ?>
            </div>
            <div class="contact">
                <?php twitter_show_flash_message() ; ?>
            </div>
            <div class="contact well">
                <form name="register" id="register" action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return doUserRegister();" >
                    <input type="hidden" name="page" value="register" />
                    <input type="hidden" name="action" value="register_post" />
                    <fieldset>
                        <legend><?php _e('Register an account for free', 'twitter') ; ?></legend>
                        <div class="clearfix">
                            <label for="s_name"><?php _e('Name', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="s_name" id="s_name">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="s_password"><?php _e('Password', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="password" value="" name="s_password" id="s_password">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="s_password2"><?php _e('Re-type password', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="password" value="" name="s_password2" id="s_password2">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="s_email"><?php _e('E-mail', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="s_email" id="s_email">
                            </div>
                        </div>
                        <div class="clearfix">
                            <?php osc_run_hook('user_register_form') ; ?>
                        </div>
                        <div class="actions">
                            <?php osc_show_recaptcha('register'); ?>
                            <button class="btn" type="submit"><?php _e('Create', 'twitter') ; ?></button>
                        </div>
                        <div class="clearfix">
                            <div class="input">
                                <a href="<?php echo osc_user_login_url() ; ?>"><?php _e("Login", 'twitter') ; ?></a> &middot; <a href="<?php echo osc_recover_user_password_url() ; ?>"><?php _e("Forgot password?", 'twitter') ; ?></a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter') ; ?>' ;
            var text_valid_email    = '<?php _e('Enter a valid e-mail address', 'twitter') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('register.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>