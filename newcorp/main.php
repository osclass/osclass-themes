<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow" />
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content home">
                <div id="main">
                   <?php osc_current_web_theme_path('inc.search.php') ; ?>
                   <div class="latest_ads">
                        <h1><strong><?php _e('Latest job offers', 'newcorp') ; ?></strong></h1>
                         <?php if( osc_count_latest_items() == 0) { ?>
                            <p class="empty"><?php _e('There aren\'t job offers available at this moment', 'newcorp'); ?></p>
                        <?php } else { ?>
                            <table border="0" cellspacing="0">
                                <tbody>
                                <?php $class = "odd" ; ?>
                                <?php while ( osc_has_latest_items() ) { ?>
                                    <tr class="<?php echo $class ; ?>">
                                        <td class="title">
                                            <strong>
                                                <a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a>
                                            </strong>
                                        </td>
                                        <td class="location">
                                            <strong><?php echo osc_item_city() ; ?></strong>
                                        </td>
                                        <td class="date"><?php echo osc_format_date( osc_item_pub_date() ) ; ?></td>
                                    </tr>
                                    <?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
                                <p class="see_more_link"><a href="<?php echo osc_search_show_all_url() ; ?>">
                                    <strong><?php _e('See all job offers', 'newcorp') ; ?> &raquo;</strong></a>
                                </p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="publish_box companies">
                        <h2><strong><?php _e('Upload your CV and', 'newcorp') ; ?>:</strong></h2>
                        <p><?php _e('We will automatically receive your information and we will study your candidature', 'newcorp') ; ?></p>
                        <strong class="button_link">
                            <a rel="nofollow" href="<?php echo osc_contact_url( ) ; ?>">
                                <?php _e('Upload your CV now!', 'newcorp') ; ?>
                            </a>
                        </strong>
                    </div>
                    <div class="navigation">
                        <?php if( osc_count_list_regions() > 0 ) { ?>
                            <div class="box location">
                                <h3><strong><?php _e('Region', 'newcorp'); ?></strong></h3>
                                <ul>
                                    <?php while(osc_has_list_regions()) { ?>
                                        <li>
                                            <a href="<?php echo osc_search_url( array( 'sRegion' => osc_list_region_name() ) ) ; ?>"><?php echo osc_list_region_name() ; ?></a>
                                            <em>(<?php echo osc_list_region_items() ; ?>)</em>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if ( osc_count_categories() > 0 ) { ?>
                            <?php osc_goto_first_category() ; ?>
                            <div class="box categories">
                                <h3><strong><?php _e('Categories', 'newcorp') ; ?></strong></h3>
                                <ul>
                                    <?php while ( osc_has_categories() ) { ?>
                                        <li>
                                            <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a>
                                            <em>(<?php echo osc_category_total_items() ; ?>)</em>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>