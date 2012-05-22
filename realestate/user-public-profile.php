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

    $address = '';
    if(osc_user_address()!='') {
        if(osc_user_city_area()!='') {
            $address = osc_user_address().", ".osc_user_city_area();
        } else {
            $address = osc_user_address();
        }
    } else {
        $address = osc_user_city_area();
    }
    $location_array = array();
    if(trim(osc_user_city()." ".osc_user_zip())!='') {
        $location_array[] = trim(osc_user_city()." ".osc_user_zip());
    }
    if(osc_user_region()!='') {
        $location_array[] = osc_user_region();
    }
    if(osc_user_country()!='') {
        $location_array[] = osc_user_country();
    }
    $location = implode(", ", $location_array);
    unset($location_array);
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content-item user-profile">
    <div id="left-side">
        <h1><?php echo sprintf(__('%s\'s profile', 'realestate'), osc_user_name()); ?></h1>
        <h2><?php _e('Profile'); ?></h2>
        <ul class="user-profile-data">
                <li><label><?php _e('Full name'); ?>:</label> <?php echo osc_user_name(); ?></li>
                <li><label><?php _e('Address'); ?>:</label> <?php echo $address; ?></li>
                <li><label><?php _e('Location'); ?>:</label> <?php echo $location; ?></li>
                <li><label><?php _e('Website'); ?>:</label> <?php echo osc_user_website(); ?></li>
                <li><label><?php _e('User Description'); ?>:</label> <?php echo osc_user_info(); ?></li>
            </ul>
        <h2><?php _e('Latest items', 'realestate'); ?></h2>
        <div class="ad_list">
            <?php if(osc_count_items() == 0) { ?>
            <h3><?php _e('No listings have been added yet', 'realestate'); ?></h3>
        <?php } else { ?>
            <?php while(osc_has_items()) { ?>
            <div class="ui-item ui-item-list">
                <div class="frame">
                    <a href="<?php echo osc_item_url() ; ?>"><?php if( osc_images_enabled_at_items() ) { ?>
                        <?php if( osc_count_item_resources() ) { ?>
                            <img src="<?php echo osc_resource_thumbnail_url() ; ?>" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                        <?php } ?>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                    <?php } ?>
                    <div class="type"><?php echo osc_item_category(); ?></div>
                    <?php if( osc_price_enabled_at_items() ) { ?><div class="price"><?php echo osc_item_formated_price() ; ?></div> <?php } ?>
                    </a>
                </div>
                <div class="info">
                    <div>
                        <h3><a href="<?php echo osc_item_url() ; ?>"><?php if(strlen(osc_item_title()) > 31){ echo substr(osc_item_title(), 0, 28).'...'; } else { echo osc_item_title(); } ?></a></h3>
                    </div>
                    <div class="data data-full">
                        <?php _e('Publication date', 'realestate') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?><br />
                        <div>
                        <a href="<?php echo osc_item_url(); ?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('View item', 'realestate'); ?></a>
                        <?php if(osc_item_is_inactive()) {?>
                        <a href="<?php echo osc_item_activate_url();?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('Activate', 'realestate'); ?></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
        
    </div>
    <div id="right-side">
        <div id="contact">
                    <div class="contact-wrapper contact-form">
                    <h2><?php _e("Contact publisher", 'realestate') ; ?></h2>
                    <?php if(osc_logged_user_id()!=  osc_user_id()) {
                    if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
                        <ul id="error_list"></ul>
                        <?php ContactForm::js_validation(); ?>
                        <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form">
                            <input type="hidden" name="action" value="contact_post" />
                            <input type="hidden" name="page" value="user" />
                            <input type="hidden" name="id" value="<?php echo osc_user_id();?>" />
                            <?php osc_prepare_user_info() ; ?>
                            <fieldset>
                                <label for="yourName"><?php _e('Your name', 'realestate') ; ?>:</label> <?php ContactForm::your_name(); ?>
                                <label for="yourEmail"><?php _e('Your e-mail address', 'realestate') ; ?>:</label> <?php ContactForm::your_email(); ?>
                                <label for="phoneNumber"><?php _e('Phone number', 'realestate') ; ?> (<?php _e('optional', 'realestate'); ?>):</label> <?php ContactForm::your_phone_number(); ?>
                                <label for="message"><?php _e('Message', 'realestate') ; ?>:</label> <?php ContactForm::your_message(); ?>
                                <?php if( osc_recaptcha_public_key() ) { ?>
                                <script type="text/javascript">
                                    var RecaptchaOptions = {
                                        theme : 'custom',
                                        custom_theme_widget: 'recaptcha_widget'
                                    };
                                </script>
                                <style type="text/css"> div#recaptcha_widget, div#recaptcha_image > img { width:280px; } </style>
                                <div id="recaptcha_widget">
                                    <div id="recaptcha_image"><img /></div>
                                    <span class="recaptcha_only_if_image"><?php _e('Enter the words above','realestate'); ?>:</span>
                                    <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                                    <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'realestate'); ?></a></div>
                                </div>
                                <?php } ?>
                                <?php osc_show_recaptcha(); ?>                                
                                <a href="#" class="ui-button m-top-15 js-submit"><?php _e('Send', 'realestate') ; ?></a>
                            </fieldset>
                        </form>
                    <?php }
                }?>
                    </div>
                </div>
    </div>
                
    <div class="clear"></div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>