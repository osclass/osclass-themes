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
    <a id="logo" href="<?php echo osc_base_url() ; ?>"><?php echo osc_page_title() ; ?></a>
    <div id="power_main">
        <ul id="main_menu">
            <li class="home_link"><a href="<?php echo osc_base_url() ; ?>"><?php _e('Home', 'masjob') ; ?></a></li>
            <?php while( osc_has_static_pages() ) { ?>
                <li><a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title() ; ?></a></li>
            <?php } ?>
            <?php osc_reset_static_pages() ; ?>
            <li><a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'masjob') ; ?></a></li>
        </ul>
    </div>
    <?php if ( osc_count_web_enabled_locales() > 1 ) { ?>
    <div id="user_menu">
        <ul>
            <li class="last with_sub">
                <?php osc_get_current_user_locale() ; ?>
                <strong><?php _e('Language', 'masjob') ; ?> (<?php echo osc_locale_name() ; ?>)</strong>
                <?php osc_goto_first_locale() ; ?>
                <ul>
                    <?php $i = 0 ;  ?>
                    <?php while ( osc_has_web_enabled_locales() ) { ?>
                        <li <?php if($i == 0) { echo "class='first'"; } ?>><a id="<?php echo osc_locale_code() ; ?>" href="<?php echo osc_change_language_url ( osc_locale_code() ) ; ?>"><?php echo osc_locale_name() ; ?></a></li>
                        <?php $i++ ;
                    } ?>
                </ul>
            </li>
        </ul>
    </div>
    <?php } ?>
</div>
<?php osc_show_widgets('header') ; ?>