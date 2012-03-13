<div id="header">
    <a id="logo" href="<?php echo osc_base_url() ; ?>"><strong><?php echo osc_page_title() ; ?></strong></a>
    <div id="user_menu">
        <ul>
            <?php if( osc_is_web_user_logged_in() ) { ?>
                <li class="first logged">
                    <?php printf(__('Hi %s', 'hierarchy'), osc_logged_user_name() . '!') ; ?>  &middot;
                    <strong><a href="<?php echo osc_user_list_items_url() ; ?>"><?php _e('My account', 'hierarchy') ; ?></a></strong> &middot;
                    <a href="<?php echo osc_user_logout_url() ; ?>"><?php _e('Logout', 'hierarchy') ; ?></a>
                </li>
            <?php } else { ?>
                <li class="first">
                    <a id="login_open" href="<?php echo osc_user_login_url(); ?>"><?php _e('Login', 'hierarchy') ; ?></a>  &middot;
                    <a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register for a free account', 'hierarchy'); ?></a>
                    <form id="login" action="<?php echo osc_base_url(true) ; ?>" method="post">
                        <fieldset>
                            <input type="hidden" name="page" value="login" />
                            <input type="hidden" name="action" value="login_post" />
                            <label for="email"><?php _e('E-mail', 'hierarchy') ; ?></label>
                            <?php UserForm::email_login_text() ; ?>
                            <label for="password"><?php _e('Password', 'hierarchy') ; ?></label>
                            <?php UserForm::password_login_text() ; ?>
                            <p class="checkbox"><?php UserForm::rememberme_login_checkbox();?> <label for="rememberMe"><?php _e('Remember me', 'hierarchy') ; ?></label></p>
                            <button type="submit"><?php _e('Log in', 'hierarchy') ; ?></button>
                            <div class="forgot">
                                <a href="<?php echo osc_recover_user_password_url() ; ?>"><?php _e("Forgot password?", 'hierarchy');?></a>
                            </div>
                        </fieldset>
                    </form>
                </li>
            <?php } ?>
            <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                <?php osc_goto_first_locale() ; ?>
                <li class="last with_sub">
                    <strong><?php _e("Language", 'hierarchy') ; ?></strong>
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
            <strong class="publish_button"><a href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish a new ad", 'hierarchy') ; ?></a></strong>
        </div>
        <div class="empty"></div>
    </div>
</div>
<?php osc_show_widgets('header') ; ?>
<?php if ( function_exists('breadcrumbs') ) { breadcrumbs('>'); } ?>