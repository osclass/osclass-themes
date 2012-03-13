<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container user">
            <div class="row">
                <div class="span16 columns">
                    <?php twitter_user_menu() ; ?>
                    <?php twitter_show_flash_message() ; ?>
                    <form action="<?php echo osc_base_url(true) ; ?>" method="post">
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="action" value="profile_post" />
                        <fieldset>
                            <legend><?php _e('Update your profile', 'twitter_bootstrap') ; ?></legend>
                            <div class="clearfix">
                                <label for="s_name"><?php _e('Name', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_name() ; ?>" name="s_name" id="s_name">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="email"><?php _e('E-mail', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge uneditable-input" type="text" value="<?php echo osc_user_email() ; ?>" id="email">
                                    <span class="help-block">
                                        <a href="<?php echo osc_change_user_email_url() ; ?>"><?php _e('Modify e-mail', 'twitter_bootstrap') ; ?></a> &middot; <a href="<?php echo osc_change_user_password_url() ; ?>" ><?php _e('Modify password', 'twitter_bootstrap') ; ?></a>
                                    </span>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="b_company"><?php _e('User type', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <select name="b_company" id="b_company">
                                        <option value="0" <?php if( !osc_user_field("b_company") ) echo 'selected="selected"'; ?> ><?php _e('User', 'twitter_bootstrap') ; ?></option>
                                        <option value="1" <?php if( osc_user_field("b_company") ) echo 'selected="selected"'; ?>><?php _e('Company', 'twitter_bootstrap') ; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="s_phone_mobile"><?php _e('Mobile phone', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_phone_mobile() ; ?>" name="s_phone_mobile" id="s_phone_mobile">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="s_phone_land"><?php _e('Phone', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_phone_land() ; ?>" name="s_phone_land" id="s_phone_land">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="country"><?php _e('Country', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <?php UserForm::country_select(osc_get_countries(), osc_user()) ; ?>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="region"><?php _e('Region', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <?php UserForm::region_select(osc_get_regions(), osc_user()) ; ?>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="city"><?php _e('City', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <?php UserForm::city_select(osc_get_cities(), osc_user()) ; ?>
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="cityArea"><?php _e('City area', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_city_area() ; ?>" name="cityArea" id="cityArea">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="address"><?php _e('Address', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_address() ; ?>" name="address" id="address">
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="s_website"><?php _e('Website', 'twitter_bootstrap') ; ?></label>
                                <div class="input">
                                    <input class="xlarge" type="text" value="<?php echo osc_user_website() ; ?>" name="s_website" id="s_website">
                                </div>
                            </div>
                            <div class="clearfix">
                                <?php osc_run_hook('user_form') ; ?>
                            </div>
                            <div class="actions">
                                <button class="btn" type="submit"><?php _e('Update', 'twitter_bootstrap') ; ?></button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var ajax_region_url    = '<?php echo osc_base_url(true) . "?page=ajax&action=regions&countryId=" ; ?>' ;
            var ajax_city_url      = '<?php echo osc_base_url(true) . "?page=ajax&action=cities&regionId=" ; ?>' ;
            var text_select_region = '<?php _e("Select a region...", 'twitter_bootstrap') ; ?>' ;
            var text_select_city   = '<?php _e("Select a city...", 'twitter_bootstrap') ; ?>' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('profile.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>