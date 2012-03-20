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
                 <form action="<?php echo osc_base_url(true); ?>" method="post" onsubmit="return doUserForgotPassword() ;">
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="forgot_post" />
                    <input type="hidden" name="userId" value="<?php echo Params::getParam('userId'); ?>" />
                    <input type="hidden" name="code" value="<?php echo Params::getParam('code'); ?>" />
                    <fieldset>
                        <legend><?php _e('Recover your password', 'twitter') ; ?></legend>
                        <div class="clearfix">
                            <label for="new_password"><?php _e('New pasword', 'twitter') ; ?></label>
                            <div class="input">
                                <input class="large" type="password" value="" name="new_password" id="new_password">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="new_password2"><?php _e('Repeat new pasword', 'twitter') ; ?></label>
                            <div class="input">
                                <input class="large" type="password" value="" name="new_password2" id="new_password2">
                            </div>
                        </div>
                        <div class="actions">
                            <button class="btn" type="submit"><?php _e('Change password', 'twitter') ; ?></button>
                        </div>
                    </fieldset>
                 </form>
            </div>
        </div>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('forgot_password.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>