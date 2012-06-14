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
            <div class="contact">
                <?php twitter_show_flash_message() ; ?>
            </div>
            <?php echo twitter_breadcrumb('&raquo;') ; ?>
            <div class="contact well">
                <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact" onsubmit="return doContact();">
                    <input type="hidden" name="page" value="contact" />
                    <input type="hidden" name="action" value="contact_post" />
                    <fieldset>
                        <legend><?php _e('Contact us', 'twitter') ; ?></legend>
                        <div class="clearfix">
                            <label for="subject"><?php _e('Subject', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="message"><?php _e('Message', 'twitter') ; ?> *</label>
                            <div class="input">
                                <textarea class="xlarge" id="message" name="message" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="yourName"><?php _e('Your name', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="yourName" id="yourName">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="yourEmail"><?php _e('Your e-mail address', 'twitter') ; ?> *</label>
                            <div class="input">
                                <input class="xlarge" type="text" value="" name="yourEmail" id="yourEmail">
                            </div>
                        </div>
                        <div class="clearfix">
                            <?php osc_run_hook('user_register_form') ; ?>
                        </div>
                        <div class="clearfix">
                            <div class="input">
                                <?php osc_show_recaptcha(); ?>
                            </div>
                        </div>
                        <div class="actions">                            
                            <button class="btn" type="submit"><?php _e('Send', 'twitter') ; ?></button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            var text_error_required = '<?php _e('This field is required', 'twitter') ; ?>' ;
            var text_valid_email    = '<?php _e('Enter a valid e-mail address', 'twitter') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('contact.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>