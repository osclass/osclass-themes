<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *  advertising platforms
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
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content user_forms">
    <div class="inner">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true) ; ?>" <?php if( osc_contact_attachment() ) { ?>enctype="multipart/form-data"<?php } ?> method="post" name="contact_form" id="contact">
            <h1><?php _e('Upload your CV', 'seeker') ; ?></h1>
            <input type="hidden" name="page" value="contact" />
            <input type="hidden" name="action" value="contact_post" />
            <fieldset>
                <label for="subject"><?php _e('Subject', 'seeker') ; ?> (<?php _e('optional', 'seeker'); ?>)</label> <?php ContactForm::the_subject() ; ?>
                <label for="yourName"><?php _e('Your name', 'seeker') ; ?> (<?php _e('optional', 'seeker'); ?>)</label> <?php ContactForm::your_name() ; ?>
                <label for="yourEmail"><?php _e('Your e-mail address', 'seeker') ; ?></label> <?php ContactForm::your_email(); ?>
                <?php if( osc_contact_attachment() ) { ?>
                    <label for="subject"><?php _e('Your CV', 'seeker') ; ?></label> <?php ContactForm::your_attachment() ; ?>
                <?php } ?>
                <label for="message"><?php _e('Message', 'seeker') ; ?></label> <?php ContactForm::your_message() ; ?>
                <?php osc_show_recaptcha(); ?>
                <button type="submit"><?php _e('Send', 'seeker') ; ?></button>
                <?php osc_run_hook('user_register_form') ; ?>
            </fieldset>
        </form>
    </div>
</div>
<?php ContactForm::js_validation() ; ?>
<?php osc_current_web_theme_path('footer.php') ; ?>