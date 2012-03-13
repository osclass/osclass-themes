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
        <form id="contact" name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post">
            <h1><?php _e('Send to a friend', 'seeker'); ?></h1>
            <fieldset>
                <input type="hidden" name="action" value="send_friend_post" />
                <input type="hidden" name="page" value="item" />
                <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                <label><?php _e('Item', 'seeker'); ?>: <a href="<?php echo osc_item_url( ); ?>"><?php echo osc_item_title(); ?></a></label>
                <?php if(osc_is_web_user_logged_in()) { ?>
                    <input type="hidden" name="yourName" value="<?php echo osc_logged_user_name(); ?>" />
                    <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
                <?php } else { ?>
                    <label for="yourName"><?php _e('Your name', 'seeker'); ?></label> <?php SendFriendForm::your_name(); ?>
                    <label for="yourEmail"><?php _e('Your e-mail address', 'seeker'); ?></label> <?php SendFriendForm::your_email(); ?>
                <?php }; ?>
                <label for="friendName"><?php _e("Your friend's name", 'seeker'); ?></label> <?php SendFriendForm::friend_name(); ?>
                <label for="friendEmail"><?php _e("Your friend's e-mail address", 'seeker'); ?></label> <?php SendFriendForm::friend_email(); ?>
                <label for="message"><?php _e('Message', 'seeker'); ?></label> <?php SendFriendForm::your_message(); ?>
                <?php osc_show_recaptcha(); ?>
                <br/>
                <button type="submit"><?php _e('Send', 'seeker'); ?></button>
            </fieldset>
        </form>
    </div>
</div>
<?php SendFriendForm::js_validation(); ?>
<?php osc_current_web_theme_path('footer.php') ; ?>