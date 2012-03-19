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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content page">
                <div id="main">
                    <h1><strong><?php echo osc_static_page_title() ; ?></strong></h1>
                    <div class="text">
                        <?php echo osc_static_page_text() ; ?>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="publish_box companies">
                        <h2><strong><?php _e('Upload your CV and', 'masjob') ; ?>:</strong></h2>
                        <p>
                            <?php _e('We will automatically receive your information and we will study your candidature', 'masjob') ; ?>
                        </p>
                        <strong class="button_link"><a href="<?php echo osc_base_url(true) ; ?>?page=contact"><?php _e('Upload your CV now!', 'masjob') ; ?></a></strong>
                    </div>
                </div>
            </div>
            <?php osc_current_web_theme_path('footer.php') ; ?>
        </div>
        <?php osc_show_flash_message() ; ?>
    </body>
</html>