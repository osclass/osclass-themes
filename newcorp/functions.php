<?php

    /**
     * 
     * @since 2.3
     */ 
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

    /**
     * 
     * @since 2.3
     */ 
    if( !function_exists('newcorp_admin_menu') ) {
        function newcorp_admin_menu() {
            echo '<h3><a href="#">NewCorp</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/newcorp/admin/settings.php') . '">&raquo; '.__('Settings', 'newcorp').'</a></li>
            </ul>';
        }

        osc_add_hook('admin_menu', 'newcorp_admin_menu');
    }

    if( !function_exists('meta_title') ) {
        function meta_title( ) {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    return __('Publish an item','newcorp') . ' - ' . osc_page_title(); break;
                        case 'item_edit':   return __('Edit your item','newcorp') . ' - ' . osc_page_title(); break;
                        case 'send_friend': return __('Send to a friend','newcorp') . ' - ' . osc_item_title() . ' - ' . osc_page_title(); break;
                        case 'contact':     return __('Contact seller','newcorp') . ' - ' . osc_item_title() . ' - ' . osc_page_title(); break;
                        default:            return osc_item_title() . ' - ' . osc_page_title(); break;
                    }
                break;
                case('page'):
                    return osc_static_page_title() . ' - ' . osc_page_title();
                break;
                case('search'):
                    $region   = Params::getParam('sRegion');
                    $city     = Params::getParam('sCity');
                    $pattern  = Params::getParam('sPattern');
                    $category = osc_search_category_id();
                    $category = ((count($category) == 1) ? $category[0] : '');
                    $s_page = '';
                    $i_page = Params::getParam('iPage');

                    if($i_page != '' && $i_page > 0) {
                        $s_page = __('page', 'newcorp') . ' ' . ($i_page + 1) . ' - ';
                    }

                    $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '');
                    $b_category = ($category != '');
                    $b_pattern  = ($pattern != '');
                    $b_city     = ($city != '');
                    $b_region   = ($region != '');

                    if($b_show_all) {
                        return __('Show all items', 'newcorp') . ' - ' . $s_page . osc_page_title();
                    }

                    $result = '';
                    if($b_pattern) {
                        $result .= $pattern . ' &raquo; ';
                    }

                    if($b_category) {
                        $list        = array();
                        $aCategories = Category::newInstance()->toRootTree($category);
                        if(count($aCategories) > 0) {
                            foreach ($aCategories as $single) {
                                $list[] = $single['s_name'];
                            }
                            $result .= implode(' &raquo; ', $list) . ' &raquo; ';
                        }
                    }

                    if($b_city) {
                        $result .= $city . ' &raquo; ';
                    }

                    if($b_region) {
                        $result .= $region . ' &raquo; ';
                    }

                    $result = preg_replace('|\s?&raquo;\s$|', '', $result);

                    if($result == '') {
                        $result = __('Search', 'newcorp');
                    }

                    return $result . ' - ' . $s_page . osc_page_title();
                break;
                case('login'):
                    switch ($section) {
                        case('recover'): return __('Recover your password','newcorp') . ' - ' . osc_page_title();
                        default:         return __('Login','newcorp') . ' - ' . osc_page_title();
                    }
                break;
                case('register'):
                    return __('Create a new account','newcorp') . ' - ' . osc_page_title();
                break;
                case('user'):
                    switch ($section) {
                        case('dashboard'):       return __('Dashboard','newcorp') . ' - ' . osc_page_title(); break;
                        case('items'):           return __('Manage my items','newcorp') . ' - ' . osc_page_title(); break;
                        case('alerts'):          return __('Manage my alerts','newcorp') . ' - ' . osc_page_title(); break;
                        case('profile'):         return __('Update my profile','newcorp') . ' - ' . osc_page_title(); break;
                        case('change_email'):    return __('Change my email','newcorp') . ' - ' . osc_page_title(); break;
                        case('change_password'): return __('Change my password','newcorp') . ' - ' . osc_page_title(); break;
                        case('forgot'):          return __('Recover my password','newcorp') . ' - ' . osc_page_title(); break;
                        default:                 return osc_page_title(); break;
                    }
                break;
                case('contact'):
                    return __('Contact','newcorp') . ' - ' . osc_page_title();
                break;
                default:
                    return osc_page_title();
                break;
            }
         }
     }

    if( !function_exists('meta_description') ) {
        function meta_description( ) {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    return ''; break;
                        case 'item_edit':   return ''; break;
                        case 'send_friend': return ''; break;
                        case 'contact':     return ''; break;
                        default:
                            return osc_item_category() . ', ' . osc_highlight(osc_item_description(), 140) . '..., ' . osc_item_category();
                            break;
                    }
                break;
                case('page'):
                    return osc_highlight(strip_tags(osc_static_page_text()), 140);
                break;
                case('search'):
                    $result = '';

                    if(osc_count_items() == 0) {
                        return '';
                    }

                    if(osc_has_items ()) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category();
                    }

                    osc_reset_items();
                    return $result;
                case(''): // home
                    $result = '';

                    if(osc_count_latest_items() == 0) {
                        return '';
                    }

                    if(osc_has_latest_items()) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category();
                    }

                    osc_reset_items();
                    return $result;
                break;
            }
         }
     }

?>