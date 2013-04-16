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

    moder2_add_boddy_class('search');
    $listClass = '';
    $buttonClass = '';
    if(osc_search_show_as() == 'gallery'){
          $listClass = 'listing-grid';
          $buttonClass = 'active';
    }
    osc_add_hook('before-main','sidebar');
    function sidebar(){
        osc_current_web_theme_path('search-sidebar.php');
    }
?>
<?php osc_current_web_theme_path('header.php') ; ?>
     <div class="list-header">
        <div class="resp-wrapper">
            <?php osc_run_hook('search_ads_listing_top'); ?>
            <h1><?php echo search_title(); ?></h1>
            <?php if(osc_count_items() == 0) { ?>
                <p class="empty" ><?php printf(__('There are no results matching "%s"', 'bender'), osc_search_pattern()) ; ?></p>
            <?php } else { ?>
            <?php
                $search_number = bender_search_number();
                printf('%1$d - %2$d of %3$d ads', $search_number['from'], $search_number['to'], $search_number['of']);
            ?>
            <div class="actions">
              <a href="#" data-bclass-toggle="display-filters" class="resp-toogle show-filters-btn"><?php _e('Show filters','bender'); ?></a>
              <span class="doublebutton <?php echo $buttonClass; ?>">
                   <a href="<?php echo osc_update_search_url(array('sShowAs'=> 'list')); ?>" class="list-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span><?php _e('List','bender'); ?></span></a>
                   <a href="<?php echo osc_update_search_url(array('sShowAs'=> 'gallery')); ?>" class="grid-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span><?php _e('Grid','bender'); ?></span></a>
              </span>
            </div>
          </div>
     </div>
     <ul class="listing-card-list <?php echo $listClass; ?>" id="listing-card-list">
          <?php
          $i = 0;
          while(osc_has_items()) { $i++; ?>
                 <?php
                 $class = false;
                 if($i%4 == 0){
                    $class = 'last';
                 }
                 bender_draw_item($class); ?>
          <?php } ?>
     </ul>
      <?php
      if(osc_rewrite_enabled()){
      $footerLinks = osc_search_footer_links(); ?>
      <ul class="footer-links">
        <?php foreach($footerLinks as $f) { View::newInstance()->_exportVariableToView('footer_link', $f); ?>
        <?php if($f['total'] < 3) continue; ?>
          <li><a href="<?php echo osc_footer_link_url(); ?>"><?php echo osc_footer_link_title(); ?></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
     <div class="paginate" >
          <?php echo osc_search_pagination(); ?>
     </div>
     <?php } ?>
<?php osc_current_web_theme_path('footer.php') ; ?>