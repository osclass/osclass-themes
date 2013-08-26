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
                    <form action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return doUserChangePassword() ;">
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="action" value="change_password_post" />
                        <fieldset>
                            <legend><?php _e('Change your password', 'twitter') ; ?></legend>
                            <div class="clearfix">
                                <label for="password"><?php _e('Current password', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="password" value="" name="password" id="password">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="new_password"><?php _e('New password', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="password" value="" name="new_password" id="new_password">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="new_password2"><?php _e('Repeat new password', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="password" value="" name="new_password2" id="new_password2">
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
        </script>
        <!--<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('change_password.js') ; ?>"></script>-->
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>