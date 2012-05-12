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
        <div class="content home">
            <div id="right-side">
                <h1><?php _e('Search results', 'realestate') ; ?></h1>
                <div class="ad_list">
                    <div id="list_head">   
                        <?php _e('Sort by', 'realestate'); ?>:                         
                        <div class="ui-actionbox">
                            <?php $i = 0 ; ?>
                            <?php $orders = osc_list_orders();
                            foreach($orders as $label => $params) {
                                $orderType = ($params['iOrderType'] == 'asc') ? '0' : '1'; ?>
                                <?php if(osc_search_order() == $params['sOrder'] && osc_search_order_type() == $orderType) { ?>
                                    <a class="current" href="<?php echo osc_update_search_url($params) ; ?>"><?php echo $label; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo osc_update_search_url($params) ; ?>"><?php echo $label; ?></a>
                                <?php } ?>
                                <?php $i++ ; ?>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if(osc_count_items() == 0) { ?>
                        <p class="empty" ><?php printf(__('There are no results matching "%s"', 'realestate'), osc_search_pattern()) ; ?></p>
                    <?php } else { ?>
                        <?php require('search_gallery.php') ; ?>
                    <?php } ?>
                            <?php osc_alert_form() ; ?>
                    <?php if(osc_search_pagination() != ''){ ?>
                    <div class="paginate" >
                        <div class="ui-actionbox">
                            <?php echo osc_search_pagination(); ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php require('search_sidebar.php') ; ?>
            <div class="clear"></div>
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
                                "<?php _e('Selected', 'realestate'); ?>: " + ui.item.value + " aka " + ui.item.id :
                                "<?php _e('Nothing selected, input was', 'realestate'); ?> " + this.value );
                        }
                    });
                });
                
                function checkEmptyCategories() {
                    var n = $("input[id*=cat]:checked").length;
                    if(n>0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            </script>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>