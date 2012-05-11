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
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content user-area">
    <div id="right-side">
        <h1><?php _e('User account manager', 'realestate') ; ?></h1>
        <h2><?php _e('Change your e-mail', 'realestate'); ?></h2>
        <div class="ui-generic-form ui-center">
            <div class="ui-generic-form-content">
                <form action="<?php echo osc_base_url(true) ; ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="change_email_post" />
                    <fieldset>
                        <div class="row ui-row-text">
                            <label for="email"><?php _e('Current e-mail', 'realestate') ; ?></label>
                            <input type="text" disabled="disabled" value="<?php echo osc_logged_user_email(); ?>" />
                        </div>
                        <div class="row ui-row-text">
                            <label for="new_email"><?php _e('New e-mail', 'realestate') ; ?> *</label>
                            <input type="text" name="new_email" id="new_email" value="" />
                        </div>
                        <div class="actions">
                            <a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Update", 'realestate');?></a>
                        </div>
                        <?php osc_run_hook('user_form') ; ?>
                    </fieldset>
                </form>
            </div>
        </div>    
    </div>
    <?php require('user_sidebar.php') ; ?>
    <div class="clear"></div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>