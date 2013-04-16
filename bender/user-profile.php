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

    moder2_add_boddy_class('user user-profile');
    osc_add_hook('before-main','sidebar');
    function sidebar(){
        osc_current_web_theme_path('user-sidebar.php');
    }
    osc_current_web_theme_path('header.php') ;
    $osc_user = osc_user();
?>
<h1><?php _e('User account manager', 'bender'); ?></h1>
<h2><?php _e('Update your profile', 'bender'); ?></h2>
<?php UserForm::location_javascript(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#delete_account").click(function(){
            $("#dialog-delete-account").dialog('open');
        });

        $("#dialog-delete-account").dialog({
            autoOpen: false,
            modal: true,
            buttons: {
                "<?php echo osc_esc_js(__('Delete', 'bender')); ?>": function() {
                    window.location = '<?php echo osc_base_url(true).'?page=user&action=delete&id='.osc_user_id().'&secret='.$user['s_secret']; ?>';
                },
                "<?php echo osc_esc_js(__('Cancel', 'bender')); ?>": function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
</script>
<div class="form-container form-horizontal">
    <div class="resp-wrapper">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="profile_post" />
            <div class="control-group">
                <label class="control-label" for="name"><?php _e('Name', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::name_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="username"><?php _e('Username', 'bender'); ?></label>
                <div class="controls">
                    <?php echo osc_user_username(); ?><br />
                    <?php if(osc_user_username()==osc_user_id()) { ?>
                        <a href="<?php echo osc_change_user_username_url(); ?>"><?php _e('Modify username', 'bender'); ?></a>
                    <?php }; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email"><?php _e('E-mail', 'bender'); ?></label>
                <div class="controls">
                    <?php echo osc_user_email(); ?><br />
                    <a href="<?php echo osc_change_user_email_url(); ?>"><?php _e('Modify e-mail', 'bender'); ?></a> <a href="<?php echo osc_change_user_password_url(); ?>" ><?php _e('Modify password', 'bender'); ?></a>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="user_type"><?php _e('User type', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::is_company_select(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="phoneMobile"><?php _e('Cell phone', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::mobile_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="phoneLand"><?php _e('Phone', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::phone_land_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="country"><?php _e('Country', 'bender'); ?> *</label>
                <div class="controls">
                    <?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="region"><?php _e('Region', 'bender'); ?> *</label>
                <div class="controls">
                    <?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="city"><?php _e('City', 'bender'); ?> *</label>
                <div class="controls">
                    <?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="city_area"><?php _e('City area', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::city_area_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"l for="address"><?php _e('Address', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::address_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="webSite"><?php _e('Website', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::website_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="s_info"><?php _e('Description', 'bender'); ?></label>
                <div class="controls">
                    <?php UserForm::info_textarea('s_info', osc_locale_code(), $osc_user['locale'][$locale['pk_c_code']]['s_info']); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender');?></button>
                    <button id="delete_account" type="button" class="ui-button ui-button-middle ui-button-main"><?php _e("Delete my account", 'bender');?></button>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php osc_run_hook('user_form'); ?>
                </div>
            </div>
        </form>
    </div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>