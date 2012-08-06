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
        <div id="main">
            <div id="home-search">
                <form action="<?php echo osc_base_url(true) ; ?>" method="get" class="search" onsubmit="javascript:return doSearch();">
                    <input type="hidden" name="page" value="search" />
                    <h2><?php _e("Find a place, <span>find a home</span>", 'realestate');?></h2>
                    <div class="has-placeholder"><span id="search-placeholder"><?php echo osc_get_preference('keyword_placeholder','realestate') ; ?></span><input type="text" name="sPattern" id="query" class="input-text js-input-home" value="" /><a href="#" class="ui-button ui-button-big js-submit"><?php _e("Search", 'realestate');?></a><div id="message-seach"></div></div>
                </form>
                <div class="categories">
                    <?php osc_goto_first_category() ; ?>
                    <?php while ( osc_has_categories() ) { ?>
                            <h2><a class="<?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a></h2>
                    <?php } ?>
                    <div class="clear"></div>
               </div>
            </div>
           <div id="premium-stage">
                <?php if( osc_count_latest_items() == 0) { ?>
                    <p class="empty"><?php _e('No Latest Items', 'realestate') ; ?></p>
                <?php } else {
                    $index = 0;
                ?>
                    <?php while ( osc_has_latest_items() ) {
                        ?>
                        <div class="ui-item">
                            <div class="frame">
                                <a href="<?php echo osc_item_url() ; ?>"><?php if( osc_images_enabled_at_items() ) { ?>
                                    <?php if( osc_count_item_resources() ) { ?>
                                        <img src="<?php echo osc_resource_preview_url() ; ?>" title="<?php echo osc_item_title(); ?>" alt="<?php echo osc_item_title(); ?>"/>
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
                                    <h3><a href="<?php echo osc_item_url() ; ?>"><?php if(strlen(osc_item_title()) > 70){ echo substr(osc_item_title(), 0, 70).'...'; } else { echo osc_item_title(); } ?></a></h3>
                                </div>
                                <div class="data"><?php item_realestate_attributes(); ?></div>
                                <div class="author">
                                    <?php echo osc_format_date(osc_item_pub_date()); ?><br />
                                    <?php echo osc_item_city(); ?> (<?php echo osc_item_region();?>)
                                </div>
                            </div>
                        </div>
                    <?php
                            $index++;
                            if($index == 4){
                                break; 
                            }
                        }
                    ?>
                <div class="clear"></div>
                <?php View::newInstance()->_erase('items') ;
                } ?>
                <script type="text/javascript">
                /* <![CDATA[ */
                var slides = $("#premium-stage .ui-item:not(:last)").hide();
                if(slides.length >= 1){
                     slider = setInterval('showNext()',5000);
                }
                function showNext(){
                    $("#premium-stage .ui-item:last").prev().fadeIn(500);
                    $("#premium-stage .ui-item:last").fadeOut(500,function(){
                        $(this).remove().prependTo('#premium-stage');
                    });
                    
                }
                function showSlide(el){
                     clearInterval(slider);
                     if('#'+$("#slider-stage .slider:last").attr('id') != el){
                          $(el).remove().insertBefore("#slider-stage .slider:last");
                          showNext();    
                     }
                }
                /* ]]> */
                </script>
            </div>
        </div>
        <div class="content home">
            <h2><?php _e('Latest Items', 'realestate') ; ?></h2>
            <div id="latest-ads">               
                <?php if( osc_count_latest_items() == 0) { ?>
                    <p class="empty"><?php _e('No Latest Items', 'realestate') ; ?></p>
                <?php } else { ?>
                    <?php while ( osc_has_latest_items() ) { ?>
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
                <div class="clear"></div>
                <?php View::newInstance()->_erase('items') ;
                } ?>
            </div>
            <?php if( osc_count_latest_items() == osc_max_latest_items() ) { ?>
                <div class="pagination-box">
                    <a href="<?php echo osc_search_show_all_url();?>" class="ui-button ui-button-grey"><?php _e("See all offers", 'realestate'); ?> &raquo;</a></p>
                </div>
            <?php } ?>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
