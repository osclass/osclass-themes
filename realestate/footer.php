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

    osc_show_widgets('footer');
?>
</div>
<!-- /container -->
<!-- footer -->
<div id="footer">
    <div id="footer-inner">
        <?php echo logo_footer(); ?>
        <ul id="footer-nav">
            <li><a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'realestate') ; ?></a></li>
            <?php osc_reset_static_pages() ;
            $i = 1;
            while( osc_has_static_pages() ) {
                $last = '';
                if($i == osc_count_static_pages()){
                    $last = 'class="last"';
                }
            ?>
                <li <?php echo $last; ?>><a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title() ; ?></a></li>
            <?php
                $i++;
            }
            ?>
        </ul>

        <p><?php _e('This website is proudly using the <a title="Osclass web" href="http://osclass.org/">open source classifieds</a> software <strong>Osclass</strong>', 'realestate') ; ?>.</p>
        <p><a href="http://twitter.com/osclass" target="_blank" class="social-icon-twitter"><span class="icon"></span><?php _e('Follow @Osclass', 'realestate') ; ?></a></p>
    </div>
</div>
<!-- /footer -->
<?php osc_run_hook('footer') ; ?>
    </body>
</html>