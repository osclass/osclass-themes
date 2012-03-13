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
     //osc_set_preference('maxLatestItems@home',5,'osclass');
?>
<h1><strong><?php _e('Search results', 'seeker') ; ?></strong></h1>

<div class="ad_list">
<?php if( osc_count_latest_items() == 0) { ?>
    <p class="empty"><?php printf(__('There are no results matching "%s"', 'seeker'), osc_search_pattern()) ; ?></p>
<?php } else { ?>
    <table id="table">
        <thead>
            <tr>
                <th><?php _e('Vacancy', 'seeker') ; ?></th>
                <th><?php _e('Location', 'seeker') ; ?></th>
                <th><?php _e('Date', 'seeker') ; ?></th>
            <tr>
        </thead>
        <tbody>
            <?php $class = "odd" ; ?>
            <?php while ( osc_has_items() ) { ?>
                <?php osc_current_web_theme_path('inc.grid.php') ; ?>
            <?php } ?>
        </tbody>
   </table>
   <div class="paginate" >
        <?php echo osc_search_pagination(); ?>
    </div>
<?php } ?>
</div>