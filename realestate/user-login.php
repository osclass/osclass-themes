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
<div class="content-item">
    <div class="content user_forms">
        <div class="ui-generic-form ui-center single-form">
            <h1><?php _e('Access to your account', 'realestate'); ?></h1>
            <div class="ui-generic-form-content">
                <form action="<?php echo osc_base_url(true); ?>" method="post" >
                    <input type="hidden" name="page" value="login" />
                    <input type="hidden" name="action" value="login_post" />
                    <fieldset>
                        <div class="row ui-row-text"><label for="email"><?php _e('E-mail', 'realestate'); ?></label> <?php UserForm::email_login_text() ; ?></div>
                        <div class="row ui-row-text"><label for="password"><?php _e('Password', 'realestate'); ?></label> <?php UserForm::password_login_text() ; ?></div>
                        <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label for="rememberMe"><?php _e('Remember me', 'realestate') ; ?></label></p>
                        <div class="actions actions-side">
                            <div class="side"><a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Log in", 'realestate');?></a></div>
                            <div class="mini">
                            <a href="<?php echo osc_register_account_url() ; ?>"><?php _e("Register for a free account", 'realestate') ; ?></a><br />
                            <a href="<?php echo osc_recover_user_password_url() ; ?>"><?php _e("Forgot password?", 'realestate') ; ?></a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>