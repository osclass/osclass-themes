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
    <body class="<?php osc_run_hook('body_class'); ?>">
    <div id="container">
    <div id="header">
        <div class="wrapper">
        <a id="logo" href="<?php echo osc_base_url() ; ?>"><strong><?php echo logo_header() ; ?></strong></a>
        <div id="user_menu">
            <strong><?php _e('Send us your CV and:', 'seeker'); ?></strong>
            <?php _e('We will automatically receive your information and we will study your candidature.', 'seeker'); ?>
            <a href="<?php echo osc_contact_url(); ?>" id="upload-button"><?php _e('Upload your CV now!', 'seeker') ; ?></a>
        </div>
        <ul id="nav">
            <li <?php if( !osc_is_static_page() && !osc_is_contact_page() ){ echo 'class="current-menu-item"'; } ?>><a href="<?php echo osc_base_url() ; ?>"><?php _e('Advertises', 'seeker'); ?></a></li>
            <?php while( osc_has_static_pages() ) { ?>
                <li <?php if(is_current_page(osc_static_page_id())){ echo 'class="current-menu-item"'; }?>><a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title(); ?></a></li>
            <?php } ?>
            <?php osc_reset_static_pages() ; ?>
            <li <?php if( osc_is_contact_page() ) { echo 'class="current-menu-item"'; } ?>><a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'seeker') ; ?></a></li>
        </ul>
        </div>
    </div>
    <div class="wrapper">