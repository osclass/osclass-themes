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
                <form action="<?php echo osc_base_url(true); ?>" method="post" name="sendfriend" onsubmit="return doItemSendFriend();" >
                    <input type="hidden" name="action" value="send_friend_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                    <fieldset>
                        <legend><?php _e('Send to a friend', 'twitter') ; ?></legend>
                        <div class="clearfix">
                            <label><?php _e('Item', 'twitter') ; ?></label>
                            <div class="input">
                                <span class="inline-help padding-top">
                                    <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title() ; ?></a>
                                </span>
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="sendfriend-yourName"><?php _e('Your name', 'twitter') ; ?></label>
                            <div class="input">
                                <input class="xlarge sendfriend-yourName" id="sendfriend-yourName" name="yourName" type="text" value="">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="sendfriend-friendName"><?php _e('Your e-mail', 'twitter') ; ?></label>
                            <div class="input">
                                <input class="xlarge sendfriend-yourEmail" id="sendfriend-yourEmail" name="yourEmail" type="text" value="">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="sendfriend-friendName"><?php _e("Your friend's name", 'twitter') ; ?></label>
                            <div class="input">
                                <input class="xlarge sendfriend-friendName" id="sendfriend-friendName" name="friendName" type="text" value="">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="sendfriend-friendEmail"><?php _e("Your friend's e-mail", 'twitter') ; ?></label>
                            <div class="input">
                                <input class="xlarge sendfriend-friendEmail" id="sendfriend-friendEmail" name="friendEmail" type="text" value="">
                            </div>
                        </div>
                        <div class="clearfix">
                            <label for="sendfriend-message"><?php _e('Message', 'twitter') ; ?></label>
                            <div class="input">
                                <textarea class="xlarge sendfriend-message" id="sendfriend-message" name="message" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="clearfix">
                            <?php osc_show_recaptcha(); ?>
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
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_sendfriend.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>