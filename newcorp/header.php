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

<div id="header">
    <a id="logo" href="<?php echo osc_base_url() ; ?>">
        <strong><?php echo osc_page_title() ; ?></strong>
    </a>
    <ul id="main_menu">
        <li><a href="<?php echo osc_base_url() ; ?>"><?php _e('Home', 'newcorp') ; ?></a></li>
        <?php osc_reset_static_pages() ; ?>
        <?php while( osc_has_static_pages() ) { ?>
            <li><a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title() ; ?></a></li>
        <?php } ?>
    </ul>
    <div id="user_menu">
        <?php if ( osc_count_web_enabled_locales() > 1 ) { ?>
                <?php osc_goto_first_locale() ; ?>
                <ul>
                    <li class="last with_sub">
                        <strong><?php _e('Language', 'newcorp'); ?> (<?php echo osc_locale_name() ; ?>)</strong>
                        <ul>
                            <?php $i = 0 ;  ?>
                            <?php while ( osc_has_web_enabled_locales() ) { ?>
                                <li <?php if($i == 0) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_name() ; ?></a></li>
                                <?php $i++ ;
                            } ?>
                        </ul>
                    </li>
                </ul>
        <?php } ?>
    </div>
</div>
<?php osc_show_widgets('header') ; ?>