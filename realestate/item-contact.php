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
    osc_add_filter('meta_robots','meta_robots_custom');
    function meta_robots_custom(){
        return 'noindex, nofollow';
    }
    function itemCustomHead(){ ?>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js'); ?>"></script>'
<?php 
    }
    osc_add_hook('header','itemCustomHead');
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content">
    <div class="content user_forms">
        <div class="ui-generic-form ui-center single-form contact-form">
            <h1><?php _e('Contact seller', 'realestate') ; ?></h1>
            <ul id="error_list"></ul>
            <div class="ui-generic-form-content">
                <form action="<?php echo osc_base_url(true); ?>" method="post" name="contact_form" id="contact_form" >
                    <?php ContactForm::primary_input_hidden() ; ?>
                    <?php ContactForm::action_hidden() ; ?>
                    <?php ContactForm::page_hidden() ; ?>
                    <fieldset>
                        <div class="row ui-row-text"><label><?php _e('Item', 'realestate'); ?>:</label><a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title() ; ?></a></div>
                        <div class="row ui-row-text"><label><?php _e('To (seller)', 'realestate'); ?>:</label> <input type="text" value="<?php echo osc_item_contact_name() ;?>" disabled="disabled" /></div>
                        <?php if(osc_is_web_user_logged_in()) { ?>
                            <input type="hidden" name="yourName" value="<?php echo osc_logged_user_name(); ?>" />
                            <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
                        <?php } else { ?>
                            <div class="row ui-row-text"><label for="yourName"><?php _e('Your name', 'realestate'); ?></label> <?php ContactForm::your_name(); ?></div>
                            <div class="row ui-row-text"><label for="yourEmail"><?php _e('Your e-mail address', 'realestate'); ?></label> <?php ContactForm::your_email(); ?></div>
                        <?php }; ?>
                        <div class="row ui-row-text"><label for="phoneNumber"><?php _e('Phone number', 'realestate'); ?> (<?php _e('optional', 'realestate'); ?>)</label> <?php ContactForm::your_phone_number(); ?></div>
                        <div class="row ui-row-text"><label for="message"><?php _e('Message', 'realestate'); ?></label> <?php ContactForm::your_message(); ?></div>
                        <div class="actions">
                            <?php osc_show_recaptcha(); ?>
                            <a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Send message", 'realestate');?></a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php ContactForm::js_validation() ; ?>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>