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
                 <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="recover_post" />
                    <fieldset>
                        <legend><?php _e('Recover your password', 'twitter') ; ?></legend>
                        <div class="clearfix">
                            <label for="s_email"><?php _e('E-mail', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="s_email" id="s_email">
                            </div>
                        </div>
                        <div class="clearfix">
                            <?php osc_show_recaptcha('recover_password'); ?>
                        </div>
                        <div class="actions">
                            <button class="btn" type="submit"><?php _e('Send me a new password', 'twitter') ; ?></button>
                        </div>
                        <div class="clearfix">
                            <div class="input">
                                <a href="<?php echo osc_user_login_url() ; ?>"><?php _e("Login", 'twitter') ; ?></a> &middot; <a href="<?php echo osc_register_account_url() ; ?>"><?php _e("Register for a free account", 'twitter') ; ?></a>
                            </div>
                        </div>
                    </fieldset>
                 </form>
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>