<?php
    /**
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
    </head>
    <body>
        <!--<div class="mega_banner"><img src="https://www.google.com/adsense/static/es/images/leaderboard_img.jpg" /></div>-->
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content home">
                <div id="main">
                   <?php osc_current_web_theme_path('inc.search.php') ; ?>
                   <div class="latest_ads">
                        <h1><?php _e('<strong>Latest</strong> job offers', 'masjob') ; ?></h1>
                         <?php if( osc_count_latest_items() == 0) { ?>
                            <p class="empty"><?php _e('There aren\'t job offers available at this moment', 'masjob'); ?></p>
                        <?php } else { ?>
                            <ul>
                                <?php $class = "l1" ; ?>
                                <?php $counter = 0 ; ?>
                                <?php while ( osc_has_latest_items() ) { ?>
                                    <?php if ( $counter == 4 ) { ?>
                                        <!--
                                        <li class="l1 banner">
                                            <img src="https://www.google.com/adsense/static/es/images/inline_rectangle.gif" />
                                        </li>
                                        <li class="l2 banner">
                                            <img src="https://www.google.com/adsense/static/es/images/inline_rectangle.gif" />
                                        </li>
                                    -->
                                    <?php } ?>
                                    <li class="<?php echo $class ; ?>">
                                        <h2 class="title"><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></h2>                    
                                        <p class="meta">
                                            <strong><?php echo osc_item_city() ; ?></strong>
                                            <em class="date"><?php echo osc_format_date( osc_item_pub_date() ) ; ?></em> 
                                        </p>
                                        <p class="description">
                                            <?php echo osc_highlight( strip_tags( osc_item_description() ) ) ; ?>
                                        </p>
                                        <?php $class = ($class == 'l2') ? 'l1' : 'l2' ; ?>
                                    </li>
                                    <?php $counter++; ?>
                                <?php } ?>
                            </ul>
                            <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
                                <p class="see_more_link"><a href="<?php echo osc_search_url() ; ?>">
                                    <strong><?php _e('See all job offers', 'masjob') ; ?> &raquo;</strong></a>
                                </p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="publish_box companies">
                        <h2><strong><?php _e('Upload your CV and', 'masjob') ; ?>:</strong></h2>
                        <p><?php _e('We will automatically receive your information and we will study your candidature', 'masjob') ; ?></p>
                        <strong class="button_link">
                            <a rel="nofollow" href="<?php echo osc_base_url(true) ; ?>?page=contact">
                                <?php _e('Upload your CV now!', 'masjob') ; ?>
                            </a>
                        </strong>
                    </div>
                    <div class="navigation">
                        <?php if( osc_count_list_regions() > 0 ) { ?>  
                            <div class="box location">
                                <h3><?php _e('<strong>Jobs</strong> by region', 'masjob') ; ?></h3>
                                <ul>
                                    <?php while(osc_has_list_regions()) { ?>
                                        <li>
                                            &raquo;
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
                                <h3><?php _e('<strong>Jobs</strong> by area', 'masjob') ; ?></h3>
                                <ul>
                                    <?php while ( osc_has_categories() ) { ?>
                                        <li>
                                            &raquo;
                                            <a href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a>
                                            <em>(<?php echo osc_category_total_items() ; ?>)</em>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
    </body>
</html>