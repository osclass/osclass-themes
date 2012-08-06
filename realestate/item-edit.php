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
    osc_add_filter('meta_robots','meta_robots_custom');
    function meta_robots_custom(){
        return 'noindex, nofollow';
    }
    function itemCustomHead(){
        echo '<script type="text/javascript" src="'.osc_current_web_theme_js_url('jquery.validate.min.js').'"></script>'; 
        echo '<script type="text/javascript" src="'.osc_current_web_theme_js_url('tabber-minimized.js').'"></script>'; ?>
        <?php ItemForm::location_javascript_new(); ?>
        <?php if(osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
        <?php
    }
    osc_add_hook('header','itemCustomHead');
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<h1><strong><?php _e('Publish an item', 'realestate'); ?></strong></h1>
<div class="publish-left">
<h2><?php _e('General Information', 'realestate'); ?></h2>
<form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="item_edit_post" />
<input type="hidden" name="page" value="item" />
<input type="hidden" name="id" value="<?php echo osc_item_id() ;?>" />
<input type="hidden" name="secret" value="<?php echo osc_item_secret() ;?>" />
<ul id="error_list"></ul>
<div class="content add_item">
    <div class="ui-generic-form ">
        <div class="ui-generic-form-content">
            <?php
            $locales = osc_get_locales();
            $item = osc_item();
            $num_locales = count($locales);
            if($num_locales > 1){
                echo '<div class="row">';
                echo '<label for="switch-language">'.__('Language', 'realestate').'</label>';
                echo '<select name="switch-language">';
                foreach($locales as $locale) {
                    echo '<option value="'.$locale['pk_c_code'].'">'.$locale['s_short_name'].'</option>';
                }
                echo '</select>';
                echo '</div>'; 
            }
            
            
            ?>
            <?php if(!osc_is_web_user_logged_in() ) { ?>
            <strong><?php _e('Publish contact','realestate'); ?></strong>
            <div class="row ui-row-text">
                <label for="contactName"><?php _e('Name', 'realestate'); ?></label>
                <?php ItemForm::contact_name_text() ; ?>
            </div>
            <div class="row ui-row-text">
                <label for="contactEmail"><?php _e('E-mail', 'realestate'); ?> *</label>
                <?php ItemForm::contact_email_text() ; ?>
            </div>
            <div class="actions">
                <?php ItemForm::show_email_checkbox() ; ?>
                <span for="showEmail" class="ui-label-check"><?php _e('Show e-mail on the item page', 'realestate'); ?></span>
            </div>
            <?php }; ?>

            <div class="row">
                <label for="catId"><?php _e('Category', 'realestate'); ?> *</label>
                <?php ItemForm::category_select(null, null, __('Select a category', 'realestate')); ?>
            </div>
            <div class="row ui-row-text">
                <?php
                if($locales==null) { $locales = osc_get_locales(); }
                $value = array();
                foreach($locales as $locale) {
                    $title = (isset($item) && isset($item['locale'][$locale['pk_c_code']]) && isset($item['locale'][$locale['pk_c_code']]['s_title'])) ? $item['locale'][$locale['pk_c_code']]['s_title'] : '' ;
                    if( Session::newInstance()->_getForm('title') != "" ) {
                        $title_ = Session::newInstance()->_getForm('title');
                        if( $title_[$locale['pk_c_code']] != "" ){
                            $title = $title_[$locale['pk_c_code']];
                        }
                    }
                    $value[$locale['pk_c_code']] = $title;
                }
                $fields = array(
                             array('name'=>'title[%locale%]','label'=>__('Title','realestate'),'type'=>'text','args'=>'','required'=>true,'value'=>$value)
                          );
                multilanguage_form($fields); ?>
            </div>
            <div class="row ui-row-text">
                <?php
                if($locales==null) { $locales = osc_get_locales(); }
                $value = array();
                foreach($locales as $locale) {
                    $description = (isset($item) && isset($item['locale'][$locale['pk_c_code']]) && isset($item['locale'][$locale['pk_c_code']]['s_description'])) ? $item['locale'][$locale['pk_c_code']]['s_description'] : '';
                    if( Session::newInstance()->_getForm('description') != "" ) {
                        $description_ = Session::newInstance()->_getForm('description');
                        if( $description_[$locale['pk_c_code']] != "" ){
                            $description = $description_[$locale['pk_c_code']];
                        }
                    }
                    $value[$locale['pk_c_code']] = $description;
                }
                $fields = array(
                            array('name'=>'description[%locale%]','label'=>__('Description','realestate'), 'type'=>'textarea','args'=>'','required'=>true,'value'=>$value)
                          );
                multilanguage_form($fields); ?>
            </div>
            <?php if( osc_price_enabled_at_items() ) { ?>
            <div class="row ui-row-text">
                <label for="price"><?php _e('Price', 'realestate'); ?></label>
                <span class="float-left"><?php ItemForm::price_input_text(); ?></span>
                <?php ItemForm::currency_select(); ?>
            </div>
            <?php } ?>
            <?php if( osc_images_enabled_at_items() ) { ?>
                <div class="row">
                    <label><?php _e('Photos', 'realestate'); ?></label>
                    <?php if(osc_max_images_per_item()==0 || (osc_max_images_per_item()!=0 && osc_count_item_resources()<  osc_max_images_per_item())) { ?>
                    <input type="file" name="photos[]" />
                <?php }; ?>
                </div>
                 <div class="actions">
                    <div id="photos"><?php ItemForm::photos(); ?></div>
                    <a href="#" onclick="addNewPhoto(); return false;"><?php _e('Add new photo', 'realestate'); ?></a>
                </div>
            <?php } ?>
            <div class="publish-hook">
            <?php ItemForm::plugin_edit_item(); ?>
            </div>
            <div class="actions">
                    <?php if( osc_recaptcha_items_enabled() ) {?>
                    <div class="box">
                        <div class="row">
                            <?php osc_show_recaptcha(); ?>
                        </div>
                    </div>
                    <?php }?> 
                <a href="#" class="ui-button ui-button-gray js-submit"><?php _e("Update", 'realestate');?></a>
            </div>
        </div>
    </div>
</div>
</div>
<div id="publish-right" class="publish-right">
<h2><?php _e('Item Location', 'realestate'); ?></h2>
<div class="content add_item">
    <div class="ui-generic-form ">
        <div class="ui-generic-form-content">            
            <div class="row">
                <label for="countryId"><?php _e('Country', 'realestate'); ?></label>
                <?php ItemForm::country_select(osc_get_countries(), osc_user()) ; ?>
            </div>
            <div class="row ui-row-text">
                <label for="regionId"><?php _e('Region', 'realestate'); ?></label>
                <?php ItemForm::region_text(osc_user()) ; ?>
            </div>
            <div class="row ui-row-text">
                <label for="city"><?php _e('City', 'realestate'); ?></label>
                <?php ItemForm::city_text(osc_user()) ; ?>
            </div>
            <div class="row ui-row-text">
                <label for="city"><?php _e('City Area', 'realestate'); ?></label>
                <?php ItemForm::city_area_text(osc_user()) ; ?>
            </div>
            <div class="row ui-row-text">
                <label for="address"><?php _e('Address', 'realestate'); ?></label>
                <?php ItemForm::address_text(osc_user()) ; ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="clear"></div>
<script>
function themeUiHook(){
    $('#plugin-hook select').each(function(){
        if($(this).parents('.tabbertab').length == 0){
            selectUi($(this));
        }
    });
    $('select[name="switch-language"]').trigger('change');
}
</script>
<?php osc_current_web_theme_path('footer.php') ; ?>