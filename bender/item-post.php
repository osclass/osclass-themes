<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2013 OSCLASS
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

    // meta tag robots
    osc_add_hook('header','bender_nofollow_construct');

    osc_enqueue_script('jquery-validate');
    bender_add_boddy_class('item item-post');
    $action = 'item_add_post';
    $edit = false;
    if(Params::getParam('action') == 'item_edit'){
        $action = 'item_edit_post';
        $edit = true;
    }
    ?>
<?php osc_current_web_theme_path('header.php') ; ?>
<?php ItemForm::location_javascript_new(); ?>
<?php if(osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
    <div class="form-container form-horizontal">
        <div class="resp-wrapper">
            <div class="header">
                <h1><?php _e('Publish a listing', 'bender'); ?></h1>
            </div>
            <ul id="error_list"></ul>
                <form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data" id="item-post">
                    <fieldset>
                    <input type="hidden" name="action" value="<?php echo $action; ?>" />
                    <input type="hidden" name="page" value="item" />
                    <?php if($edit){ ?>
                        <input type="hidden" name="id" value="<?php echo osc_item_id();?>" />
                        <input type="hidden" name="secret" value="<?php echo osc_item_secret();?>" />
                    <?php } ?>
                        <h2><?php _e('General Information', 'bender'); ?></h2>
                        <div class="control-group">
                          <label class="control-label" for="select_1"><?php _e('Category', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::category_select(null, null, __('Select a category', 'bender')); ?>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="title[<?php echo osc_locale_code(); ?>]"><?php _e('Title', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::title_input('title',osc_locale_code(), osc_esc_html( bender_item_title() )); ?>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="description[<?php echo osc_locale_code(); ?>]"><?php _e('Description', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::description_textarea('description',osc_locale_code(), osc_esc_html( bender_item_description() )); ?>
                          </div>
                        </div>

                        <?php if( osc_price_enabled_at_items() ) { ?>
                        <div class="control-group">
                          <label class="control-label" for="price"><?php _e('Price', 'bender'); ?></label>
                          <div class="controls">
                            <?php ItemForm::price_input_text(); ?>
                            <?php ItemForm::currency_select(); ?>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if( osc_images_enabled_at_items() ) { ?>
                        <div class="box photos">
                            <h2><?php _e('Photos', 'bender'); ?></h2>

                            <div class="control-group">
                              <label class="control-label" for="photos[]"><?php _e('Photos', 'bender'); ?></label>
                              <div class="controls">
                                <div id="photos">
                                    <?php ItemForm::photos(); ?>
                                </div>
                              </div>
                              <div class="controls">
                                <a href="#" onclick="addNewPhoto(); return false;"><?php _e('Add new photo', 'bender'); ?></a>
                              </div>
                            </div>

                        </div>
                        <?php } ?>
                        <div class="box location">
                            <h2><?php _e('Listing Location', 'bender'); ?></h2>

                            <div class="control-group">
                              <label class="control-label" for="country"><?php _e('Country', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="region"><?php _e('Region', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::region_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="city"><?php _e('City', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::city_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="cityArea"><?php _e('City Area', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::city_area_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="address"><?php _e('Address', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::address_text(osc_user()); ?>
                              </div>
                            </div>
                        </div>
                        <!-- seller info -->
                        <?php if(!osc_is_web_user_logged_in() ) { ?>
                        <div class="box seller_info">
                            <h2><?php _e("Seller's information", 'bender'); ?></h2>
                            <div class="control-group">
                              <label class="control-label" for="contactName"><?php _e('Name', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::contact_name_text(); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="contactEmail"><?php _e('E-mail', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::contact_email_text(); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <div class="controls checkbox">
                                <?php ItemForm::show_email_checkbox(); ?> <label for="showEmail"><?php _e('Show e-mail on the listing page', 'bender'); ?></label>
                              </div>
                            </div>
                        </div>
                        <?php 
                        }; 
                        if($edit) {
                          ItemForm::plugin_edit_item(); 
                        } else {
                          ItemForm::plugin_post_item(); 
                        } ?>
                            <div class="control-group">
                            <?php if( osc_recaptcha_items_enabled() ) {?>
                                <div class="controls">
                                    <?php osc_show_recaptcha(); ?>
                                </div>
                                <?php }?>
                                <div class="controls">
                                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php if($edit) { _e("Update", 'bender'); } else { _e("Publish", 'bender'); } ?></button>
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <script type="text/javascript">
    <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
    $().ready(function(){
        $("#price").blur(function(event) {
            var price = $("#price").prop("value");
            <?php if(osc_locale_thousands_sep()!='') { ?>
            while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
                price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
            }
            <?php }; ?>
            <?php if(osc_locale_dec_point()!='') { ?>
            var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
            if(tmp.length>2) {
                price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
            }
            <?php }; ?>
            $("#price").prop("value", price);
        });
    });
    <?php }; ?>
</script>
<?php osc_current_web_theme_path('footer.php'); ?>