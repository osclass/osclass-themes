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
    //Install theme advanced
    //Create custom fields
    if(!function_exists('addSubCategoories')){
        function addSubCategoories($array, &$output){
            if($array){
                foreach($array as $array_item){
                    $output[] = $array_item['pk_i_id'];
                    addSubCategoories($array_item['categories'], $output);
                }
            }
        }
    }

    if(!function_exists('footer_js')){
        function footer_js(){
            echo '<script type="text/javascript"><!--//--><![CDATA[//><!--';
            osc_run_hook('footer_js');
            echo "\n";
            echo "$('#error_list').append('<div class=\"hide_errors\">x</div>');\n";
            echo "$('.hide_errors').click(function(){ $(this).parent().hide();});\n";
            echo '//--><!]]></script>';
        }
    }
    osc_add_hook('footer','footer_js');

    if(!function_exists('theme_version_info')){
        function theme_version_info(){
            return array('name'=>'seeker_db_version', 'version'=>0.3);
        }
    }

    if(!function_exists('theme_install')){
        function theme_install() {
            $categories = osc_get_categories();
            $categories_ids = array();
            addSubCategoories($categories, $categories_ids);

            if(!osc_get_preference('keyword_placeholder','seeker')){
                osc_set_preference('keyword_placeholder',__('ie. PHP Programmer'),'seeker');
            }

            if(!Field::newInstance()->findBySlug('s_department')){
                Field::newInstance()->insertField(__('Department or Unit','seeker'), 'TEXT', 's_department', 0, '', $categories_ids);
            }
            if(!Field::newInstance()->findBySlug('s_position_type')){
                Field::newInstance()->insertField(__('Employment Type','seeker'), 'DROPDOWN', 's_position_type', 0, 
                    __('Full Time','seeker').','.
                    __('Part Time','seeker').','.
                    __('Part Time to Full Time','seeker').','.
                    __('Temporary','seeker').','.
                    __('Temporary to Full Time','seeker').','.
                    __('Full Time','seeker').','.
                    __('Contracted','seeker').','.
                    __('Contracted to Full Time','seeker').','.
                    __('Internship','seeker').','.
                    __('Internship to Full Time','seeker').','.
                    __('Seasonal','seeker').','.
                    __('Volunteer','seeker'),
                    $categories_ids);
            }
            if(!Field::newInstance()->findBySlug('s_job_experience')){
                Field::newInstance()->insertField(__('Minimum Experience','seeker'), 'DROPDOWN', 's_job_experience', 0, 
                    __('Student (High School)','seeker').','.
                    __('Student (College)','seeker').','.
                    __('Entry Level','seeker').','.
                    __('Mid Level','seeker').','.
                    __('Experienced','seeker').','.
                    __('Manager/Supervisor','seeker').','.
                    __('Senior Manager/Supervisor','seeker').','.
                    __('Executive','seeker').','.
                    __('Senior Executive'),
                    $categories_ids);
            }
            if(!Field::newInstance()->findBySlug('s_number_positions')){
                Field::newInstance()->insertField(__('Number of positions','seeker'), 'TEXT', 's_number_positions', 0, '', $categories_ids);
            }
            if(!Field::newInstance()->findBySlug('s_salary')){
                Field::newInstance()->insertField(__('Salary','seeker'), 'TEXT', 's_salary', 0, '', $categories_ids);
            }

            $version = theme_version_info();
            //Save that theme has installed
            osc_set_preference($version['name'], $version['version'],'seeker');
        }
    }

    if(!function_exists('check_install_theme')){
        function check_install_theme(){
            $version = theme_version_info();
            $current_version = osc_get_preference($version['name'],'seeker');
            //check if current version is installed or need an update<
            if(!$current_version || $current_version < $version['version']){
                theme_install();
            }
        }
    }
    check_install_theme();

    osc_add_hook('admin_footer', 'job_form');
    if(!function_exists('job_form')){
        function job_form($catId = '') {
            echo "<script type=\"text/javascript\">$(\"#catId\").change();</script>";
        }
    }

    //Define colors
    if(!function_exists('seeker_dynamic_styles')){
        function seeker_dynamic_styles(){
            $colors = array(
                array('key'=>'@background_color','value' =>'#ffffff', 'name'=>__('Background Color','seeker')),
                array('key'=>'@color_1','value' =>'#08737b', 'name'=>__('Main Color','seeker')),
                array('key'=>'@color_2','value' =>'#25cdd9', 'name'=>__('Secondary Color','seeker'))
            );
            return $colors;
        }
        $dynamic_styles = seeker_dynamic_styles();
        if($dynamic_styles){
            foreach($dynamic_styles as $d_style){
                if(!osc_get_preference($d_style['key'],'seeker')){
                    osc_set_preference($d_style['key'],$d_style['value'],'seeker');
                }
            }
        }
    }

    if( !function_exists('seeker_dynamic_css') ) {
        function seeker_dynamic_css() {
            $css = <<<CSS
            <style>
                /* Background */
                body{
                    background-color:@background_color;
                }
                /* Color 1 */
                #logo,
                #nav a,
                .latest_ads .see_more_link a,
                .ad_list table td a{
                    color:@color_1;
                }
                #nav{
                    border-bottom:solid 2px @color_1;
                }
                #nav li.current-menu-item{
                    border-bottom-color:@color_1;
                }
                #upload-button{
                    border:solid 1px @color_1;
                }
                .paginate a:hover,
                #contact h2,
                #contact h1{
                    background-color:@color_1;
                }
                /* Color 2 */
                .ad_list table th{
                    background-color:@color_2;
                }
                .paginate .searchPaginationSelected{
                    background-color:@color_2 !important;
                }
                #page-content h1,
                #page-content h2,
                #page-content h3,
                #page-content h4,
                #page-content h5,
                #page-content h6{
                    color:@color_2;
                }
            </style>
CSS;

            $css = str_replace('@color_1', osc_get_preference('@color_1', 'seeker'), $css) ;
            $css = str_replace('@color_2', osc_get_preference('@color_2', 'seeker'), $css) ;
            $css = str_replace('@background_color', osc_get_preference('@background_color', 'seeker'), $css) ;

            echo $css ;
        }
        osc_add_hook('header', 'seeker_dynamic_css') ;
    }

    //Add body classes
    osc_add_hook('body_class','add_default_bodyclasses');
    if(!function_exists('add_default_bodyclasses')){
        function add_default_bodyclasses(){
            if(osc_is_ad_page()){
                echo 'ad-page';
            }
            if(osc_is_search_page()){
                echo 'search-page';
            }
            if(osc_is_static_page()){
                echo 'static-page';
            }
            if(osc_is_home_page()){
                echo 'home-page';
            }
            if(osc_is_user_dashboard()){
                echo 'user-dashboard';
            }
            if(osc_is_publish_page()){
                echo 'publish-page';
            }
            if(osc_is_login_form()){
                echo 'login-form';
            }
            if(osc_is_contact_page()){
                echo 'contact-form';
            }
            if(Params::getParam('action') == 'send_friend'){
                echo 'send-friend';
            }
            if(Params::getParam('action') == 'contact'){
                echo 'item-contact';
            }
        }
    }

    if( !function_exists('osc_is_contact_page') ) {
        function osc_is_contact_page() {
            $location = Rewrite::newInstance()->get_location() ;
            $section = Rewrite::newInstance()->get_section() ;
            if( $location == 'contact' ) {
                return true ;
            }
            return false ;
        }
    }

    if( !function_exists('is_current_page') ) {
        function is_current_page($page_id){
            if(osc_is_static_page() && Params::getParam("id") == $page_id){
                return true;
            }
            return false;
        }
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

    if( !function_exists('seeker_admin_menu') ) {
        function seeker_admin_menu() {
            echo '<h3><a href="#">'. __('seeker theme','seeker') .'</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php') . '">&raquo; '.__('Settings theme', 'seeker').'</a></li>
            </ul>';
        }

        osc_add_hook('admin_menu', 'seeker_admin_menu');
    }

    if( !function_exists('meta_title') ) {
        function meta_title( ) {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'send_friend': $text = __('Send to a friend', 'seeker') . ' - ' . osc_item_title() . ' - ' . osc_page_title(); break;
                        case 'contact':     $text = __('Apply for thhis job', 'seeker') . ' - ' . osc_item_title() . ' - ' . osc_page_title(); break;
                        default:            $text = osc_item_title() . ' - ' . osc_page_title(); break;
                    }
                break;
                case('page'):
                    $text = osc_static_page_title() . ' - ' . osc_page_title();
                break;
                case('error'):
                    $text = __('Error', 'seeker') . ' - ' . osc_page_title();
                break;
                case('search'):
                    $region   = Params::getParam('sRegion');
                    $city     = Params::getParam('sCity');
                    $pattern  = Params::getParam('sPattern');
                    $category = osc_search_category_id();
                    $category = ((count($category) == 1) ? $category[0] : '');
                    $s_page   = '';
                    $i_page   = Params::getParam('iPage');

                    if($i_page != '' && $i_page > 0) {
                        $s_page = __('page', 'seeker') . ' ' . ($i_page + 1) . ' - ';
                    }

                    $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '');
                    $b_category = ($category != '');
                    $b_pattern  = ($pattern != '');
                    $b_city     = ($city != '');
                    $b_region   = ($region != '');

                    if($b_show_all) {
                        $text = __('Show all items', 'seeker') . ' - ' . $s_page . osc_page_title();
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
                        $result = __('Search', 'seeker');
                    }

                    $text = $result . ' - ' . $s_page . osc_page_title();
                break;
                case('contact'):
                    $text = __('Upload your CV','seeker') . ' - ' . osc_page_title();
                break;
                default:
                    $text = osc_page_title();
                break;
            }
            
            $text = str_replace("\n", '', $text) ;
            $text = trim($text) ;
            $text = osc_esc_html($text) ;
            return $text ;
        }
    }

    if( !function_exists('meta_description') ) {
        function meta_description( ) {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();
            $text     = '';

            switch ($location) {
                case ('item'):
                    switch ($section) {
                        case 'item_add':    $text = ''; break;
                        case 'item_edit':   $text = ''; break;
                        case 'send_friend': $text = ''; break;
                        case 'contact':     $text = ''; break;
                        default:
                            $text = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category();
                            break;
                    }
                break;
                case('page'):
                    $text = osc_highlight(strip_tags(osc_static_page_text()), 140) ;
                break;
                case('search'):
                    $result = '';

                    if( osc_count_items() == 0 ) {
                        $text = '';
                    }

                    if( osc_has_items() ) {
                        $result = osc_item_category() . ', ' . osc_highlight(strip_tags(osc_item_description()), 140) . '..., ' . osc_item_category();
                    }

                    osc_reset_items() ;
                    $text = $result ;
                break;
                default: // home
                    $text = osc_page_description() ;
                break;
            }
            
            $text = str_replace("\n", '', $text) ;
            $text = trim($text) ;
            $text = osc_esc_html($text) ;
            return $text ;
        }
    }

    if(!function_exists('mark_current_category_selected')){
        osc_add_hook('footer','mark_current_category_selected');
        function mark_current_category_selected(){
            echo '<script type="text/javascript">'.'$(\'select[name="sCategory"] option[value="'.Params::getParam("sCategory").'"]\').attr(\'selected\',\'selected\');</script>';
        }
    }

    if( !function_exists('osc_esc_js') ) {
        function osc_esc_js($str) {
            $str = htmlspecialchars($str, ENT_COMPAT) ;
            $str = str_replace("\r", '', $str) ;
            $str = str_replace("\n", '\\n', $str) ;
            $str = addslashes($str) ;

            return $str ;
        }
    }

    if( !function_exists('osc_esc_html') ) {
        function osc_esc_html($str = '') {
            if ($str === '') {
                return '';
            }

            $temp = '__TEMP_AMPERSANDS__';

            // Replace entities to temporary markers so that
            // htmlspecialchars won't mess them up
            $str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);
            $str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);

            $str = htmlspecialchars($str);

            // In case htmlspecialchars misses these.
            $str = str_replace(array("'", '"'), array("&#39;", "&quot;"), $str);

            // Decode the temp markers back to entities
            $str = preg_replace("/$temp(\d+);/","&#\\1;",$str);
            $str = preg_replace("/$temp(\w+);/","&\\1;",$str);

            return $str;
        }
    }

?>