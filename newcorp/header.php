<div class="wrapper_header">
    <div id="header">
        <a id="logo" href="<?php echo osc_base_url() ; ?>">
            <strong><?php echo logo_header() ; ?></strong>
        </a>
        <ul id="main_menu">
            <li><a href="<?php echo osc_base_url() ; ?>"><?php _e('Home', 'newcorp') ; ?></a></li>
            <?php osc_reset_static_pages() ; ?>
            <?php while( osc_has_static_pages() ) { ?>
                <li><a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title() ; ?></a></li>
            <?php } ?>
            <li><a href="<?php echo osc_contact_url() ; ?>"><?php _e('Contact', 'newcorp') ; ?></a></li>
        </ul>
        <div id="user_menu">
            <?php if ( osc_count_web_enabled_locales() > 1 ) { ?>
                    <?php osc_goto_first_locale() ; ?>
                    <ul>
                        <li class="last with_sub">
                            <strong><?php _e('Language', 'newcorp'); ?> (<?php echo osc_locale_name() ; ?>)</strong>
                            <ul>
                                <?php $i = 0 ;  ?>
                                <?php while ( osc_has_web_enabled_locales() ) { ?>
                                    <li <?php if($i == 0) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_name() ; ?></a></li>
                                    <?php $i++ ;
                                } ?>
                            </ul>
                        </li>
                    </ul>
            <?php } ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php osc_show_widgets('header') ; ?>
</div>