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
        <?php ContactForm::js_validation(); ?>
        <form id="contact" name="contact_form" action="<?php echo osc_base_url(true); ?>" method="post">
            <h1><?php _e('Apply for this job', 'seeker'); ?></h1>
            <fieldset>
                <?php ContactForm::primary_input_hidden() ; ?>
                <?php ContactForm::action_hidden() ; ?>
                <?php ContactForm::page_hidden() ; ?>
                <label><?php _e('Job offer', 'seeker'); ?>: <a href="<?php echo osc_item_url( ); ?>"><?php echo osc_item_title(); ?></a></label>
                <label for="yourName"><?php _e('Your name', 'seeker') ; ?>:</label> <?php ContactForm::your_name(); ?>
                <label for="yourEmail"><?php _e('Your e-mail address', 'seeker') ; ?>:</label> <?php ContactForm::your_email(); ?>
                <label for="phoneNumber"><?php _e('Phone number', 'seeker') ; ?> (<?php _e('optional', 'seeker'); ?>):</label> <?php ContactForm::your_phone_number(); ?>
                <?php if( osc_item_attachment() ) { ?>
                    <label for="subject"><?php _e('Your CV', 'seeker') ; ?></label> <?php ContactForm::your_attachment() ; ?>
                <?php } ?>
                <label for="message"><?php _e('Message', 'seeker') ; ?>:</label> <?php ContactForm::your_message(); ?>
                <?php osc_show_recaptcha(); ?>
                <br/>
                <button type="submit"><?php _e('Apply', 'seeker'); ?></button>
            </fieldset>
        </form>
    </div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>