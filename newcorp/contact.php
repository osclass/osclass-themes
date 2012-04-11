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
            <div class="content">
                <div class="user_forms">
                    <div class="inner">
                        <h1><?php _e('Upload your CV', 'newcorp') ; ?></h1>
                        <form <?php if( osc_contact_attachment () ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true) ; ?>" method="post" onSubmit="javascript:return checkForm();">
                            <input type="hidden" name="page" value="contact" />
                            <input type="hidden" name="action" value="contact_post" />
                            <fieldset>
                                <label for="subject"><?php _e('Subject', 'newcorp') ; ?></label> <?php ContactForm::the_subject() ; ?><br />
                                <label for="message"><?php _e('Message', 'newcorp') ; ?></label> <?php ContactForm::your_message() ; ?><br />
                                <?php if( osc_contact_attachment () ) { ?>
                                    <label for="attachment"><?php _e('Your CV', 'newcorp') ; ?></label> <?php ContactForm::your_attachment() ; ?><br />
                                <?php } ?>
                                <label for="your_name"><?php _e('Your name', 'newcorp') ; ?> (<?php _e('optional', 'newcorp'); ?>)</label> <?php ContactForm::your_name() ; ?><br />
                                <label for="your_email"><?php _e('Your e-mail address', 'newcorp') ; ?></label> <?php ContactForm::your_email() ; ?><br />
                                <button type="submit"><?php _e('Send', 'newcorp') ; ?></button>
                                <?php osc_run_hook('user_register_form') ; ?>
                            </fieldset>
                            <?php ContactForm::js_validation() ; ?>
                        </form>
                    </div>
                </div>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>