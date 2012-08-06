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
    function itemCustomHead(){
        '<script type="text/javascript" src="'.osc_current_web_theme_js_url('jquery.validate.min.js').'"></script>';
    }
    osc_add_hook('header','itemCustomHead');
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content-item">
    <div class="content user_forms contact-form">
        <div class="ui-generic-form ui-center single-form">
            <h1><?php _e('Contact us', 'realestate') ; ?></h1>
            <ul id="error_list"></ul>
            <div class="ui-generic-form-content">
                <form action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact">
                    <input type="hidden" name="page" value="contact" />
                    <input type="hidden" name="action" value="contact_post" />
                    <fieldset>
                        <div class="row ui-row-text"><label for="subject"><?php _e('Subject', 'realestate') ; ?> (<?php _e('optional', 'realestate'); ?>)</label> <?php ContactForm::the_subject() ; ?></div>
                        <div class="row ui-row-text"><label for="message"><?php _e('Message', 'realestate') ; ?></label> <?php ContactForm::your_message() ; ?></div>
                        <div class="row ui-row-text"><label for="yourName"><?php _e('Your name', 'realestate') ; ?> (<?php _e('optional', 'realestate'); ?>)</label> <?php ContactForm::your_name() ; ?></div>
                        <div class="row ui-row-text"><label for="yourEmail"><?php _e('Your e-mail address', 'realestate') ; ?></label> <?php ContactForm::your_email(); ?></div>
                        <div class="actions">
                            <?php osc_show_recaptcha(); ?>
                            <a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Send", 'realestate');?></a>
                        </div>
                        <?php osc_run_hook('user_register_form') ; ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php ContactForm::js_validation() ; ?>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>