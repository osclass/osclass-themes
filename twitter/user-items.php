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
                    <h2><?php _e('Your items', 'twitter') ; ?></h2>
                </div>
            </div>
            <?php if(osc_count_items() == 0) { ?>
            <div class="row">
                <div class="span16 columns">
                    <h4><?php _e("You don't have any items yet", 'twitter') ; ?></h4>
                </div>
            </div>
            <?php } else { ?>
                <?php while( osc_has_items() ) { ?>
                <div class="row">
                    <div class="span16 columns">
                        <h4><a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a></h4>
                        <p class="gray"><?php printf(__('<strong>Publish date</strong>: %s', 'twitter'), osc_format_date( osc_item_pub_date() ) ) ; ?></p>
                        <?php
                            $location = array() ;
                            if( osc_item_country() != '' ) {
                                $location[] = sprintf( __('<strong>Country</strong>: %s', 'twitter'), osc_item_country() ) ;
                            }
                            if( osc_item_region() != '' ) {
                                $location[] = sprintf( __('<strong>Region</strong>: %s', 'twitter'), osc_item_region() ) ;
                            }
                            if( osc_item_city() != '' ) {
                                $location[] = sprintf( __('<strong>City</strong>: %s', 'twitter'), osc_item_city() ) ;
                            }
                            if( count($location) > 0) {
                        ?>
                        <p class="gray"><?php echo implode(' &middot; ', $location) ; ?></p>
                        <?php } ?>
                        <p><?php echo osc_highlight( strip_tags( osc_item_description() ) ) ; ?></p>
                        <p>
                            <strong><a href="<?php echo osc_item_edit_url(); ?>"><?php _e('Edit', 'twitter') ; ?></a></strong>
                            &middot;
                            <a class="delete" onclick="javascript:return confirm('<?php _e('This action can not be undone. Are you sure you want to continue?', 'twitter') ; ?>')" href="<?php echo osc_item_delete_url() ; ?>" ><?php _e('Delete', 'twitter') ; ?></a>
                            <?php if( osc_item_is_inactive() ) { ?>
                            &middot;
                            <a href="<?php echo osc_item_activate_url() ; ?>" ><?php _e('Activate', 'twitter') ; ?></a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
                <?php if ( osc_list_total_pages() > 0 ) { ?>
                <div class="pagination">
                    <ul>
                        <?php echo twitter_user_item_pagination() ; ?>
                    </ul>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>