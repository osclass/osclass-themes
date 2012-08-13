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
        <h2><?php _e('Update your profile', 'realestate'); ?></h2>
        <div class="ui-generic-form ui-center">
            <div class="ui-generic-form-content">
            <?php UserForm::location_javascript(); ?>
                <form action="<?php echo osc_base_url(true) ; ?>" method="post">
                    <input type="hidden" name="page" value="user" />
                    <input type="hidden" name="action" value="profile_post" />
                    <fieldset>
                        <div class="row ui-row-text">
                            <label for="name"><?php _e('Name', 'realestate') ; ?></label>
                            <?php UserForm::name_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="email"><?php _e('E-mail', 'realestate') ; ?></label>
                            <span class="update">
                                <input type="text" disabled="disabled" value="<?php echo osc_user_email() ; ?>" />
                            </span>
                        </div>
                        <div class="actions actions-top">
                            <a href="<?php echo osc_change_user_email_url() ; ?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('Modify e-mail', 'realestate') ; ?></a> <a href="<?php echo osc_change_user_password_url() ; ?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('Modify password', 'realestate') ; ?></a>
                        </div>
                        <div class="row ui-row-text">
                            <label for="user_type"><?php _e('User type', 'realestate') ; ?></label>
                            <?php UserForm::is_company_select(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="phoneMobile"><?php _e('Cell phone', 'realestate') ; ?></label>
                            <?php UserForm::mobile_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="phoneLand"><?php _e('Phone', 'realestate') ; ?></label>
                            <?php UserForm::phone_land_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="country"><?php _e('Country', 'realestate') ; ?> *</label>
                            <?php UserForm::country_select(osc_get_countries(), osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="region"><?php _e('Region', 'realestate') ; ?> *</label>
                            <?php UserForm::region_select(osc_get_regions(), osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="city"><?php _e('City', 'realestate') ; ?> *</label>
                            <?php UserForm::city_select(osc_get_cities(), osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="city_area"><?php _e('City area', 'realestate') ; ?></label>
                            <?php UserForm::city_area_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="address"><?php _e('Address', 'realestate') ; ?></label>
                            <?php UserForm::address_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <label for="webSite"><?php _e('Website', 'realestate') ; ?></label>
                            <?php UserForm::website_text(osc_user()) ; ?>
                        </div>
                        <div class="row ui-row-text">
                            <?php UserForm::multilanguage_info(osc_get_locales(), osc_user()); ?>
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