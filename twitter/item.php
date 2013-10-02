<?php
    $is_expired          = osc_item_is_expired () ;
    $is_user             = !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ;
    $is_can_contact      = osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ;

    $is_comments_enabled = osc_comments_enabled() ;
    $is_can_comment      = osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ;
?>
<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.js') ; ?>"></script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('bootstrap-modal.js') ; ?>"></script>
        <link href="<?php echo osc_current_web_theme_js_url('fancybox/jquery.fancybox-1.3.4.css') ; ?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            $(document).ready(function(){
                $("a[rel=image_group]").fancybox();

                $(".item-contact-button-cancel").bind('click', function(event) {
                    $('#item-contact').modal('hide') ;
                }) ;

                $('#item-contact .close').bind('click', function(event) {
                    $(this).modal('hide') ;
                }) ;

                $('#item-sendfriend .close').bind('click', function(event) {
                    $(this).modal('hide') ;
                }) ;

                $(".item-sendfriend-button-cancel").bind('click', function(event) {
                    $('#item-sendfriend').modal('hide') ;
                }) ;
            });
        </script>
        <?php if( osc_item_is_expired () ) { ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container item-detail">
            <?php echo twitter_breadcrumb('&raquo;') ; ?>
            <div class="row">
                <!-- item detail -->
                <div class="span16 columns">
                    <div id="item_head">
                        <h1><?php if( osc_price_enabled_at_items() ) { ?><small><?php echo osc_item_formated_price() ; ?></small> &middot; <?php } ?><?php echo osc_item_title(); ?></h1>
                        <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
                            <p id="edit_item_view">
                                <strong>
                                    <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'modern'); ?></a>
                                </strong>
                            </p>
                        <?php } else { ?>
                            <p id="report">
                                <strong><?php _e('Mark as', 'modern'); ?></strong>
                                <span>
                                    <a id="item_spam" href="<?php echo osc_item_link_spam(); ?>" rel="nofollow"><?php _e('spam', 'modern'); ?></a>
                                    <a id="item_bad_category" href="<?php echo osc_item_link_bad_category(); ?>" rel="nofollow"><?php _e('misclassified', 'modern'); ?></a>
                                    <a id="item_repeated" href="<?php echo osc_item_link_repeated(); ?>" rel="nofollow"><?php _e('duplicated', 'modern'); ?></a>
                                    <a id="item_expired" href="<?php echo osc_item_link_expired(); ?>" rel="nofollow"><?php _e('expired', 'modern'); ?></a>
                                    <a id="item_offensive" href="<?php echo osc_item_link_offensive(); ?>" rel="nofollow"><?php _e('offensive', 'modern'); ?></a>
                                </span>
                            </p>
                        <?php }; ?>
                    </div>

                    <p class="no-margin"><?php printf(__('<strong>Published date:</strong> %s %s', 'twitter'), osc_format_date( osc_item_pub_date() ), date(osc_time_format(), strtotime(osc_item_pub_date())) ) ; ?></p>
                    <?php if ( osc_item_mod_date() != '' ) { ?>
                    <p class="no-margin"><?php printf(__('<strong>Modified date:</strong> %s %s', 'twitter'), osc_format_date( osc_item_mod_date() ), date(osc_time_format(), strtotime(osc_item_mod_date())) ) ; ?></p>
                    <?php } ?>
                    <?php $item_location = item_detail_location() ; ?>
                    <?php if( count($item_location) > 0 ) { ?>
                    <p class="no-margin"><?php printf(__('<strong>Location:</strong> %s', 'twitter'), implode(', ', $item_location) ) ; ?></p>
                    <?php } ?>
                    <p class="margin-top-10"><?php echo osc_item_description() ; ?></p>
                    <div class="custom_fields">
                        <?php if( osc_count_item_meta() > 0 ) { ?>
                        <div class="meta_list">
                            <?php while ( osc_has_item_meta() ) { ?>
                            <p class="meta no-margin">
                                <strong><?php echo osc_item_meta_name() ; ?>:</strong> <?php echo osc_item_meta_value() ; ?>
                            </p>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php osc_run_hook('item_detail', osc_item() ) ; ?>
                    <?php if( osc_images_enabled_at_items() && (osc_count_item_resources() > 0) ) { ?>
                    <div class="photos">
                        <ul class="media-grid">
                        <?php while( osc_has_item_resources() ) { ?>
                            <li>
                                <a rel="image_group" href="<?php echo osc_resource_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="150" alt="<?php echo osc_item_title() ; ?>" title="<?php echo osc_item_title() ; ?>"/></a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                    <p>
                        <?php if ( !$is_expired && $is_user && $is_can_contact ) { ?>
                        <a class="btn primary item-contact-button" data-controls-modal="item-contact" data-backdrop="true" data-keyboard="true" href="javascript://"><?php _e('Contact seller', 'twitter') ; ?></a>
                        <?php } ?>
                        <a class="btn primary item-share-button" data-controls-modal="item-sendfriend" data-backdrop="true" data-keyboard="true" href="javascript://"><?php _e('Share', 'twitter') ; ?></a>
                    </p>
                    <?php osc_run_hook('location') ; ?>
                </div>
                <!-- item detail end -->
                <?php if( $is_comments_enabled ) { ?>
                <!-- comments -->
                <div class="span16 columns comments well">
                    <?php if( $is_can_comment && (osc_item_total_comments() > 0) ) { ?>
                    <h2><?php _e('Comments', 'twitter'); ?></h2>
                    <!-- list comments -->
                    <div class="list-comments">
                        <?php while ( osc_has_item_comments() ) { ?>
                            <div class="comment">
                                <h3><?php echo osc_comment_title() ; ?> <small><em><?php _e("by", 'twitter') ; ?> <?php echo osc_comment_author_name() ; ?></small></em></h3>
                                <p><?php echo osc_comment_body() ; ?> </p>
                                <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
                                <p>
                                    <a rel="nofollow" href="<?php echo osc_delete_comment_url() ; ?>" title="<?php _e('Delete your comment', 'twitter') ; ?>"><?php _e('Delete', 'twitter') ; ?></a>
                                </p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if( ( !( osc_comments_per_page() == 0 ) || (osc_item_comments_page() === 'all') ) && ( osc_item_total_comments() >= osc_comments_per_page() ) ) { ?>
                        <div class="pagination">
                            <ul>
                                <?php echo twitter_comments_item_pagination() ; ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- list comments end -->
                    <?php } ?>
                    <!-- comment form -->
                    <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" onsubmit="return doComment();" >
                        <input type="hidden" name="action" value="add_comment" />
                        <input type="hidden" name="page" value="item" />
                        <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                        <fieldset>
                            <legend><?php _e('Leave your comment', 'twitter') ; ?></legend>
                            <div class="clearfix">
                                <label for="comment-authorName"><?php _e('Your name', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge comment-authorName" type="text" value="<?php echo osc_logged_user_name() ; ?>" name="authorName" id="comment-authorName">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="comment-authorEmail"><?php _e('Your e-mail', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge comment-authorEmail" type="text" value="<?php echo osc_logged_user_email() ; ?>" name="authorEmail" id="comment-authorEmail">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="comment-title"><?php _e('Title', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge comment-title" type="text" value="" name="title" id="comment-title">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="comment-body"><?php _e('Comment', 'twitter') ; ?></label>
                                <div class="input">
                                    <textarea class="xlarge comment-body" id="comment-body" name="body" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="btn" type="submit"><?php _e('Post comment', 'twitter') ; ?></button>
                            </div>
                        </fieldset>
                    </form>
                    <!-- comment form end -->
                </div>
                <!-- comments end -->
                <?php } ?>
            </div>
        </div>
        <?php if ( !$is_expired && $is_user && $is_can_contact ) { ?>
        <!-- item contact -->
        <div id="item-contact" class="modal hide item-contact">
            <form <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form" onsubmit="return doItemContact() ;">
                <input type="hidden" name="action" value="contact_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                <div class="modal-header">
                    <a href="#" class="close">×</a>
                    <h3><?php _e('Contact publisher', 'twitter') ; ?></h3>
                </div>
                <div class="modal-body">
                    <?php osc_prepare_user_info() ; ?>
                    <div class="clearfix">
                        <label for="contact-yourName"><?php _e('Your name', 'twitter') ; ?></label>
                        <div class="input">
                            <input class="xlarge contact-yourName" id="contact-yourName" name="yourName" type="text" value="<?php echo osc_logged_user_name(); ?>">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="contact-yourEmail"><?php _e('Your e-mail', 'twitter') ; ?></label>
                        <div class="input">
                            <input class="xlarge contact-yourEmail" id="contact-yourEmail" name="yourEmail" type="text" value="<?php echo osc_logged_user_email();?>">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="contact-phoneNumber"><?php _e('Phone number', 'twitter') ; ?></label>
                        <div class="input">
                            <input class="xlarge contact-phoneNumber" id="contact-phoneNumber" name="phoneNumber" type="text" value="">
                        </div>
                    </div>
                    <?php if( osc_item_attachment() ) { ?>
                    <div class="clearfix">
                        <label for="contact-attachment"><?php _e('Attachments', 'twitter') ; ?></label>
                        <div class="input">
                            <?php ContactForm::your_attachment() ; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="clearfix">
                        <label for="contact-message"><?php _e('Message', 'twitter') ; ?></label>
                        <div class="input">
                            <textarea class="xlarge contact-message" id="contact-message" name="message" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="recaptcha_container">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn primary" type="submit"><?php _e('Send', 'twitter') ; ?></button>
                    <a class="btn item-contact-button-cancel" href="javascript://"><?php _e('Cancel', 'twitter') ; ?></a>
                </div>
            </form>
        </div>
        <!-- item contact end -->
        <?php } ?>
        <!-- item send friend -->
        <div id="item-sendfriend" class="modal hide item-sendfriend">
            <form class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="sendfriend" onsubmit="return doItemSendFriend() ;">
                <input type="hidden" name="action" value="send_friend_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                <div class="modal-header">
                    <a href="#" class="close">×</a>
                    <h3><?php _e('Send to a friend', 'twitter') ; ?></h3>
                </div>
                <div class="modal-body">
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
                        <div class="recaptcha_container">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn primary" type="submit"><?php _e('Send', 'twitter') ; ?></button>
                    <a class="btn item-sendfriend-button-cancel" href="javascript://"><?php _e('Cancel', 'twitter') ; ?></a>
                </div>
            </form>
        </div>
        <!-- item send friend end -->
        <script type="text/javascript">
            var text_error_required = '' ;
            var text_valid_email    = '' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_contact.js') ; ?>"></script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_sendfriend.js') ; ?>"></script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_comment.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>