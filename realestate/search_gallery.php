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

    osc_get_premiums();
    if(osc_count_premiums() > 0) {
?>
        <?php while(osc_has_premiums()) { ?>
            <div class="ui-item ui-item-list">
                <div class="frame">
                    <a href="<?php echo osc_item_url() ; ?>"><?php if( osc_images_enabled_at_items() ) { ?>
                        <?php if( osc_count_item_resources() ) { ?>
                            <img src="<?php echo osc_resource_thumbnail_url() ; ?>" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                        <?php } ?>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                    <?php } ?>
                    <div class="type"><?php echo osc_item_category(); ?></div>
                    <?php if( osc_price_enabled_at_items() ) { ?><div class="price"><?php echo osc_item_formated_price() ; ?></div> <?php } ?>
                    </a>
                </div>
                <div class="info">
                    <div>
                        <h3><a href="<?php echo osc_item_url() ; ?>"><?php if(strlen(osc_item_title()) > 31){ echo substr(osc_item_title(), 0, 28).'...'; } else { echo osc_item_title(); } ?></a></h3>
                    </div>
                    <div class="data"><?php item_realestate_attributes(); ?></div>
                    <div class="author">
                        <?php echo osc_format_date(osc_item_pub_date()); ?><br />
                        <?php echo osc_item_city(); ?> (<?php echo osc_item_region();?>)
                    </div>
                </div>
            </div>
        <?php } ?>
<?php } ?>
        <?php while(osc_has_items()) { ?>
            <div class="ui-item ui-item-list">
                <div class="frame">
                    <a href="<?php echo osc_item_url() ; ?>"><?php if( osc_images_enabled_at_items() ) { ?>
                        <?php if( osc_count_item_resources() ) { ?>
                            <img src="<?php echo osc_resource_thumbnail_url() ; ?>" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>"/>
                        <?php } else { ?>
                            <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                        <?php } ?>
                    <?php } else { ?>
                        <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif') ; ?>" alt="" title=""/>
                    <?php } ?>
                    <div class="type"><?php echo osc_item_category(); ?></div>
                    <?php if( osc_price_enabled_at_items() ) { ?><div class="price"><?php echo osc_item_formated_price() ; ?></div> <?php } ?>
                    </a>
                </div>
                <div class="info">
                    <div>
                        <h3><a href="<?php echo osc_item_url() ; ?>"><?php if(strlen(osc_item_title()) > 31){ echo substr(osc_item_title(), 0, 28).'...'; } else { echo osc_item_title(); } ?></a></h3>
                    </div>
                    <div class="data"><?php item_realestate_attributes(); ?></div>
                    <div class="author">
                        <?php echo osc_format_date(osc_item_pub_date()); ?><br />
                        <?php echo osc_item_city(); ?> (<?php echo osc_item_region();?>)
                    </div>
                </div>
            </div>
        <?php } ?>