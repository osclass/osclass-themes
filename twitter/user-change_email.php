<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container user">
            <div class="row">
                <div class="span16 columns">
                    <?php twitter_user_menu() ; ?>
                    <?php twitter_show_flash_message() ; ?>
                    </div>
            </div>
            <div class="row">
                <div class="span16 columns">
                    <form action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return doUserChangeEmail() ;">
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="action" value="change_email_post" />
                        <fieldset>
                            <legend><?php _e('Change your e-mail', 'twitter') ; ?></legend>
                            <div class="clearfix">
                                <label for="email"><?php _e('Current e-mail', 'twitter') ; ?></label>
                                <div class="input">
                                    <span class="input-xlarge uneditable-input"><?php echo osc_logged_user_email() ; ?></span>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="new_email"><?php _e('New e-mail', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="" name="new_email" id="new_email">
                                </div>
                            </div>
                            <div class="actions">
                                <button class="btn" type="submit"><?php _e('Update', 'twitter') ; ?></button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter') ; ?>' ;
            var text_valid_email    = '<?php _e('Enter a valid e-mail address', 'twitter') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('change_email.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>