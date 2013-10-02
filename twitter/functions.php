<?php

    function chosen_select_standard() {
        View::newInstance()->_exportVariableToView('categories', Category::newInstance()->toTree() ) ;

        if( osc_count_categories() > 0 ) {
            echo '<select name="sCategory" data-placeholder="' . __('Select a category...', 'twitter') . '" style="width: auto;" class="chosen-select">' ;
            echo '<option></option>' ;
            while( osc_has_categories() ) {
                echo '<option value="' . osc_category_id() . '">' . osc_category_name() . '</option>' ;
                if( osc_count_subcategories() > 0 ) {
                    while( osc_has_subcategories() ) {
                        echo '<option class="level-1" value="' . osc_category_name() . '">' . osc_category_name() . '</option>' ;
                    }
                }
            }
            echo '</select>' ;
        }

        View::newInstance()->_erase('categories') ;
    }

    function chosen_select_optgroup() {
        View::newInstance()->_exportVariableToView('categories', Category::newInstance()->toTree() ) ;

        if( osc_count_categories() > 0 ) {
            echo '<select name="sCategory" data-placeholder="' . __('Select a category...', 'twitter') . '" style="width: auto;" class="chosen-select">' ;
            echo '<option></option>' ;
            while( osc_has_categories() ) {
                echo '<optgroup label="' . osc_category_name() . '">' ;
                if( osc_count_subcategories() > 0 ) {
                    while( osc_has_subcategories() ) {
                        echo '<option value="' . osc_category_id() . '">' . osc_category_name() . '</option>' ;
                    }
                }
                echo '</optgroup>' ;
            }
            echo '</select>' ;
        }

        View::newInstance()->_erase('categories') ;
    }

    function chosen_region_select() {
        View::newInstance()->_exportVariableToView('list_regions', Search::newInstance()->listRegions('%%%%', '>=', 'region_name ASC') ) ;

        if( osc_count_list_regions() > 0 ) {
            echo '<select name="sRegion" data-placeholder="' . __('Select a region...', 'twitter') . '" style="width: 200px;" class="chosen-select">' ;
            echo '<option></option>' ;
            while( osc_has_list_regions() ) {
                echo '<option value="' . osc_list_region_name() . '">' . osc_list_region_name() . '</option>' ;
            }
            echo '</select>' ;
        }

        View::newInstance()->_erase('list_regions') ;
    }

    if( !function_exists('item_detail_location') ) {
        /*
         * @return array the list of location: starting with the address and finishing with the country
         */
        function item_detail_location() {
            $location = array() ;
            if( osc_item_address() != '' ) {
                $location[] = osc_item_address() ;
            }
            if( osc_item_city_area() != '' ) {
                $location[] = osc_item_city_area() ;
            }
            if( osc_item_city() != '' ) {
                $location[] = osc_item_city() ;
            }
            if( osc_item_region() != '' ) {
                $location[] = osc_item_region() ;
            }
            if( osc_item_country() != '' ) {
                $location[] = osc_item_country() ;
            }

            return $location ;
        }
    }

    if( !function_exists('twitter_show_flash_message') ) {
        function twitter_show_flash_message() {
            $message = Session::newInstance()->_getMessage('pubMessages') ;

            if (isset($message['msg']) && $message['msg'] != '') {
                if( $message['type'] == 'ok' ) $message['type'] = 'success' ;
                echo '<div class="alert-message ' . $message['type'] . '">' ;
                echo '<a class="close" href="#">×</a>';
                echo '<p>' . $message['msg'] . '</p>';
                echo '</div>' ;

                Session::newInstance()->_dropMessage('pubMessages') ;
            }
        }
    }

    if ( !function_exists('twitter_user_menu') ) {
        function twitter_user_menu( ) {
            $options = array();
            $options[] = array('name' => __('Dashboard', 'twitter'), 'url' => osc_user_dashboard_url(), 'class' => osc_is_user_dashboard() ? 'active opt_dashboard' : 'opt_dashboard' ) ;
            $options[] = array('name' => __('Manage your items', 'twitter'), 'url' => osc_user_list_items_url(), 'class' => osc_is_user_manage_items() ? 'active opt_items' : 'opt_items') ;
            $options[] = array('name' => __('Manage your alerts', 'twitter'), 'url' => osc_user_alerts_url(), 'class' => osc_is_user_manage_alerts() ? 'active opt_alerts' : 'opt_alerts') ;
            $options[] = array('name' => __('My account', 'twitter'), 'url' => osc_user_profile_url(), 'class' => osc_is_user_profile() ? 'active opt_dashboard' : 'opt_account' ) ;

            echo '<ul class="tabs">' ;

            $var_l = count($options) ;
            for($var_o = 0 ; $var_o < $var_l ; $var_o++) {
                echo '<li class="' . $options[$var_o]['class'] . '" ><a href="' . $options[$var_o]['url'] . '" >' . $options[$var_o]['name'] . '</a></li>' ;
            }

            osc_run_hook('user_menu') ;
            echo '</ul>' ;
        }
    }

    if ( !function_exists('osc_is_user_dashboard') ) {
        function osc_is_user_dashboard() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'dashboard' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_manage_items') ) {
        function osc_is_user_manage_items() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'items' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_manage_alerts') ) {
        function osc_is_user_manage_alerts() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && $section == 'alerts' ) {
                return true;
            }
            return false;
        }
    }

    if ( !function_exists('osc_is_user_profile') ) {
        function osc_is_user_profile() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            if( $location == 'user' && ( $section == 'profile' || $section == 'change_password' || $section == 'change_email' ) ) {
                return true;
            }
            return false;
        }
    }

    if( !function_exists('twitter_admin_menu') ) {
        function twitter_admin_menu() {
            echo '<h3><a href="#">' . __('Twitter theme','twitter') . '</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/twitter/admin/admin_settings.php') . '">&raquo; ' . __('Settings theme', 'twitter') . '</a></li>
            </ul>' ;
        }

        osc_add_hook('admin_menu', 'twitter_admin_menu') ;
    }

    if( !function_exists('osc_item_category_url') ) {
        function osc_item_category_url($category_id) {
            View::newInstance()->_erase('subcategories') ;
            View::newInstance()->_erase('categories') ;
            View::newInstance()->_exportVariableToView('category', Category::newInstance()->findByPrimaryKey($category_id) ) ;
            $url = osc_search_category_url() ;
            View::newInstance()->_erase('category') ;

            return $url ;
        }
    }

    if( !function_exists('meta_title') ) {
        function meta_title( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = __('Publish an item', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case 'item_edit':   $text = __('Edit your item', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case 'send_friend': $text = __('Send to a friend', 'twitter') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        case 'contact':     $text = __('Contact seller', 'twitter') . ' - ' . osc_item_title() . ' - ' . osc_page_title() ; break ;
                        default:            $text = osc_item_title() . ' - ' . osc_page_title() ; break ;
                    }
                break ;
                case('page'):
                    $text = osc_static_page_title() . ' - ' . osc_page_title() ;
                break ;
                case('error'):
                    $text = __('Error', 'twitter') . ' - ' . osc_page_title() ;
                break ;
                case('search'):
                    $region   = Params::getParam('sRegion') ;
                    $city     = Params::getParam('sCity') ;
                    $pattern  = Params::getParam('sPattern') ;
                    $category = osc_search_category_id() ;
                    $category = ((count($category) == 1) ? $category[0] : '') ;
                    $s_page   = '' ;
                    $i_page   = Params::getParam('iPage') ;

                    if($i_page != '' && $i_page > 0) {
                        $s_page = __('page', 'twitter') . ' ' . ($i_page + 1) . ' - ' ;
                    }

                    $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '') ;
                    $b_category = ($category != '') ;
                    $b_pattern  = ($pattern != '') ;
                    $b_city     = ($city != '') ;
                    $b_region   = ($region != '') ;

                    if($b_show_all) {
                        $text = __('Show all items', 'twitter') . ' - ' . $s_page . osc_page_title() ;
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
                        $result = __('Search', 'twitter') ;
                    }

                    $text = $result . ' - ' . $s_page . osc_page_title() ;
                break ;
                case('login'):
                    switch ($section) {
                        case('recover'): $text = __('Recover your password', 'twitter') . ' - ' . osc_page_title() ;
                        break;
                        default:         $text = __('Login', 'twitter') . ' - ' . osc_page_title() ;
                    }
                break ;
                case('register'):
                    $text = __('Create a new account', 'twitter') . ' - ' . osc_page_title() ;
                break ;
                case('user'):
                    switch ($section) {
                        case('dashboard'):       $text = __('Dashboard', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('items'):           $text = __('Manage my items', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('alerts'):          $text = __('Manage my alerts', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('profile'):         $text = __('Update my profile', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('change_email'):    $text = __('Change my email', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('change_password'): $text = __('Change my password', 'twitter') . ' - ' . osc_page_title() ; break ;
                        case('forgot'):          $text = __('Recover my password', 'twitter') . ' - ' . osc_page_title() ; break ;
                        default:                 $text = osc_page_title() ; break ;
                    }
                break ;
                case('contact'):
                    $text = __('Contact','twitter') . ' - ' . osc_page_title() ;
                break ;
                default:
                    $text = osc_page_title() ;
                break ;
            }

            $text = str_replace('"', "'", $text) ;
            return ($text) ;
         }
     }

     if( !function_exists('meta_description') ) {
         function meta_description( ) {
            $location = Rewrite::newInstance()->get_location() ;
            $section  = Rewrite::newInstance()->get_section() ;
            $text     = '' ;

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = '' ; break ;
                        case 'item_edit':   $text = '' ; break ;
                        case 'send_friend': $text = '' ; break ;
                        case 'contact':     $text = '' ; break ;
                        default:
                            $text = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                            break;
                    }
                break;
                case('page'):
                    $text = osc_highlight(strip_tags(osc_static_page_text()), 140) ;
                break;
                case('search'):
                    $result = '' ;

                    if( osc_count_items() == 0 ) {
                        $text = '' ;
                    }

                    if( osc_has_items () ) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category() ;
                    }

                    osc_reset_items() ;
                    $text = $result ;
                case(''): // home
                    $result = '' ;

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

     /**
      * Extend Pagination Class
      */
     class TwitterPagination extends Pagination
     {
        public function __construct($params = null) {
            parent::__construct($params);
        }

        public function get_links()
        {
            $pages = $this->get_pages();
            $links = array();

            if(isset($pages['prev'])) {
                $links[] = '<li class="' . $this->class_prev . '"><a href="' . str_replace('{PAGE}', $pages['prev'], str_replace(urlencode('{PAGE}'), $pages['prev'], $this->url)) . '">' . $this->text_prev . '</a></li>';
            }

            foreach($pages['pages'] as $p) {
                if($p==$this->selected) {
                    $links[] = '<li class="' . $this->class_selected . '"><a href="' . str_replace('{PAGE}', $p, str_replace(urlencode('{PAGE}'), $p, $this->url)) . '">' . ($p) . '</a></li>';
                } else {
                    $links[] = '<li class="' . $this->class_non_selected . '"><a href="' . str_replace('{PAGE}', $p, str_replace(urlencode('{PAGE}'), $p, $this->url)) . '">' . ($p) . '</a></li>';
                }
            }

            if(isset($pages['next'])) {
                $links[] = '<li class="' . $this->class_next . '"><a href="' . str_replace('{PAGE}', $pages['next'], str_replace(urlencode('{PAGE}'), $pages['next'], $this->url)) . '">' . $this->text_next . '</a></li>';
            }

            return $links;
        }
     }

    /**
     * Helper to use twitter pagination in user items
     */
    function twitter_user_item_pagination() {
        $params = array('total'              => (int) View::newInstance()->_get('list_total_pages'),
                        'selected'           => (int) View::newInstance()->_get('list_page'),
                        'class_first'        => '',
                        'class_last'         => '',
                        'class_prev'         => 'prev',
                        'class_next'         => 'next',
                        'delimiter'          => '',
                        'text_prev'          => sprintf(__('%s Previous', 'twitter'), '&larr;'),
                        'text_next'          => sprintf(__('Next %s', 'twitter'), '&rarr;'),
                        'class_selected'     => 'active',
                        'class_non_selected' => '',
                        'force_limits'       => false,
                        'url'                => osc_user_list_items_url('{PAGE}')) ;
        $pagination = new TwitterPagination($params) ;
        return $pagination->doPagination() ;
    }

    /**
     * Helper to use twitter pagination in item comments
     */
    function twitter_comments_item_pagination() {
        $params = array('total'              => ceil( osc_item_total_comments()/osc_comments_per_page() ),
                        'selected'           => osc_item_comments_page(),
                        'class_first'        => '',
                        'class_last'         => '',
                        'class_prev'         => 'prev',
                        'class_next'         => 'next',
                        'delimiter'          => '',
                        'text_prev'          => sprintf(__('%s Previous', 'twitter'), '&larr;'),
                        'text_next'          => sprintf(__('Next %s', 'twitter'), '&rarr;'),
                        'class_selected'     => 'active',
                        'class_non_selected' => '',
                        'force_limits'       => false,
                        'url'                => osc_item_comments_url('{PAGE}')) ;
        $pagination = new TwitterPagination($params) ;
        return $pagination->doPagination() ;
    }

    /**
     * Helper to use twitter pagination in search results
     */
    function twitter_search_pagination() {
        $params = array('total'              => osc_search_total_pages(),
                        'selected'           => osc_search_page(),
                        'class_first'        => '',
                        'class_last'         => '',
                        'class_prev'         => 'prev',
                        'class_next'         => 'next',
                        'delimiter'          => '',
                        'text_prev'          => sprintf(__('%s Previous', 'twitter'), '&larr;'),
                        'text_next'          => sprintf(__('Next %s', 'twitter'), '&rarr;'),
                        'class_selected'     => 'active',
                        'class_non_selected' => '',
                        'force_limits'       => false,
                        'url'                => osc_update_search_url(array('iPage' => '{PAGE}')) ) ;
        $pagination = new TwitterPagination($params) ;
        return $pagination->doPagination() ;
    }

    /*********************/
    /* Item form helpers */
    /*********************/
    function item_selected_category_id () {
        $category_id = Params::getParam('catId') ;
        if(Session::newInstance()->_getForm('catId') != ""){
            $category_id = Session::newInstance()->_getForm('catId') ;
        }

        if( osc_item() != null ) {
            $item        = osc_item() ;
            $category_id = $item['fk_i_category_id'] ;
        }

        if( empty($category_id) ) {
            return "null" ;
        }

        if( method_exists( Category::newInstance(), 'is_root' ) ) {
            if( !Category::newInstance()->is_root($category_id) ) {
                $category = Category::newInstance()->findRootCategory($category_id) ;
                return $category['pk_i_id'];
            }
        } else {
            if( !Category::newInstance()->isRoot($category_id) ) {
                $category = Category::newInstance()->findRootCategory($category_id) ;
                return $category['pk_i_id'];
            }
        }

        return $category_id ;
    }

    function item_selected_subcategory_id () {
        $category_id = Params::getParam('catId') ;
        if(Session::newInstance()->_getForm('catId') != ""){
            $category_id = Session::newInstance()->_getForm('catId') ;
        }

        if( osc_item() != null ) {
            $item        = osc_item() ;
            $category_id = $item['fk_i_category_id'] ;
        }

        if( empty($category_id) ) {
            return "null" ;
        }

        if( method_exists( Category::newInstance(), 'is_root' ) ) {
            if( Category::newInstance()->is_root($category_id) ) {
                return "null" ;
            }
        } else {
            if( Category::newInstance()->isRoot($category_id) ) {
                return "null" ;
            }
        }

        return $category_id ;
    }

    function item_category_select_js() {
        ?>
        <script type="text/javascript">
            twitter_theme.categories = {} ;
        <?php
        $aCategories = osc_get_categories() ;
        foreach($aCategories as $category) {
            if( is_array($category['categories']) && (count($category['categories']) > 0) ) {
                echo 'twitter_theme.categories.id_' . $category['pk_i_id'] . ' = {' . PHP_EOL ;
                for($i = 0; $i < count($category['categories']); $i++) {
                    echo $category['categories'][$i]['i_position'] . ': { id: ' . $category['categories'][$i]['pk_i_id'] . ', slug: "' . addslashes($category['categories'][$i]['s_slug']) . '", name: "' . addslashes($category['categories'][$i]['s_name']) . '"' ;
                    if( $i == (count($category['categories']) - 1) ) {
                        echo '}' . PHP_EOL ;
                    } else {
                        echo '} ,' . PHP_EOL ;
                    }
                }
                echo '} ;' ;
            } else {
                echo 'twitter_theme.categories.' . $category['s_slug'] . ' = { } ;' . PHP_EOL  ;
            }
        }
        ?>
        </script>
        <?php
    }

    function item_category_select($default_option) {
        $categories = Category::newInstance()->findRootCategoriesEnabled() ; ?>
        <?php if( count($categories) > 0 ) { ?>
        <select class="category">
            <option><?php echo $default_option ; ?></option>
            <?php foreach($categories as $c) { ?>
            <option value="<?php echo $c['pk_i_id'] ; ?>"><?php echo $c['s_name'] ; ?></option>
            <?php } ?>
        </select>
        <?php } ?>
        <select class="subcategory" name="catId" style="display:none"></select>
        <?php
    }

    function item_title_description_multilanguage_box($title_txt, $description_txt, $locales) { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <ul class="tabs" data-tabs="tabs">
            <?php $i = 0; ?>
            <?php foreach($locales as $l) { ?>
                <li <?php if( $i == 0 ) { ?>class="active"<?php } ?>><a href="#tab<?php echo $l['pk_c_code'] ; ?>"><?php echo $l['s_name'] ; ?></a></li>
                <?php $i++; ?>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php $i = 0; ?>
            <?php foreach($locales as $l) { ?>
                <div <?php if( $i == 0 ) { ?>class="active"<?php } ?> id="tab<?php echo $l['pk_c_code'] ; ?>">
                    <div class="clearfix">
                        <label><?php echo $title_txt ; ?></label>
                        <div class="input">
                            <input class="xxlarge" type="text" name="title[<?php echo $l['pk_c_code'] ; ?>]" value="<?php echo get_item_title($item, $l['pk_c_code']) ; ?>" />
                        </div>
                    </div>
                    <div class="clearfix">
                        <label><?php echo $description_txt ; ?></label>
                        <div class="input">
                            <textarea id="description[<?php echo $l['pk_c_code'] ; ?>]" name="description[<?php echo $l['pk_c_code'] ; ?>]" class="xxlarge" rows="9"><?php echo get_item_description($item, $l['pk_c_code']) ; ?></textarea>
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            <?php } ?>
        <?php
    }

    function item_title_description_box($title_txt, $description_txt, $locales) { ?>
        <?php $l = $locales[0] ; ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <div class="clearfix">
            <label><?php echo $title_txt ; ?></label>
            <div class="input">
                <input class="xxlarge" type="text" name="title[<?php echo $l['pk_c_code'] ; ?>]" value="<?php echo get_item_title($item, $l['pk_c_code']) ; ?>" />
            </div>
        </div>
        <div class="clearfix">
            <label><?php echo $description_txt ; ?></label>
            <div class="input">
                <textarea id="description[<?php echo $l['pk_c_code'] ; ?>]" name="description[<?php echo $l['pk_c_code'] ; ?>]" class="xxlarge" rows="9"><?php echo get_item_description($item, $l['pk_c_code']) ; ?></textarea>
            </div>
        </div>
        <?php
    }

    function get_item_title($item, $locale_code) {
        $title = "" ;
        if( count($item) == 0 ) {
            return get_item_title_from_session($locale_code) ;
        }

        if( !array_key_exists($locale_code, $item['locale']) ) {
            return get_item_title_from_session($locale_code) ;
        }

        if( !array_key_exists('s_title', $item['locale'][$locale_code]) ) {
            return get_item_title_from_session($locale_code) ;
        }

        $title = $item['locale'][$locale_code]['s_title'] ;

        $titleFromSession = get_item_title_from_session($locale_code) ;
        if( $titleFromSession != "" ) {
            return $titleFromSession ;
        }

        return $title ;
    }

    function get_item_title_from_session($locale_code) {
        $title     = "" ;

        $titleForm = Session::newInstance()->_getForm('title');
        if( !is_array($titleForm) ) {
            return $title ;
        }

        if( array_key_exists($locale_code, $titleForm) && ($titleForm[$locale_code] != "" ) ) {
            $title = $titleForm[$locale_code];
        }

        return $title ;
    }

    function get_item_description($item, $locale_code) {
        $description = "" ;
        if( count($item) == 0 ) {
            return get_item_description_from_session($locale_code) ;
        }

        if( !array_key_exists($locale_code, $item['locale']) ) {
            return get_item_description_from_session($locale_code) ;
        }

        if( !array_key_exists('s_description', $item['locale'][$locale_code]) ) {
            return get_item_description_from_session($locale_code) ;
        }

        $description = $item['locale'][$locale_code]['s_description'] ;

        $descriptionFromSession = get_item_description_from_session($locale_code) ;
        if( $descriptionFromSession != "" ) {
            return $descriptionFromSession ;
        }

        return $description ;
    }

    function get_item_description_from_session($locale_code) {
        $description     = "" ;

        $descriptionForm = Session::newInstance()->_getForm('description');
        if( !is_array($descriptionForm) ) {
            return $description ;
        }

        if( array_key_exists($locale_code, $descriptionForm) && ($descriptionForm[$locale_code] != "" ) ) {
            $description = $descriptionForm[$locale_code];
        }

        return $description ;
    }

    function item_price_input() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="text" id="price" class="medium" name="price" value="<?php echo get_item_price($item) ; ?>">
        <?php
    }

    function get_item_price($item) {
        $priceFromSession = Session::newInstance()->_getForm('price');

        if( count($item) == 0 ) {
            if( osc_version() >= 230 ) {
                $priceFromSession = osc_prepare_price( $priceFromSession ) ;
            }
            return $priceFromSession ;
        }

        if( $priceFromSession != '' ) {
            if( osc_version() >= 230 ) {
                $priceFromSession = osc_prepare_price( $priceFromSession ) ;
            }
            return $priceFromSession ;
        }

        if( osc_version() < 230 ) {
            return $item['f_price'] ;
        }

        return osc_prepare_price( $item['i_price'] ) ;
    }

    function item_currency_select() {
        $item = (osc_item() != null) ? osc_item() : array() ;
        $aCurrencies = osc_get_currencies() ;
        $currencySelected = get_item_currency($item) ; ?>
        <select class="medium" id="currency" name="currency">
            <?php foreach($aCurrencies as $currency) { ?>
                <option value="<?php echo $currency['pk_c_code'] ; ?>" <?php echo ($currencySelected == $currency['pk_c_code']) ? 'selected="selected"' : '' ?>><?php echo $currency['s_description'] ; ?></option>
            <?php } ?>
        </select>
        <?php
    }

    function get_item_currency($item) {
        $currencyFromSession = Session::newInstance()->_getForm('currency') ;

        if( count($item) == 0 && $currencyFromSession == '' ) {
            return osc_currency() ;
        }

        if( $currencyFromSession != '' ) {
            return $currencyFromSession ;
        }

        return $item['fk_c_currency_code'] ;
    }

    function item_contact_name_input() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="text" id="contactName" class="large" name="contactName" value="<?php echo get_item_contact_name($item) ; ?>">
        <?php
    }

    function get_item_contact_name($item) {
        $contactNameFromSession = Session::newInstance()->_getForm('contactName');

        if( count($item) == 0) {
            return $contactNameFromSession ;
        }

        if( $contactNameFromSession != '' ) {
            return $contactNameFromSession ;
        }

        return $item['s_contact_name'] ;
    }

    function item_contact_mail_input() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="text" id="contactEmail" class="large" name="contactEmail" value="<?php echo get_item_contact_mail($item) ; ?>">
        <?php
    }

    function get_item_contact_mail($item) {
        $contactMailFromSession = Session::newInstance()->_getForm('contactEmail');

        if( count($item) == 0) {
            return $contactMailFromSession ;
        }

        if( $contactMailFromSession != '' ) {
            return $contactMailFromSession ;
        }

        return $item['s_contact_email'] ;
    }

    function item_contact_show_email_checkbox() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="checkbox" id="showEmail" name="showEmail" value="1" <?php echo get_item_contact_show_email($item) ; ?>>
        <?php
    }

    function get_item_contact_show_email($item) {
        $showMailFromSession = false;

        if( Session::newInstance()->_getForm('showEmail') != 0) {
            $showMailFromSession = Session::newInstance()->_getForm('showEmail') ;
        }

        if( count($item) != 0) {
            $showMailFromSession = $item['b_show_email'] ;
        }

        if( $showMailFromSession ) {
            return 'checked="checked"' ;
        }

        return "" ;
    }

    function item_country_box($country_txt, $country_select_txt) {
        $aCountries = osc_get_countries() ;
        $item       = (osc_item() != null) ? osc_item() : array() ;

        switch( count($aCountries) ) {
            case 0:     // no country, show input ?>
                        <div class="clearfix">
                            <label><?php echo $country_txt ; ?></label>
                            <div class="input">
                                <input class="country_name" id="country_name" type="text" name="country" value="<?php echo get_country_name($item) ; ?>" />
                            </div>
                        </div>
            <?php
            break;
            case 1:     // one country ?>
                        <input class="country_id" id="country_id" type="hidden" name="countryId" value="<?php echo get_country_id($item) ; ?>" />
            <?php
            break;
            default:    // more than one country ?>
                        <div class="clearfix">
                            <label><?php echo $country_txt ; ?></label>
                            <div class="input">
                                <select class="country_id" id="country_id" name="countryId">
                                    <option value=""><?php echo $country_select_txt ; ?></option>
                                    <?php foreach($aCountries as $country) { ?>
                                        <option value="<?php echo $country['pk_c_code'] ; ?>"><?php echo $country['s_name'] ; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
            <?php
            break;
        }
    }

    function get_country_name($item) {
        $country_name = "" ;

        if( array_key_exists('s_country', $item) ) {
            $country_name = $item['s_country'] ;
        }

        if( Session::newInstance()->_getForm('country') != '' ) {
            $country_name = Session::newInstance()->_getForm('country') ;
        }

        return $country_name;
    }

    function get_country_id($item) {
        $country_id = "" ;
        $aCountries = osc_get_countries() ;

        if( count($aCountries) == 1 ) {
            $country_id = $aCountries[0]['pk_c_code'] ;
        }

        if( array_key_exists('fk_c_country_code', $item) ) {
            $country_id = $item['fk_c_country_code'] ;
        }

        if( Session::newInstance()->_getForm('countryId') != '' ) {
            $country_id = Session::newInstance()->_getForm('countryId') ;
        }

        return $country_id ;
    }

    function item_region_box($region_txt, $region_select_txt) {
        $aRegions   = osc_get_regions() ;
        $item       = (osc_item() != null) ? osc_item() : array() ;

        switch( count($aRegions) ) {
            case 0:     // 0 regions ?>
                        <div class="clearfix">
                            <label><?php echo $region_txt ; ?></label>
                            <div class="input">
                                <input class="region_name" id="region_name" type="text" name="region" value="<?php echo get_region_name($item) ; ?>" />
                            </div>
                        </div>
            <?php
            break;
            case 1:     // only one region ?>
                        <input class="region_id" id="region_id" type="hidden" name="regionId" value="<?php echo get_region_id($item) ; ?>" />
            <?php
            break;
            default:    // more than one region ?>
                        <div class="clearfix">
                            <label><?php echo $region_txt ; ?></label>
                            <div class="input">
                                <select class="region_id" id="region_id" name="regionId">
                                    <option value=""><?php echo $region_select_txt ; ?></option>
                                    <?php foreach($aRegions as $region) { ?>
                                        <option value="<?php echo $region['pk_i_id'] ; ?>"><?php echo $region['s_name'] ; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
            <?php
            break;
        }
    }

    function get_region_name($item) {
        $region_name = "" ;

        if( array_key_exists('s_region', $item) ) {
            $region_name = $item['s_region'] ;
        }

        if( Session::newInstance()->_getForm('region') != '' ) {
            $region_name = Session::newInstance()->_getForm('region') ;
        }

        return $region_name;
    }

    function get_region_id($item) {
        $region_id = "" ;
        $aRegions  = osc_get_regions() ;

        if( count($aRegions) == 1 ) {
            $region_id = $aRegions[0]['pk_i_id'] ;
        }

        if( array_key_exists('fk_i_region_id', $item) ) {
            $region_id = $item['fk_i_region_id'] ;
        }

        if( Session::newInstance()->_getForm('regionId') != '' ) {
            $region_id = Session::newInstance()->_getForm('regionId') ;
        }

        return $region_id ;
    }

    function item_city_box($city_txt, $city_select_txt, $k = false) {

        if($k) { ?>
        <div class="clearfix">
                <label><?php echo $city_txt; ?></label>
                <div class="input">
                        <select class="city_id" id="city_id" name="cityId">
                                <option value=""><?php echo $city_select_txt; ?></option>
                        </select>
                </div>
        </div>
            <?php
            return;
        }

        $aCities    = osc_get_cities() ;
        $item       = (osc_item() != null) ? osc_item() : array() ;

        switch( count($aCities) ) {
            case 0:     // 0 regions ?>
                        <div class="clearfix">
                            <label><?php echo $city_txt ; ?></label>
                            <div class="input">
                                <input class="city_name" id="city_name" type="text" name="city" value="<?php echo get_city_name($item) ; ?>" />
                            </div>
                        </div>
            <?php
            break;
            case 1:     // only one region ?>
                        <input class="city_id" id="city_id" type="hidden" name="cityId" value="<?php echo get_city_id($item) ; ?>" />
            <?php
            break;
            default:    // more than one region ?>
                        <div class="clearfix">
                            <label><?php echo $city_txt ; ?></label>
                            <div class="input">
                                <select class="city_id" id="city_id" name="cityId">
                                    <option value=""><?php echo $city_select_txt ; ?></option>
                                    <?php foreach($aCities as $city) { ?>
                                        <option value="<?php echo $city['pk_i_id'] ; ?>"><?php echo $city['s_name'] ; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
            <?php
            break;
        }
    }

    function get_city_name($item) {
        $city_name = "" ;

        if( array_key_exists('s_city', $item) ) {
            $city_name = $item['s_city'] ;
        }

        if( Session::newInstance()->_getForm('city') != '' ) {
            $city_name = Session::newInstance()->_getForm('city') ;
        }

        return $city_name;
    }

    function get_city_id($item) {
        $city_id = "" ;

        if( array_key_exists('fk_i_city_id', $item) ) {
            $city_id = $item['fk_i_city_id'] ;
        }

        if( Session::newInstance()->_getForm('cityId') != '' ) {
            $city_id = Session::newInstance()->_getForm('cityId') ;
        }

        return $city_id ;
    }

    function item_city_area() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="text" id="cityArea" name="cityArea" value="<?php echo get_item_city_area($item) ; ?>" />
        <?php
    }

    function get_item_city_area($item) {
        $city_area = "" ;

        if( array_key_exists('s_city_area', $item) ) {
            $city_area = $item['s_city_area'] ;
        }

        if( Session::newInstance()->_getForm('cityArea') != '' ) {
            $city_area = Session::newInstance()->_getForm('cityArea') ;
        }

        return $city_area ;
    }

    function item_address() { ?>
        <?php $item = (osc_item() != null) ? osc_item() : array() ; ?>
        <input type="text" id="address" name="address" value="<?php echo get_item_address($item) ; ?>" />
        <?php
    }

    function get_item_address($item) {
        $address = "" ;

        if( array_key_exists('s_address', $item) ) {
            $address = $item['s_address'] ;
        }

        if( Session::newInstance()->_getForm('address') != '' ) {
            $address = Session::newInstance()->_getForm('address') ;
        }

        return $address ;
    }

    /* Breadcrumbs */
    function twitter_breadcrumb($separator = '/') {
        $breadcrumb = array() ;
        $text       = '' ;
        $location   = Rewrite::newInstance()->get_location() ;
        $section    = Rewrite::newInstance()->get_section() ;
        $separator  = '<span class="divider">' . trim($separator) . '</span>';
        $page_title = '<li><a href="' . osc_base_url() .  '">' . osc_page_title() . '</a>' . $separator . '</li>';

        switch ($location) {
            case ('item'):
                switch ($section) {
                    case 'item_add':    break;
                    default :           $aCategories = Category::newInstance()->toRootTree( (string) osc_item_category_id() );
                                        $category    = '';
                                        if(count($aCategories) == 0) {
                                            break;
                                        }

                                        foreach ($aCategories as $aCategory) {
                                            $list[] = '<li><a href="' . osc_item_category_url($aCategory['pk_i_id']) . '">' . $aCategory['s_name']. '</a>' . $separator . '</li>';
                                        }
                                        $category = implode('', $list) ;
                                        break;
                }

                switch ($section) {
                    case 'item_add':    $text = $page_title . '<li>' . __('Publish an item', 'twitter') . '</li>'; break;
                    case 'item_edit':   $text = $page_title . '<li><a href="' . osc_item_url() . '">' . osc_item_title() . '</a>' . $separator .  '</li><li>' . __('Edit your item', 'twitter') . '</li>'; break;
                    case 'send_friend': $text = $page_title . $category . '<li><a href="' . osc_item_url() . '">' . osc_item_title() . '</a>' . $separator .  '</li><li>' . __('Send to a friend', 'twitter') . '</li>'; break;
                    case 'contact':     $text = $page_title . $category . '<li><a href="' . osc_item_url() . '">' . osc_item_title() . '</a>' . $separator .  '<li><li>' . __('Contact seller', 'twitter') . '</li>'; break;
                    default:            $text = $page_title . $category . '<li>' . osc_item_title() . '</li>'; break;
                }
            break;
            case('page'):
                $text = $page_title . '<li>' . osc_static_page_title() . '</li>';
            break;
            case('search'):
                $region     = Params::getParam('sRegion');
                $city       = Params::getParam('sCity');
                $pattern    = Params::getParam('sPattern');
                $category   = osc_search_category_id();
                $category   = ((count($category) == 1) ? $category[0] : '');

                $b_show_all = ($pattern == '' && $category == '' && $region == '' && $city == '');
                $b_category = ($category != '');
                $b_pattern  = ($pattern != '');
                $b_region   = ($region != '');
                $b_city     = ($city != '');
                $b_location = ($b_region || $b_city);

                if($b_show_all) {
                    $text = $page_title . '<li>' . __('Search', 'twitter') . '</li>' ;
                    break;
                }

                // init
                $result = $page_title ;

                if($b_category) {
                    $list        = array();
                    $aCategories = Category::newInstance()->toRootTree($category);
                    if(count($aCategories) > 0) {
                        $deep = 1;
                        foreach ($aCategories as $single) {
                            $list[] = '<li><a href="' . osc_item_category_url($single['pk_i_id']) . '">' . $single['s_name']. '</a>' . $separator . '</li>';
                            $deep++;
                        }
                        // remove last link
                        if( !$b_pattern && !$b_location ) {
                            $list[count($list) - 1] = preg_replace('|<li><a href.*?>(.*?)</a>.*?</li>|', '$01', $list[count($list) - 1]);
                        }
                        $result .= implode('', $list) ;
                    }
                }

                if( $b_location ) {
                    $list   = array();
                    $params = array();
                    if($b_category) $params['sCategory'] = $category;

                    if($b_city) {
                        $aCity = City::newInstance()->findByName($city);
                        if( count($aCity) == 0 ) {
                            $params['sCity'] = $city;
                            $list[] = '<li><a href="' . osc_search_url($params) . '">' . $city . '</a>' . $separator . '</li>';
                        } else {
                            $aRegion = Region::newInstance()->findByPrimaryKey($aCity['fk_i_region_id']);

                            $params['sRegion'] = $aRegion['s_name'];
                            $list[] = '<li><a href="' . osc_search_url($params) . '">' . $aRegion['s_name'] . '</a>' . $separator . '</li>';

                            $params['sCity'] = $aCity['s_name'];
                            $list[] = '<li><a href="' . osc_search_url($params) . '">' . $aCity['s_name'] . '</a>' . $separator . '</li>';
                        }

                        if( !$b_pattern ) {
                            $list[count($list) - 1] = preg_replace('|<li><a href.*?>(.*?)</a>.*?</li>|', '$01', $list[count($list) - 1]);
                        }
                        $result .= implode('', $list) ;
                    } else if( $b_region ) {
                        $params['sRegion'] = $region ;
                        $list[]  = '<li><a href="' . osc_search_url($params) . '">' . $region . '</a>' . $separator . '</li>';

                        if( !$b_pattern ) {
                            $list[count($list) - 1] = preg_replace('|<li><a href.*?>(.*?)</a>.*?</li>|', '$01', $list[count($list) - 1]);
                        }
                        $result .= implode('', $list) ;
                    }
                }

                if($b_pattern) {
                    $result .= '<li>' . __('Search Results', 'twitter') . ': ' . $pattern  . '</li>' ;
                }

                // remove last separator
                $result = preg_replace('|' . trim($separator) . '\s*$|', '', $result);
                $text   = $result;
            break;
            case('login'):
                switch ($section) {
                    case('recover'): $text = $page_title . '<li>' . __('Recover your password', 'twitter') . '</li>';
                    break;
                    default:         $text = $page_title . '<li>' . __('Login', 'twitter') . '</li>';
                }
            break;
            case('register'):
                $text = $page_title . '<li>' . __('Create a new account', 'twitter') . '</li>';
            break;
            case('contact'):
                $text = $page_title . '<li>' . __('Contact', 'twitter') . '</li>';
            break;
            default:
            break;
        }

        return '<ul class="breadcrumb">' . $text . '</ul>';
    }

?>