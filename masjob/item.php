<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
    </head>
    <body>
        <!--<div class="mega_banner"><img src="https://www.google.com/adsense/static/es/images/leaderboard_img.jpg" /></div>-->
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content item">
                <div id="main">
                    <h1><?php echo osc_item_title() ; ?></h1>
                    <div id="type_dates">
                        <em class="publish">
                            <?php if ( osc_item_pub_date() != '' ) echo __('Added', 'masjob') . ': ' . osc_format_date( osc_item_pub_date() ) ; ?>
                        </em>
                        <?php if ( osc_item_pub_date() != osc_item_mod_date() ) { ?>
                            <em class="update">
                                <?php if ( osc_item_mod_date() != '' ) echo __('Modified', 'masjob') . ': ' . osc_format_date( osc_item_mod_date() ) ; ?>
                            </em>
                        <?php } ?>
                    </div>
                    <div id="description">
                        <ul id="item_location">
                            <?php if ( osc_item_country() != "" ) { ?><li><strong><?php _e("Country", 'masjob') ; ?>: </strong><?php echo osc_item_country() ; ?></li><?php } ?>
                            <?php if ( osc_item_region() != "" ) { ?><li><strong><?php _e("Region", 'masjob') ; ?>: </strong><?php echo osc_item_region() ; ?></li><?php } ?>
                            <?php if ( osc_item_city() != "" ) { ?><li><strong><?php _e("City", 'masjob') ; ?>: </strong><?php echo osc_item_city() ; ?></li><?php } ?>
                            <?php if ( osc_item_city_area() != "" ) { ?><li><strong><?php _e("City area", 'masjob') ; ?>: </strong><?php echo osc_item_city_area() ; ?></li><?php } ?>
                            <?php if ( osc_item_address() != "" ) { ?><li><strong><?php _e("Address", 'masjob') ; ?>: </strong><?php echo osc_item_address() ; ?></li><?php } ?>
                        </ul>
                        <p><?php echo  osc_item_description() ; ?></p>
                        <div class="meta-fields">
                            <?php while( osc_has_item_meta() ) { ?>
                                <?php if( osc_item_meta_value() != '' ) { ?>
                                    <h3><?php echo osc_item_meta_name(); ?></h3>
                                    <p><?php echo osc_item_meta_value(); ?></p>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php osc_run_hook('item_detail', osc_item() ) ; ?>
                        <?php osc_run_hook('location') ; ?>
                        <!--
                        <div class="banner">
                            <img src="https://www.google.com/adsense/static/es/images/banner.gif" />
                        </div>
                        -->
                        <p class="contact_button">
                            <strong><a href="#contact" id="apply_for"><?php _e('Apply for this job', 'masjob') ; ?></a></strong>
                            <strong class="share"><a href="<?php echo osc_item_send_friend_url() ; ?>" rel="nofollow"><?php _e('Recommend to a friend', 'masjob') ; ?></a></strong>
                        </p>
                    </div>
                </div>
                <div id="sidebar">
                    <!--
                    <div class="banner">
                        <img src="https://www.google.com/adsense/static/es/images/inline_rectangle.gif" />
                    </div>
                    -->
                    <div id="contact">
                        <h2><?php _e('Apply for this job', 'masjob') ?></h2>
                        <form <?php if( osc_contact_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> action="<?php echo osc_base_url(true) ; ?>" method="post" onsubmit="return validate_contact();">
                            <fieldset>
                                <label for="yourName"><?php _e('Your name (optional)', 'masjob') ; ?>:</label> <?php ContactForm::your_name() ; ?>
                                <label for="yourEmail"><?php _e('Your e-mail address', 'masjob') ; ?>:</label> <?php ContactForm::your_email() ; ?>
                                <label for="phoneNumber"><?php _e('Phone number', 'masjob') ; ?>:</label> <?php ContactForm::your_phone_number() ; ?>
                                <?php if( osc_contact_attachment() ) { ?>
                                    <label for="subject"><?php _e('Your CV', 'masjob') ; ?></label> <?php ContactForm::your_attachment() ; ?>
                                <?php } ?>
                                <label for="message"><?php _e('Message', 'masjob') ; ?>:</label> <?php ContactForm::your_message() ; ?>
                                <input type="hidden" name="action" value="contact_post" />
                                <input type="hidden" name="page" value="item" />
                                <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
                                <button type="submit"><?php _e('Apply', 'masjob') ; ?></button>
                            </fieldset>
                        </form>
                    </div>
                    <script type="text/javascript">
                        function validate_contact() {
                            email = $("#yourEmail");

                            var pattern=/^([a-zA-Z0-9_\.-])+@([a-zA-Z0-9_\.-])+\.([a-zA-Z])+([a-zA-Z])+/;
                            var num_error = 0;

                            if(!pattern.test(email.value)){
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
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
    </body>
</html>