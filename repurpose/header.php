        <!-- header -->
        <div id="header-main">
            <div id="header-inner">
                <div id="logo">
                    <?php if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
                        <a href="<?php echo osc_base_url() ; ?>">
                            <img src="<?php echo osc_current_web_theme_url('images/logo.jpg') ; ?>" alt="<?php echo osc_page_title() ; ?>" title="<?php echo osc_page_title() ; ?>" />
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo osc_base_url() ; ?>"><?php echo osc_page_title() ; ?></a>
                    <?php } ?>
                </div>
                <ul id="nav">
                    <?php if( osc_users_enabled() ) { ?>
                        <?php if( osc_is_web_user_logged_in() ) { ?>
                            <li><span class="link"><?php printf(__('Hi %s', 'twitter'), osc_logged_user_name() . '!'); ?></span></li>
                            <li><a href="<?php echo osc_user_dashboard_url() ; ?>"><?php _e('My account', 'twitter') ; ?></a></li>
                            <li><a href="<?php echo osc_user_logout_url() ; ?>"><?php _e('Logout', 'twitter') ; ?></a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo osc_user_login_url() ; ?>"><?php _e('Login', 'twitter') ; ?></a></li>
                            <li><a href="<?php echo osc_register_account_url() ; ?>"><?php _e('Register', 'twitter') ; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ( osc_count_web_enabled_locales() > 1) { ?>
                    <?php osc_goto_first_locale() ; ?>
                    <li class="languages">
                        <a class="active" href="#"><?php _e('Language', 'twitter'); ?> <?php while ( osc_has_web_enabled_locales() ) { if( osc_locale_code() == osc_current_user_locale()) { ?>(<?php echo osc_locale_field('s_short_name') ; ?>)<?php } } ?></a>
                        <ul class="tabs">
                        <?php $i = 0 ;  ?>
                        <?php osc_goto_first_locale() ; ?>
                        <?php while ( osc_has_web_enabled_locales() ) { ?>
                            <li <?php if($i == 0) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_field('s_short_name') ; ?></a></li>
                        <?php $i++ ; } ?>
                        </ul>
                    </li>
                <?php } ?>
                    <li>
                        <a class="publish-btn" href="<?php echo osc_item_post_url_in_category() ; ?>"><?php _e("Publish your ad for free", 'twitter'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="topbar">
            <div class="topbar-wrapper">
                <?php osc_goto_first_category() ; ?>
                <?php if(osc_count_categories () > 0) { ?>
                <ul class="nav">
                    <?php while ( osc_has_categories() ) { ?>
                    <li class="<?php echo osc_category_slug() ; ?><?php if ( osc_count_subcategories() > 0 ) { ?> menu<?php } ?>">
                        <a href="<?php echo osc_search_category_url() ; ?>" <?php if ( osc_count_subcategories() > 0 ) { ?>class="menu"<?php } ?>><?php View::newInstance()->_erase('subcategories'); echo osc_category_name() ; ?></a>
                        <?php if ( osc_count_subcategories() > 0 ) { ?>
                        <ul class="menu-dropdown">
                            <?php while ( osc_has_subcategories() ) { ?>
                            <li class="<?php echo osc_category_slug() ; ?>"><a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                    <div style="clear:both"></div>
                </ul>
                <?php } ?>
            </div>
        </div><!-- /topbar -->
        <script type="text/javascript">
        $(function(){
            $('#nav .tabs').each(function(){
                $(this).parent().hover(function(){
                    $(this).addClass('hover');
                },function(){
                    $(this).removeClass('hover');
                });
            });
        });
        </script>
        <!-- header end -->