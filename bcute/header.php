<div id="header">
    <a id="logo" href="<?php echo osc_base_url() ; ?>"><strong><?php echo osc_page_title() ; ?></strong></a>
    <div id="user_menu">
        <ul>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li class="first logged">
                    <?php printf(__('Hi %s', 'bcute'), osc_logged_user_name() . '!'); ?>  &middot;
                    <strong><a href="<?php echo osc_user_dashboard_url() ; ?>"><?php _e('My account', 'bcute') ; ?></a></strong> &middot;
                    <a href="<?php echo osc_user_logout_url() ; ?>"><?php _e('Logout', 'bcute') ; ?></a>
                </li>
            <?php } else { ?>
                <li class="first">
                    <a id="login_open" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'bcute') ; ?></a>  &middot;
                    <a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register for a free account', 'bcute'); ?></a>
                    <form id="login" action="<?php echo osc_base_url(true) ; ?>" method="post">
                        <fieldset>
                            <input type="hidden" name="page" value="login" />
                            <input type="hidden" name="action" value="login_post" />
                            <label for="email"><?php _e('E-mail', 'bcute') ; ?></label>
                            <?php UserForm::email_login_text() ; ?>
                            <label for="password"><?php _e('Password', 'bcute') ; ?></label>
                            <?php UserForm::password_login_text() ; ?>
                            <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label for="rememberMe"><?php _e('Remember me', 'bcute') ; ?></label></p>
                            <button type="submit"><?php _e('Log in', 'bcute') ; ?></button>
                            <div class="forgot">
                                <a href="<?php echo osc_recover_user_password_url() ; ?>"><?php _e("Forgot password?", 'bcute');?></a>
                            </div>
                        </fieldset>
                    </form>
                </li>
            <?php } ?>
            <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                <?php osc_goto_first_locale() ; ?>
                <li class="last with_sub">
                    <strong><?php _e("Language", 'bcute') ; ?></strong>
                    <ul>
                        <?php $i = 0 ;  ?>
                        <?php while ( osc_has_web_enabled_locales() ) { ?>
                            <li <?php if( $i == 0 ) { echo "class='first'" ; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_name() ; ?></a></li>
                            <?php $i++ ; ?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
        <div id="form_publish">
            <strong class="publish_button"><a href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish your ad for free", 'bcute');?></a></strong>
            <a class="twitter" href="#"></a>
            <a class="facebook" href="#"></a>
        </div>
        <div class="empty"></div>
    </div>
</div>
<?php osc_show_widgets('header') ; ?>