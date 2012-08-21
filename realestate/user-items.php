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
<?php osc_current_web_theme_path('header.php') ; ?>
<div class="content user-area">
    <div id="right-side">
        <h1><?php _e('User account manager', 'realestate') ; ?></h1>
        <h2><?php _e('Your listings', 'realestate'); ?> <a href="<?php echo osc_item_post_url() ; ?>" class="ui-button ui-button-grey ui-button-mini float-right">+ <?php _e('Post a new item', 'realestate'); ?></a></h2>
        <div class="ad_list">
            <?php if(osc_count_items() == 0) { ?>
            <h3><?php _e('No listings have been added yet', 'realestate'); ?></h3>
        <?php } else { ?>
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
                    <div class="data data-full">
                        <?php _e('Publication date', 'realestate') ; ?>: <?php echo osc_format_date(osc_item_pub_date()) ; ?><br />
                        <div>
                        <a href="<?php echo osc_item_url(); ?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('View item', 'realestate'); ?></a>
                        <a href="<?php echo osc_item_edit_url(); ?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('Edit', 'realestate'); ?></a>
                        <a class="ui-button ui-button-red ui-button-mini" onclick="javascript:return confirm('<?php _e('This action can not be undone. Are you sure you want to continue?', 'realestate'); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'realestate'); ?></a>
                        <?php if(osc_item_is_inactive()) {?>
                        <a href="<?php echo osc_item_activate_url();?>" class="ui-button ui-button-grey ui-button-mini"><?php _e('Activate', 'realestate'); ?></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="paginate" >
                <div class="ui-actionbox">
                    <?php for($i = 0 ; $i < osc_list_total_pages() ; $i++) {
                        if($i == osc_list_page()) {
                            printf('<a class="searchPaginationSelected" href="%s">%d</a>', osc_user_list_items_url($i), ($i + 1));
                        } else {
                            printf('<a class="searchPaginationNonSelected" href="%s">%d</a>', osc_user_list_items_url($i), ($i + 1));
                        }
                    } ?>
                </div>
            </div>
        <?php } ?>
        </div>
        
    </div>
    <?php require('user_sidebar.php') ; ?>
    <div class="clear"></div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>