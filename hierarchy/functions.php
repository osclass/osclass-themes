<?php

    if( !function_exists('add_logo_header') ) {
        function add_logo_header() {
            $html = '<img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '">';
            $js = " <script>
                        $(document).ready(function () {
                            $('#logo').html('" . $html . "');
                        });
                    </script>";

            if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                echo $js ;
            }
        }

        osc_add_hook("header", "add_logo_header") ;
    }

    if( !function_exists('get_categoriesHierarchy') ) {
        function get_categoriesHierarchy( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;
            
            if ( $location != 'search' ) {
                return false ;
            }
            
            $category_id = osc_search_category_id() ;
            
            if(count($category_id) > 1) {
                return false;
            }
            
            $category_id = (int) $category_id[0] ;
            
            $categoriesHierarchy = Category::newInstance()->hierarchy($category_id) ;
            
            foreach($categoriesHierarchy as &$category) {
                $category['url'] = get_category_url($category) ;
            }
            
            return $categoriesHierarchy ;
         }
     }
     
     if( !function_exists('get_subcategories') ) {
         function get_subcategories( ) {
             $location = Rewrite::newInstance()->get_location() ;
             $section  = Rewrite::newInstance()->get_section() ;
            
             if ( $location != 'search' ) {
                 return false ;
             }
            
             $category_id = osc_search_category_id() ;
            
             if(count($category_id) > 1) {
                 return false ;
             }
            
             $category_id = (int) $category_id[0] ;
            
             $subCategories = Category::newInstance()->findSubcategories($category_id) ;
            
             foreach($subCategories as &$category) {
                 $category['url'] = get_category_url($category) ;
             }
            
             return $subCategories ;
         }
     }

     if ( !function_exists('get_category_url') ) {
         function get_category_url( $category ) {
             $path = '';
             if ( osc_rewrite_enabled() ) {
                if ($category != '') {
                    $category = Category::newInstance()->hierarchy($category['pk_i_id']) ;
                    $sanitized_category = "" ;
                    for ($i = count($category); $i > 0; $i--) {
                        $sanitized_category .= $category[$i - 1]['s_slug'] . '/' ;
                    }
                    $path = osc_base_url() . $sanitized_category ;
                }
            } else {
                $path = sprintf( osc_base_url(true) . '?page=search&sCategory=%d', $category['pk_i_id'] ) ;
            }
            
            return $path;
         }
     }
     
     if ( !function_exists('get_category_num_items') ) {
         function get_category_num_items( $category ) {
            $category_stats = CategoryStats::newInstance()->countItemsFromCategory($category['pk_i_id']) ;
            
            if( empty($category_stats) ) {
                return 0 ;
            }
            
            return $category_stats;
         }
     }
     
    if ( !function_exists('hierarchy_admin_menu') ) {
        function hierarchy_admin_menu() {
            echo '<h3><a href="#">' . __('Hierarchy theme','hierarchy') . '</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/hierarchy/admin/admin_settings.php') . '">&raquo; ' . __('Settings theme', 'hierarchy') . '</a></li>
            </ul>';
        }

        osc_add_hook('admin_menu', 'hierarchy_admin_menu');
    }

    if( !function_exists('meta_title') ) {
        function meta_title( ) {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = __('Publish an item', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case 'item_edit':   $text = __('Edit your item', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case 'send_friend': $text = __('Send to a friend', 'hierarchy') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        case 'contact':     $text = __('Contact seller', 'hierarchy') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        default:            $text = osc_item_title() . ' - ' . osc_page_title() ; break ;
                    }
                break;
                case('page'):
                    $text = osc_static_page_title() . ' - ' . osc_page_title() ;
                break;
                case('search'):
                    $region   = Params::getParam('sRegion') ;
                    $city     = Params::getParam('sCity') ;
                    $pattern  = Params::getParam('sPattern') ;
                    $category = osc_search_category_id() ;
                    $category = ((count($category) == 1) ? $category[0] : '') ;
                    $s_page = '' ;
                    $i_page = Params::getParam('iPage') ;

                    if($i_page != '' && $i_page > 0) {
                        $s_page = __('page', 'hierarchy') . ' ' . ($i_page + 1) . ' - ' ;
                    }

                    $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '') ;
                    $b_category = ($category != '') ;
                    $b_pattern  = ($pattern != '') ;
                    $b_city     = ($city != '') ;
                    $b_region   = ($region != '') ;

                    if($b_show_all) {
                        $text = __('Show all items', 'hierarchy') . ' - ' . $s_page . osc_page_title() ;
                    }

                    $result = '' ;
                    if($b_pattern) {
                        $result .= $pattern . ' &raquo; ' ;
                    }

                    if($b_category) {
                        $list        = array() ;
                        $aCategories = Category::newInstance()->toRootTree($category) ;
                        if(count($aCategories) > 0) {
                            foreach ($aCategories as $single) {
                                $list[] = $single['s_name'] ;
                            }
                            $result .= implode(' &raquo; ', $list) . ' &raquo; ' ;
                        }
                    }

                    if($b_city) {
                        $result .= $city . ' &raquo; ' ;
                    }

                    if($b_region) {
                        $result .= $region . ' &raquo; ' ;
                    }

                    $result = preg_replace('|\s?&raquo;\s$|', '', $result) ;

                    if($result == '') {
                        $result = __('Search', 'hierarchy') ;
                    }

                    $text = $result . ' - ' . $s_page . osc_page_title() ;
                break;
                case('login'):
                    switch ($section) {
                        case('recover'): $text = __('Recover your password', 'hierarchy') . ' - ' . osc_page_title() ;
                        default:         $text = __('Login', 'hierarchy') . ' - ' . osc_page_title() ;
                    }
                break;
                case('register'):
                    $text = __('Create a new account', 'hierarchy') . ' - ' . osc_page_title() ;
                break;
                case('user'):
                    switch ($section) {
                        case('dashboard'):       $text = __('Dashboard', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('items'):           $text = __('Manage my items', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('alerts'):          $text = __('Manage my alerts', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('profile'):         $text = __('Update my profile', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('change_email'):    $text = __('Change my email', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('change_password'): $text = __('Change my password', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        case('forgot'):          $text = __('Recover my password', 'hierarchy') . ' - ' . osc_page_title() ; break ;
                        default:                 $text = osc_page_title() ; break ;
                    }
                break;
                case('contact'):
                    $text = __('Contact','hierarchy') . ' - ' . osc_page_title() ;
                break;
                default:
                    $text = osc_page_title() ;
                break;
            }
            
            $text = str_replace('"', "'", $text) ;
            return ($text) ;
         }
     }

     if( !function_exists('meta_description') ) {
         function meta_description( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;
            $text = '' ;

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = '' ; break ;
                        case 'item_edit':   $text = '' ; break ;
                        case 'send_friend': $text = '' ; break ;
                        case 'contact':     $text = '' ; break ;
                        default:
                            $text = osc_item_category() . ', ' . osc_highlight(osc_item_description(), 140) . '..., ' . osc_item_category() ;
                            break;
                    }
                break;
                case('page'):
                    $text = osc_highlight(strip_tags(osc_static_page_text()), 140) ;
                break;
                case('search'):
                    $result = '' ;

                    if(osc_count_items() == 0) {
                        $text = '' ;
                    }

                    if(osc_has_items ()) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                    }

                    osc_reset_items() ;
                    $text = $result ;
                break;
                case(''): // home
                    $result = '';

                    if(osc_count_latest_items() == 0) {
                        $text = '' ;
                    }

                    if(osc_has_latest_items()) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                    }

                    osc_reset_items() ;
                    $text = $result ;
                break ;
            }
            
            $text = str_replace('"', "'", $text) ;
            return ($text) ;
        }
    }

?>