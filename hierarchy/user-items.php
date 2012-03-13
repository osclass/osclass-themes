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
                    <h2><?php _e('Your items', 'hierarchy'); ?> <a href="<?php echo osc_item_post_url() ; ?>">+ <?php _e('Post a new item', 'hierarchy'); ?></a></h2>
                    <?php if(osc_count_items() == 0) { ?>
                        <h3><?php _e('You don\'t have any items yet', 'hierarchy'); ?></h3>
                    <?php } else { ?>
                        <?php while(osc_has_items()) { ?>
                                <div class="item" >
                                    <h3>
                                        <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a>
                                    </h3>
                                    <p>
                                        <?php _e('Publication date', 'modern') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?><br />
                                        <?php if( osc_price_enabled_at_items() ) { _e('Price', 'modern') ; ?>: <?php echo osc_format_price(osc_item_price()) ; } ?>
                                    </p>
                                    <p class="options">
                                        <strong><a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'modern'); ?></a></strong>
                                        <span>|</span>
                                        <a class="delete" onclick="javascript:return confirm('<?php _e('This action can not be undone. Are you sure you want to continue?', 'modern'); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'modern'); ?></a>
                                        <?php if(osc_item_is_inactive()) {?>
                                        <span>|</span>
                                        <a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'modern'); ?></a>
                                        <?php } ?>
                                    </p>
                                </div>
                        <?php } ?>
                        <br />
                        <div class="paginate" >
                        <?php for($i = 0 ; $i < osc_list_total_pages() ; $i++) {
                            if($i == osc_list_page()) {
                                printf('<a class="searchPaginationSelected" href="%s">%d</a>', osc_user_list_items_url($i), ($i + 1));
                            } else {
                                printf('<a class="searchPaginationNonSelected" href="%s">%d</a>', osc_user_list_items_url($i), ($i + 1));
                            }
                        } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>