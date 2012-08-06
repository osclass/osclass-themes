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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <?php
        if(osc_is_search_page()){
            if(osc_count_items() == 0) {
                osc_add_filter('meta_robots','meta_robots_custom');
                function meta_robots_custom(){
                    return 'noindex, nofollow';
                }
            }
        };?>
        <meta name="robots" content="<?php echo osc_apply_filter('meta_robots','index, follow'); ?>" />
        <meta name="googlebot" content="<?php echo osc_apply_filter('meta_robots','index, follow'); ?>" />
    </head>
<body>
<?php osc_show_flash_message() ; ?>    
<!-- header -->
<div id="header">
    <a id="logo" href="<?php echo osc_base_url() ; ?>"><?php echo logo_header(); ?></a>
    <div id="user_menu">
        <ul>
            <?php if(osc_users_enabled()) { ?>
                <?php if( osc_is_web_user_logged_in() ) { ?>
                    <li class="first logged">
                        <?php echo sprintf(__('Hi %s', 'realestate'), osc_logged_user_name() . '!'); ?> &bull;
                        <strong><a href="<?php echo osc_user_dashboard_url() ; ?>"><?php _e('My account', 'realestate') ; ?></a></strong> &middot;
                        <a href="<?php echo osc_user_logout_url() ; ?>"><?php _e('Logout', 'realestate') ; ?></a>
                    </li>
                <?php } else { ?>
                    <li class="first">
                        <a id="login_open" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'realestate') ; ?></a>
                        <?php if(osc_user_registration_enabled()) { ?>
                            &bull; <a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register for a free account', 'realestate'); ?></a>
                        <?php }; ?>
                        <form id="login" action="<?php echo osc_base_url(true) ; ?>" method="post">
                            <fieldset>
                                <input type="hidden" name="page" value="login" />
                                <input type="hidden" name="action" value="login_post" />
                                <label for="email"><?php _e('E-mail', 'realestate') ; ?></label>
                                <?php UserForm::email_login_text() ; ?>
                                <label for="password"><?php _e('Password', 'realestate') ; ?></label>
                                <?php UserForm::password_login_text() ; ?>
                                <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label for="rememberMe"><?php _e('Remember me', 'realestate') ; ?></label></p>
                                <button type="submit"><?php _e('Log in', 'realestate') ; ?></button>
                                <div class="forgot">
                                    <a href="<?php echo osc_recover_user_password_url() ; ?>"><?php _e("Forgot password?", 'realestate');?></a>
                                </div>
                            </fieldset>
                        </form>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                <?php osc_goto_first_locale() ; ?>
                <li class="last with_sub">
                    <strong><?php _e("Language", 'realestate') ; ?></strong>
                    <ul>
                        <?php $i = 0 ;  ?>
                        <?php while ( osc_has_web_enabled_locales() ) { ?>
                            <li <?php if( $i == 0 ) { echo "class='first'" ; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_name() ; ?></a></li>
                            <?php $i++ ; ?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            <div class="clear"></div>
        </ul>
        <?php if( osc_users_enabled() || ( !osc_users_enabled() && !osc_reg_user_post() )) { ?>
                <a href="<?php echo osc_item_post_url_in_category() ; ?>" id="form_publish" class="ui-button"><?php _e("Publish your ad for free", 'realestate');?></a>
        <?php } ?>
        <div class="empty"></div>
    </div>
    <div id="header-shadow"></div>
</div>
<!-- /header -->
<?php if( function_exists('breadcrumbs') ) { ?>
    <?php if( !osc_is_home_page() ) { ?>
    <div class="breadcrumb">
        <?php breadcrumbs('&raquo;'); ?>
    </div>
    <?php } ?>
<?php } ?>
<!-- container -->
<div class="container">
<?php osc_show_widgets('header') ; ?>