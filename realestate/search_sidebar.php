<div id="sidebar">
    <div class="filters">
        <form action="<?php echo osc_base_url(true); ?>" method="get" onSubmit="return doSearch()">
            <input type="hidden" name="page" value="search" />
            <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
            <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting() ; echo $allowedTypesForSorting[osc_search_order_type()]; ?>" />
            <?php foreach(osc_search_user() as $userId) { ?>
            <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>"/>
            <?php } ?>
            <fieldset class="box location">
                <label><?php _e('Your search', 'realestate'); ?></label>
                <div class="row one_input">
                    <div class="has-placeholder"><span id="search-placeholder"><?php echo osc_get_preference('keyword_placeholder','realestate') ; ?></span><input type="text" name="sPattern" id="query"  class="ui-input-text" value="<?php echo Params::getParam('sPattern'); ?>" /></div>
                </div>
                <div id="message-seach"></div>
                <label><?php _e('City', 'realestate'); ?></label>
                <input type="text" id="sCity" name="sCity" value="<?php echo osc_search_city() ; ?>" class="ui-input-text"/>
            </fieldset>

            <fieldset class="box show_only">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <div class="label"><input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?> /><?php _e('Only items with pictures', 'realestate') ; ?></div>
                <?php } ?>
                <?php if( osc_price_enabled_at_items() ) { ?>
                <label> Price
                <div class="ui-slider-box" >
                    <div id="price-range"></div>
                    <input type="text" id="priceMin" name="sPriceMin" value="<?php echo osc_search_price_min() ; ?>" size="6" maxlength="6" class="min" />
                    <input type="text" id="priceMax" name="sPriceMax" value="<?php echo osc_search_price_max() ; ?>" size="6" maxlength="6" class="max"/>
                </div>
                </label>
                <?php } ?>
            </fieldset>
            <fieldset class="box show_only">
                <?php  osc_get_non_empty_categories(); ?>
                <?php  if ( osc_count_categories() ) { ?>
                <label><?php _e('Category', 'realestate') ; ?></label>
                <ul>
                    <?php // RESET CATEGORIES IF WE USED THEN IN THE HEADER ?>
                    <?php osc_goto_first_category() ; ?>
                    <?php while(osc_has_categories()) { ?>
                        <li>
                            <input class="parent" type="checkbox" id="cat<?php echo osc_category_id(); ?>" name="sCategory[]" value="<?php echo osc_category_id(); ?>" <?php $parentSelected=false; if (in_array(osc_category_id(), osc_search_category()) || in_array(osc_category_slug()."/", osc_search_category()) || in_array(osc_category_slug(), osc_search_category()) || count(osc_search_category())==0 ){ echo 'checked'; $parentSelected=true;} ?> />
                            <label for="cat<?php echo osc_category_id(); ?>"><?php echo osc_category_name(); ?></label>
                            <?php if(osc_count_subcategories() > 0) { ?>
                            <ul>
                                <?php while(osc_has_subcategories()) { ?>
                                <li>
                                <input type="checkbox" id="cat<?php echo osc_category_id(); ?>" name="sCategory[]" value="<?php echo osc_category_id(); ?>"  <?php if( $parentSelected || in_array(osc_category_id(), osc_search_category()) || in_array(osc_category_slug()."/", osc_search_category()) || in_array(osc_category_slug(), osc_search_category()) || count(osc_search_category())==0 ){echo 'checked';} ?>/>
                                <label for="cat<?php echo osc_category_id(); ?>"><?php echo osc_category_name(); ?></label>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </fieldset>
            <div class="form-hook">
            <?php
                if(osc_search_category_id()) {
                    osc_run_hook('search_form', osc_search_category_id()) ;
                } else {
                    osc_run_hook('search_form') ;
                }
            ?>
            </div>
            <div class="submit-box">
            <button type="submit" class="ui-button-submit"><?php _e('Apply filters', 'realestate') ; ?></button>
            </div>
        </form>
    </div>
</div>
