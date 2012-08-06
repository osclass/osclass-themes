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
            <h1><?php _e('Send to a friend', 'realestate') ; ?></h1>
            <ul id="error_list"></ul>
            <div class="ui-generic-form-content">
                <form id="sendfriend" name="sendfriend" action="<?php echo osc_base_url(true); ?>" method="post">
                    <input type="hidden" name="action" value="send_friend_post" />
                    <input type="hidden" name="page" value="item" />
                    <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
                    <fieldset>
                        <div class="row ui-row-text"><label><?php _e('Item', 'realestate'); ?>:</label><a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title() ; ?></a></div>
                        <?php if(osc_is_web_user_logged_in()) { ?>
                            <input type="hidden" name="yourName" value="<?php echo osc_logged_user_name(); ?>" />
                            <input type="hidden" name="yourEmail" value="<?php echo osc_logged_user_email();?>" />
                        <?php } else { ?>
                            <div class="row ui-row-text"><label for="yourName"><?php _e('Your name', 'realestate'); ?></label> <?php SendFriendForm::your_name(); ?></div>
                            <div class="row ui-row-text"><label for="yourEmail"><?php _e('Your e-mail address', 'realestate'); ?></label> <?php SendFriendForm::your_email(); ?></div>
                        <?php }; ?>
                        <div class="row ui-row-text"><label for="friendName"><?php _e("Your friend's name", 'realestate'); ?></label> <?php SendFriendForm::friend_name(); ?></div>
                        <div class="row ui-row-text"><label for="friendEmail"><?php _e("Your friend's e-mail address", 'realestate'); ?></label> <?php SendFriendForm::friend_email(); ?></div>
                        <div class="row ui-row-text"><label for="message"><?php _e('Message', 'realestate'); ?></label> <?php SendFriendForm::your_message(); ?></div>
                        <div class="actions">
                            <?php osc_show_recaptcha(); ?>
                            <a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Send", 'realestate');?></a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <?php SendFriendForm::js_validation() ; ?>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>