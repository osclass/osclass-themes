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

    define('ITALIA_THEME_VERSION', '1.0.2');

    if( !OC_ADMIN ) {
        if( !function_exists('add_close_button_action') ) {
            function add_close_button_action(){
                echo '<script type="text/javascript">';
                    echo '$(".flashmessage .ico-close").click(function(){';
                        echo '$(this).parent().hide();';
                    echo '});';
                echo '</script>';
            }
            osc_add_hook('footer', 'add_close_button_action') ;
        }
    }
    function theme_italia_admin_regions_message(){
        $regions = json_decode(osc_get_preference('region_maps','italia_theme'),true);
        if(count($regions) < 20){
            echo '</div><div class="flashmessage flashmessage-error" style="display:block">'.sprintf(__('Wait! There are unassigned map areas in the map. <a href="%s">Click here</a> to assign regions to the map.','italia'),osc_admin_render_theme_url('oc-content/themes/italia/admin/map_settings.php')).'<a class="btn ico btn-mini ico-close">x</a>';
        }
    }
    osc_add_hook('admin_page_header', 'theme_italia_admin_regions_message',10) ;
    function theme_italia_regions_map_admin() {
        $regions = json_decode(osc_get_preference('region_maps','italia_theme'),true);
        switch( Params::getParam('action_specific') ) {
            case('edit_region_map'):
                $regions[Params::getParam('target-id')] = Params::getParam('region');
                osc_set_preference('region_maps', json_encode($regions), 'italia_theme');
                osc_add_flash_ok_message(__('Region saved correctly', 'italia'), 'admin');
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/italia/admin/map_settings.php')); exit;
            break;
        }
    }

    function map_region_url($region_id) {
        $regionData = Region::newInstance()->findByPrimaryKey($region_id);
        if ( osc_rewrite_enabled() ) {
            $url = osc_base_url();
            if( osc_get_preference('seo_url_search_prefix') != '' ) {
                $url .= osc_get_preference('seo_url_search_prefix') . '/';
            }
            $url .= osc_sanitizeString($regionData['s_name']) . '-r' . $regionData['pk_i_id'];
            return $url;
        } else {
            return osc_search_url( array( 'sRegion' => $regionData['s_name']) );
        }
    }

    function theme_italia_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/italia/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'italia_theme');
                osc_reset_preferences();
            }
        }

        switch( Params::getParam('action_specific') ) {
            case('settings'):
                $footerLink = Params::getParam('footer_link');
                osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'italia_theme');
                osc_set_preference('footer_link', ($footerLink ? '1' : '0'), 'italia_theme');

                osc_add_flash_ok_message(__('Theme settings updated correctly', 'italia'), 'admin');
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/italia/admin/settings.php')); exit;
            break;
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'italia'), 'admin');
                    } else {
                        osc_add_flash_error_message(__("An error has occurred, please try again", 'italia'), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'italia'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/italia/admin/header.php')); exit;
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message(__('The logo image has been removed', 'italia'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'italia'), 'admin');
                }
                header('Location: ' . osc_admin_render_theme_url('oc-content/themes/italia/admin/header.php')); exit;
            break;
        }
    }
    osc_add_hook('init_admin', 'theme_italia_actions_admin');
    osc_add_hook('init_admin', 'theme_italia_regions_map_admin');
    if(function_exists('osc_admin_menu_appearance')){
        osc_admin_menu_appearance(__('Header logo', 'italia'), osc_admin_render_theme_url('oc-content/themes/italia/admin/header.php'), 'header_italia');
        osc_admin_menu_appearance(__('Theme settings', 'italia'), osc_admin_render_theme_url('oc-content/themes/italia/admin/settings.php'), 'settings_italia');
        osc_admin_menu_appearance(__('Map settings', 'italia'), osc_admin_render_theme_url('oc-content/themes/italia/admin/map_settings.php'), 'map_settings_italia');
    } else {
        function italia_admin_menu() {
            echo '<h3><a href="#">'. __('Italia theme','italia') .'</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/italia/admin/header.php') . '">&raquo; '.__('Header logo', 'italia').'</a></li>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/italia/admin/settings.php') . '">&raquo; '.__('Theme settings', 'italia').'</a></li>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/italia/admin/map_settings.php') . '">&raquo; '.__('Map settings', 'italia').'</a></li>

            </ul>';
        }
        osc_add_hook('admin_menu', 'italia_admin_menu');
    }

    if( !function_exists('logo_header') ) {
        function logo_header() {
            $html = '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" />';
            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                return $html;
            } else {
                return osc_page_title();
            }
        }
    }

    // install update options
    if( !function_exists('italia_theme_install') ) {
        function italia_theme_install() {
            osc_set_preference('keyword_placeholder', __('ie. PHP Programmer', 'italia'), 'italia_theme');
            osc_set_preference('version', ITALIA_THEME_VERSION, 'italia_theme');
            osc_set_preference('footer_link', true, 'italia_theme');
            osc_set_preference('donation', '0', 'italia_theme');
        }
    }

    if(!function_exists('check_install_italia_theme')) {
        function check_install_italia_theme() {
            $current_version = osc_get_preference('version', 'italia_theme');
            //check if current version is installed or need an update<
            if( !$current_version ) {
                italia_theme_install();
            }
        }
    }
    check_install_italia_theme();

?>