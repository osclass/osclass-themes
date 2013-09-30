<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2012 OSCLASS
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

    $address = '';
    if(osc_user_address()!='') {
        if(osc_user_city_area()!='') {
            $address = osc_user_address().", ".osc_user_city_area();
        } else {
            $address = osc_user_address();
        }
    } else {
        $address = osc_user_city_area();
    }
    $location_array = array();
    if(trim(osc_user_city()." ".osc_user_zip())!='') {
        $location_array[] = trim(osc_user_city()." ".osc_user_zip());
    }
    if(osc_user_region()!='') {
        $location_array[] = osc_user_region();
    }
    if(osc_user_country()!='') {
        $location_array[] = osc_user_country();
    }
    $location = implode(", ", $location_array);
    unset($location_array);

    $total_items    = View::newInstance()->_get('list_total_items');
    $items_per_page = View::newInstance()->_get('items_per_page');

    osc_enqueue_script('jquery-validate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php'); ?>
        <meta name="robots" content="noindex, nofollow" />
        <meta name="googlebot" content="noindex, nofollow" />
    </head>
    <body>
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <div class="container search user-public-profile">
            <div class="row">
                <div id="item_head" class="breadcrumb">
                    <h1><?php echo sprintf(__('%s\'s profile', 'modern'), osc_user_name()); ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="span10 columns">
                    <div id="description">
                        <h2><?php _e('Profile', 'twitter'); ?></h2>
                        <ul id="user_data">
                            <li><?php _e('Full name', 'twitter'); ?>: <?php echo osc_user_name(); ?></li>
                            <li><?php _e('Address', 'twitter'); ?>: <?php echo $address; ?></li>
                            <li><?php _e('Location', 'twitter'); ?>: <?php echo $location; ?></li>
                            <li><?php _e('Website', 'twitter'); ?>: <?php echo osc_user_website(); ?></li>
                            <li><?php _e('User Description', 'twitter'); ?>: <?php echo osc_user_info(); ?></li>
                        </ul>
                    </div>


                    <h2><?php _e('Latest listings', 'twitter'); ?></h2>
                    <?php while ( osc_has_items() ) { ?>
                    <div class="line span10 columns">
                        <div class="photo">
                            <?php if( osc_count_item_resources() ) { ?>
                            <a href="<?php echo osc_item_url() ; ?>">
                                <img src="<?php echo osc_resource_thumbnail_url() ; ?>" width="100px" height="75px" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>" />
                            </a>
                            <?php } else { ?>
                            <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                            <?php } ?>
                        </div>
                        <div class="description">
                            <h3><?php if( osc_price_enabled_at_items() ) { ?> <small><strong><?php echo osc_item_formated_price() ; ?></strong></small> &middot; <?php } ?><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title(); ?></a> <span class="label"><a href="<?php echo osc_item_category_url(osc_item_category_id()) ; ?>"><?php echo osc_item_category() ; ?></a></span> <?php if( osc_item_is_premium() ) { ?> <span class="label success"><?php _e('Premium', 'twitter');  ?></span><?php } ?></h3>
                            <p><?php printf(__('<strong>Publish date</strong>: %s', 'twitter'), osc_format_date( osc_item_pub_date() ) ) ; ?></p>
                            <?php
                                $location = array() ;
                                if( osc_item_country() != '' ) {
                                    $location[] = sprintf( __('<strong>Country</strong>: %s', 'twitter'), osc_item_country() ) ;
                                }
                                if( osc_item_region() != '' ) {
                                    $location[] = sprintf( __('<strong>Region</strong>: %s', 'twitter'), osc_item_region() ) ;
                                }
                                if( osc_item_city() != '' ) {
                                    $location[] = sprintf( __('<strong>City</strong>: %s', 'twitter'), osc_item_city() ) ;
                                }
                                if( count($location) > 0) {
                            ?>
                            <p><?php echo implode(' &middot; ', $location) ; ?></p>
                            <?php } ?>
                            <p><?php echo osc_highlight( strip_tags( osc_item_description() ) ) ; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($total_items < $items_per_page) { ?>
                    <div class="span10 columns">
                    <p class="see_more_link"><a href="<?php echo osc_base_url(true).'?page=search&sUser[]='.osc_user_id(); ?>"><strong><?php _e('See all offers', 'twitter'); ?> »</strong></a></p>
                    </div>
                    <?php } ?>
                </div>

                <!-- user contact -->
                <div id="item-contact" class="item-contact span5">
                    <form class="form-stacked" action="<?php echo osc_base_url(true) ; ?>" method="post" name="contact_form" id="contact_form" onsubmit="return doItemContact() ;">
                        <input type="hidden" name="action" value="contact_post" />
                        <input type="hidden" name="page" value="user" />
                        <input type="hidden" name="id" value="<?php echo osc_user_id() ; ?>" />
                        <div class="">
                            <h3><?php _e('Contact publisher', 'twitter') ; ?></h3>
                        </div>
                        <div class="">
                            <?php osc_prepare_user_info() ; ?>
                            <div class="clearfix">
                                <label for="contact-yourName"><?php _e('Your name', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge contact-yourName" id="contact-yourName" name="yourName" type="text" value="<?php echo osc_logged_user_name(); ?>" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="contact-yourEmail"><?php _e('Your e-mail', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge contact-yourEmail" id="contact-yourEmail" name="yourEmail" type="text" value="<?php echo osc_logged_user_email();?>" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="contact-phoneNumber"><?php _e('Phone number', 'twitter') ; ?></label>
                                <div class="input">
                                    <input class="xlarge contact-phoneNumber" id="contact-phoneNumber" name="phoneNumber" type="text" value="" />
                                </div>
                            </div>
                            <div class="clearfix">
                                <label for="contact-message"><?php _e('Message', 'twitter') ; ?></label>
                                <div class="input">
                                    <textarea class="xlarge contact-message" id="contact-message" name="message" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="clearfix">
                                <?php osc_show_recaptcha(); ?>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button class="btn primary" type="submit"><?php _e('Send', 'twitter') ; ?></button>
                        </div>
                    </form>
                </div>
                <!-- user contact end -->

            </div>
        </div>
        <script type="text/javascript">
            var text_error_required = '' ;
            var text_valid_email    = '' ;
        </script>
        <script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('item_contact.js') ; ?>"></script>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>