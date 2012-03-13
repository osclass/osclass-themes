<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content user_account">
                <h1>
                    <strong><?php _e('User account manager', 'hierarchy') ; ?></strong>
                </h1>
                <div id="sidebar">
                    <?php echo osc_private_user_menu() ; ?>
                </div>
                <div id="main">
                    <h2><?php echo sprintf(__('Items from %s', 'hierarchy') ,osc_logged_user_name()) ; ?></h2>
                    <?php if(osc_count_items() == 0) { ?>
                        <h3><?php _e('No items have been added yet', 'hierarchy'); ?></h3>
                    <?php } else { ?>
                        <?php while(osc_has_items()) { ?>
                            <div class="userItem" >
                                <div>
                                    <a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a>
                                </div>
                                <div class="userItemData" >
                                    <p><?php _e('Publication date', 'hierarchy') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?><br />
                                        <?php if( osc_price_enabled_at_items() ) { _e('Price', 'hierarchy') ; ?>: <?php echo osc_format_price(osc_item_price()) ; } ?>
                                    </p>
                                    <p class="options">
                                        <strong><a href="<?php echo osc_item_url() ; ?>"><?php _e('View item', 'hierarchy') ; ?></a></strong>
                                        <span>|</span>
                                        <a href="<?php echo osc_item_edit_url() ; ?>"><?php _e('Edit', 'hierarchy') ; ?></a>
                                        <?php if(osc_item_is_inactive()) {?>
                                        <span>|</span>
                                        <a href="<?php echo osc_item_activate_url() ; ?>" ><?php _e('Activate', 'hierarchy') ; ?></a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>