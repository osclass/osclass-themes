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
                <div id="contact" class="inner">
                    <h1><?php _e('Send to a friend', 'hierarchy') ; ?></h1>
                    <ul id="error_list"></ul>
                    <form id="sendfriend" name="sendfriend" action="<?php echo osc_base_url(true) ; ?>" method="post">
                        <fieldset>
                            <input type="hidden" name="action" value="send_friend_post" />
                            <input type="hidden" name="page" value="item" />
                            <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                            <label><?php _e('Item', 'hierarchy') ; ?>: <a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></label><br/>
                            <?php if(osc_is_web_user_logged_in()) { ?>
                                <input type="hidden" name="yourName" value="<?php echo osc_logged_user_name() ; ?>" />
                                <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email() ; ?>" />
                            <?php } else { ?>
                                <label for="yourName"><?php _e('Your name', 'hierarchy') ; ?></label> <?php SendFriendForm::your_name() ; ?> <br/>
                                <label for="yourEmail"><?php _e('Your e-mail address', 'hierarchy') ; ?></label> <?php SendFriendForm::your_email() ; ?> <br/>
                            <?php } ?>
                            <label for="friendName"><?php _e("Your friend's name", 'hierarchy') ; ?></label> <?php SendFriendForm::friend_name() ; ?> <br/>
                            <label for="friendEmail"><?php _e("Your friend's e-mail address", 'hierarchy') ; ?></label> <?php SendFriendForm::friend_email() ; ?> <br/>
                            <label for="message"><?php _e('Message', 'hierarchy') ; ?></label> <?php SendFriendForm::your_message() ; ?> <br/>
                            <?php osc_show_recaptcha(); ?>
                            <br/>
                            <button type="submit"><?php _e('Send', 'hierarchy') ; ?></button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <?php SendFriendForm::js_validation() ; ?>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>