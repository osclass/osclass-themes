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
<div id="sidebar">
    <ul id="error_list"></ul>
    <div id="contact">
        <h2><?php _e("Apply for this job", 'seeker') ; ?></h2>
        <?php if( osc_item_is_expired () ) { ?>
            <p>
                <?php _e('The item is expired. You cannot contact the publisher.', 'seeker') ; ?>
            </p>
        <?php } else if( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) { ?>
            <p>
                <?php _e("It's your own item, you cannot contact the publisher.", 'seeker') ; ?>
            </p>
        <?php } else if( osc_reg_user_can_contact() && !osc_is_web_user_logged_in() ) { ?>
            <p>
                <?php _e("You must login or register a new free account in order to contact the advertiser", 'seeker') ; ?>
            </p>
            <p class="contact_button">
                <strong><a href="<?php echo osc_user_login_url() ; ?>"><?php _e('Login', 'seeker') ; ?></a></strong>
                <strong><a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register for a free account', 'seeker'); ?></a></strong>
            </p>
        <?php } else { ?>
            <?php ContactForm::js_validation(); ?>
            <form action="<?php echo osc_base_url(true) ; ?>" <?php if( osc_item_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> method="post" name="contact_form" id="contact_form">
                <?php osc_prepare_user_info() ; ?>
                <fieldset>
                    <label for="yourName"><?php _e('Your name', 'seeker') ; ?>:</label> <?php ContactForm::your_name(); ?>
                    <label for="yourEmail"><?php _e('Your e-mail address', 'seeker') ; ?>:</label> <?php ContactForm::your_email(); ?>
                    <label for="phoneNumber"><?php _e('Phone number', 'seeker') ; ?> (<?php _e('optional', 'seeker'); ?>):</label> <?php ContactForm::your_phone_number(); ?>
                    <?php if( osc_item_attachment() ) { ?>
                        <label for="subject"><?php _e('Your CV', 'seeker') ; ?></label> <?php ContactForm::your_attachment() ; ?>
                    <?php } ?>
                    <label for="message"><?php _e('Message', 'seeker') ; ?>:</label> <?php ContactForm::your_message(); ?>
                    <input type="hidden" name="action" value="contact_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id() ; ?>" />
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
                        <span class="recaptcha_only_if_image"><?php _e('Enter the words above','seeker'); ?>:</span>
                        <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
                        <div><a href="javascript:Recaptcha.showhelp()"><?php _e('Help', 'seeker'); ?></a></div>
                    </div>
                    <?php } ?>
                    <?php osc_show_recaptcha(); ?>
                    <button type="submit"><?php _e('Apply', 'seeker') ; ?></button>
                </fieldset>
            </form>
        <?php } ?>
    </div>
</div>