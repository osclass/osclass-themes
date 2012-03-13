<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()) ; ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <?php if(osc_count_items() == 0) { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content list">
                <div id="main">
                    <div class="ad_list">
                        <div id="list_head">
                            <div class="inner">
                                <h1>
                                    <strong><?php _e('Search results', 'hierarchy') ; ?></strong>
                                </h1>
                                <p class="see_by">
                                    <?php _e('Sort by', 'hierarchy'); ?>:
                                    <?php $i = 0 ; ?>
                                    <?php $orders = osc_list_orders();
                                    foreach($orders as $label => $params) {
                                        $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                                        <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                                            <a class="current" href="<?php echo osc_update_search_url($params) ; ?>"><?php echo $label; ?></a>
                                        <?php } else { ?>
                                            <a href="<?php echo osc_update_search_url($params) ; ?>"><?php echo $label; ?></a>
                                        <?php } ?>
                                        <?php if ($i != count($orders)-1) { ?>
                                            <span>|</span>
                                        <?php } ?>
                                        <?php $i++ ; ?>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                        <?php if(osc_count_items() == 0) { ?>
                            <p class="empty" ><?php printf(__('There are no results matching "%s"', 'hierarchy'), osc_search_pattern()) ; ?></p>
                        <?php } else { ?>
                            <?php require(osc_search_show_as() == 'list' ? 'search_list.php' : 'search_gallery.php') ; ?>
                        <?php } ?>
                        <div class="paginate" >
                        <?php echo osc_search_pagination(); ?>
                        </div>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="filters">
                    <?php $spubcat = get_categoriesHierarchy(); ?>
                    	<?php if (!isset($spubcat[2]) && !isset($spubcat[1]) && isset($spubcat[0])){ ?>
                    		<h2><strong> <?php _e('<a href="' . $spubcat[0]["url"] . '">' .  $spubcat[0]["s_name"] . '</a> (' . get_category_num_items($spubcat[0]) . ')' , 'hierarchy') ; ?> </strong></h2><?php ;
                    		 echo '<ul>';
                    		 foreach(get_subcategories() as $subcat) {
					
					echo "<li><h3><strong><a href='".$subcat["url"]."'>".$subcat["s_name"]."</a> (" . get_category_num_items($subcat) . ")</strong></h3></li>";
				 }
				 echo '</ul>';
                    		 }  
                    	elseif (!isset($spubcat[2]) && isset($spubcat[1]) && isset($spubcat[0])) { ?>
                    		<h1><strong> <?php _e('<a href="' . $spubcat[1]["url"] . '">' .  $spubcat[1]["s_name"] . '</a> (' . get_category_num_items($spubcat[1]) . ')' , 'hierarchy') ; ?> </strong></h1>
                    		<ul>
                    		<li><h2><strong> <?php _e('<a href="' . $spubcat[0]["url"] . '">' .  $spubcat[0]["s_name"] . '</a> (' . get_category_num_items($spubcat[0]) . ')' , 'hierarchy') ; ?> </strong></h2></li></ul><?php ; 
                    		echo '<ul>';
                    		 foreach(get_subcategories() as $subcat) {
					
					echo "<li class='lastchild'><h4><strong><a href='".$subcat["url"]."'>".$subcat["s_name"]."</a> (" . get_category_num_items($subcat) . ")</strong></h4></li>";
				 }
				 echo '</ul>';
                    		}
                    	else { ?>
                    	<?php if (isset($spubcat[2])){ ?> <h1><strong> <?php _e('<a href="' . $spubcat[2]["url"] . '">' .  $spubcat[2]["s_name"] . '</a> (' . get_category_num_items($spubcat[2]) . ')' , 'hierarchy') ; ?> </strong></h1><?php ; } ?>
                    	<ul>
                    	<?php if (isset($spubcat[1])){ ?> <li><h2><strong> <?php _e('<a href="' . $spubcat[1]["url"] . '">' .  $spubcat[1]["s_name"] . '</a> (' . get_category_num_items($spubcat[1]) . ')' , 'hierarchy') ; ?> </strong></h2></li><?php ; } ?>
                    	<?php if (isset($spubcat[0])){ ?> <li class="lastchild"><h4><strong> <?php _e('<a href="' . $spubcat[0]["url"] . '">' .  $spubcat[0]["s_name"] . '</a> (' . get_category_num_items($spubcat[0]) . ')' , 'hierarchy') ; ?> </strong></h4></li><?php ; } ?>
                        </ul>
                    	<?php } ?>
                        <form action="<?php echo osc_base_url(true); ?>" method="get" onSubmit="return checkEmptyCategories()">
                            <input type="hidden" name="page" value="search" />
                            <fieldset class="box location">
                                <h3><strong><?php _e('Your search', 'hierarchy'); ?></strong></h3>
                                <div class="row one_input">
                                    <input type="text" name="sPattern"  id="query" value="<?php echo osc_search_pattern() ; ?>" />
                                </div>
                                <h3><strong><?php _e('Location', 'hierarchy') ; ?></strong></h3>
                                <div class="row one_input">
                                    <h6><?php _e('City', 'hierarchy'); ?></h6>
                                    <input type="text" id="sCity" name="sCity" value="<?php echo osc_search_city() ; ?>" />
                                </div>
                            </fieldset>

                            <fieldset class="box show_only">
                                <?php if( osc_images_enabled_at_items() ) { ?>
                                <h3><strong><?php _e('Show only', 'hierarchy') ; ?></strong></h3>
                                <div class="row checkboxes">
                                    <ul>
                                        <li>
                                            <input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?> />
                                            <label for="withPicture"><?php _e('Show only items with pictures', 'hierarchy') ; ?></label>
                                        </li>
                                    </ul>
                                </div>
                                <?php } ?>
                                <?php if( osc_price_enabled_at_items() ) { ?>
                                <div class="row two_input">
                                    <h6><?php _e('Price', 'hierarchy') ; ?></h6>
                                    <div><?php _e('Min', 'hierarchy') ; ?>.</div>
                                    <input type="text" id="priceMin" name="sPriceMin" value="<?php echo osc_search_price_min() ; ?>" size="6" maxlength="6" />
                                    <div><?php _e('Max', 'hierarchy') ; ?>.</div>
                                    <input type="text" id="priceMax" name="sPriceMax" value="<?php echo osc_search_price_max() ; ?>" size="6" maxlength="6" />
                                </div>
                                <?php } ?>
                                <?php  osc_get_non_empty_categories(); ?>
                                <?php  if ( osc_count_categories() ) { ?>
                                <div class="row checkboxes">
                                    <h6><?php _e('Category', 'hierarchy') ; ?></h6>
                                    <ul>
                                        <?php // RESET CATEGORIES IF WE USED THEN IN THE HEADER ?>
                                        <?php osc_goto_first_category() ; ?>
                                        <?php while(osc_has_categories()) { ?>
                                        <li>
                                            <input type="checkbox" name="sCategory[]" id="sCategory" value="<?php echo osc_category_id(); ?>" <?php echo ( (in_array(osc_category_id(), osc_search_category())  || in_array(osc_category_slug()."/", osc_search_category()) || count(osc_search_category())==0 )  ? 'checked' : '') ; ?> /> <label for="cat<?php echo osc_category_id(); ?>"><strong><?php echo osc_category_name(); ?></strong></label>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                            </fieldset>
                            <?php
                                if(osc_search_category_id()) {
                                    osc_run_hook('search_form', osc_search_category_id()) ;
                                } else {
                                    osc_run_hook('search_form') ;
                                }
                            ?>
                            <button type="submit"><?php _e('Apply', 'hierarchy') ; ?></button>
                        </form>
                        <?php osc_alert_form() ; ?>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function() {
                        function log( message ) {
                            $( "<div/>" ).text( message ).prependTo( "#log" );
                            $( "#log" ).attr( "scrollTop", 0 );
                        }

                        $( "#sCity" ).autocomplete({
                            source: "<?php echo osc_base_url(true); ?>?page=ajax&action=location",
                            minLength: 2,
                            select: function( event, ui ) {
                                log( ui.item ?
                                    "<?php _e('Selected', 'hierarchy'); ?>: " + ui.item.value + " aka " + ui.item.id :
                                    "<?php _e('Nothing selected, input was', 'hierarchy'); ?> " + this.value );
                            }
                        });
                    });
                    
                    function checkEmptyCategories() {
                        var n = $("#sCategory:checked").length;
                        if(n>0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer'); ?>
    </body>
</html>
