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
<tr class="<?php echo $class; ?>">
<td class="title">
<strong><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></strong>
</td>
<td class="location">
<strong><?php echo osc_item_city() ; ?></strong>
</td>
<td class="date"><?php echo osc_format_date(osc_item_pub_date() ) ; ?></td>
</tr>
<tr class="<?php echo $class; ?> description">
<td colspan="3"><?php echo strip_tags(osc_highlight( osc_item_description(), 250)) ; ?></td>
</tr>
<?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>