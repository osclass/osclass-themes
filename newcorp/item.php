<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content item">

                <div id="item_head">
                    <div class="inner">
                        <h1><strong><?php echo osc_item_title() ; ?></strong></h1>
                    </div>
                </div>
                
                <div id="main">
                    <div id="type_dates">
                        <strong><?php echo osc_item_category() ; ?></strong>
                        <em class="publish">
                            <?php if ( osc_item_pub_date() != '' ) echo __('Added', 'newcorp') . ': ' . osc_format_date( osc_item_pub_date() ) ; ?>
                        </em>
                        <?php if ( osc_item_pub_date() != osc_item_mod_date() ) { ?>
                            <em class="update">
                                <?php if ( osc_item_mod_date() != '' ) echo __('Modified', 'newcorp') . ': ' . osc_format_date( osc_item_mod_date() ) ; ?>
                            </em>
                        <?php } ?>
                    </div>
                    <ul id="item_location">
                        <?php if ( osc_item_country() != "" ) { ?><li><?php _e('Country', 'newcorp') ; ?>: <strong><?php echo osc_item_country() ; ?></strong></li><?php } ?>
                        <?php if ( osc_item_region() != "" ) { ?><li><?php _e('Region', 'newcorp') ; ?>: <strong><?php echo osc_item_region() ; ?></strong></li><?php } ?>
                        <?php if ( osc_item_city() != "" ) { ?><li><?php _e('City', 'newcorp') ; ?>: <strong><?php echo osc_item_city() ; ?></strong></li><?php } ?>
                        <?php if ( osc_item_city_area() != "" ) { ?><li><?php _e('City area', 'newcorp') ; ?>: <strong><?php echo osc_item_city_area() ; ?></strong></li><?php } ?>
                        <?php if ( osc_item_address() != "" ) { ?><li><?php _e('Address', 'newcorp') ; ?>: <strong><?php echo osc_item_address() ; ?></strong></li><?php } ?>
                    </ul>
                    <div id="description">
                        <p><?php echo osc_item_description() ; ?></p>
                        <p class="contact_button">
                            <strong>
                                <a href="#contact"><?php _e('Apply for this job', 'newcorp') ; ?></a>
                            </strong>
                            <strong class="share">
                                <a href="<?php echo osc_item_send_friend_url() ; ?>" rel="nofollow"><?php _e('Recommend to a friend', 'newcorp') ; ?></a>
                            </strong>
                        </p>
                    </div>
                    <!-- plugins -->
                    <?php osc_run_hook('item_detail', osc_item() ) ; ?>
                    <?php osc_run_hook('location') ; ?>
                </div>
                <div id="sidebar">
                    <div id="contact">
                        <h2><?php _e('Apply for this job', 'newcorp') ?></h2>
                        <form <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return validate_contact();">
                            <fieldset>
                                <h3><?php echo osc_user_name() ; ?></h3>
                                <?php if ( osc_user_phone() != '' ) { ?>
                                    <p class="phone"><?php _e("Tel", 'newcorp'); ?>.: <?php echo osc_user_phone() ; ?></p>
                                <?php } ?>
                                <label for="yourName"><?php _e('Your name (optional)', 'newcorp') ; ?>:</label> <?php ContactForm::your_name() ; ?>
                                <label for="yourEmail"><?php _e('Your e-mail address', 'newcorp') ; ?>:</label> <?php ContactForm::your_email() ; ?>
                                <label for="phoneNumber"><?php _e('Phone number', 'newcorp') ; ?>:</label> <?php ContactForm::your_phone_number() ; ?>
                                <label for="message"><?php _e('Message', 'newcorp') ; ?>:</label> <?php ContactForm::your_message() ; ?>
                                <?php if( osc_item_attachment() ) { ?>
                                    <label for="subject"><?php _e('Your CV', 'newcorp') ; ?></label> <?php ContactForm::your_attachment() ; ?>
                                <?php } ?>
                                <input type="hidden" name="action" value="contact_post" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                                <button type="submit"><?php _e('Apply', 'newcorp') ; ?></button>
                            </fieldset>
                        </form>
                    </div>
                    <script type="text/javascript">
                        function validate_contact() {
                            email = $("#yourEmail");
                            message = $('#message');
                            
                            var pattern=/^([a-zA-Z0-9_\.\-\+])+@([a-zA-Z0-9_\.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                            var num_error = 0;

                            if(!pattern.test(email.val())){
                                email.css('border', '1px solid red');
                                num_error = num_error + 1;
                            }

                            if(message.val().length < 1) {
                                message.css('border', '1px solid red');
                                num_error = num_error + 1;
                            }

                            if(num_error > 0) {
                                return false;
                            }

                            return true;
                        }
                    </script>
                </div>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>