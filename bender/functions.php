<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2013 OSCLASS
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

/**

DEFINES

*/
    define('bender_THEME_VERSION', '1.0');
    if(!osc_get_preference('keyword_placeholder','bender')){
        osc_set_preference('keyword_placeholder',__('Luxury Villas'),'bender');
    }
    osc_register_script('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.pack.js'), array('jquery'));
    osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('fancybox');




/**

FUNCTIONS

*/

    // install update options
    if( !function_exists('benderBodyClass_theme_install') ) {
        function bender_theme_install() {
            osc_set_preference('keyword_placeholder', __('ie. PHP Programmer', 'bender'), 'bender');
            osc_set_preference('version', bender_THEME_VERSION, 'bender');
            osc_set_preference('footer_link', true, 'bender');
            osc_set_preference('donation', '0', 'bender');
            osc_set_preference('default_logo', '1', 'bender');
            osc_reset_preferences();
        }
    }

    if(!function_exists('check_install_bender_theme')) {
        function check_install_bender_theme() {
            $current_version = osc_get_preference('version', 'bender');
            //check if current version is installed or need an update<
            if( !$current_version ) {
                bender_theme_install();
            }
        }
    }

    if(!function_exists('moder2_add_body_class_construct')) {
        function moder2_add_body_class_construct($classes){
            $benderBodyClass = benderBodyClass::newInstance();
            $classes = array_merge($classes, $benderBodyClass->get());
            return $classes;
        }
    }
    if(!function_exists('moder2_boddy_class')) {
        function moder2_boddy_class($echo = true){
            /**
            * Print body classes.
            *
            * @param string $echo Optional parameter.
            * @return print string with all body classes concatenated
            */
            osc_add_filter('bender_bodyClass','moder2_add_body_class_construct');
            $classes = osc_apply_filter('bender_bodyClass', array());
            if($echo && count($classes)){
                echo 'class="'.implode(' ',$classes).'"';
            } else {
                return $classes;
            }
        }
    }
    if(!function_exists('moder2_add_boddy_class')) {
        function moder2_add_boddy_class($class){
            /**
            * Add new body class to body class array.
            *
            * @param string $class required parameter.
            */
            $benderBodyClass = benderBodyClass::newInstance();
            $benderBodyClass->add($class);
        }
    }
    if(!function_exists('bender_nofollow_construct')) {
        /**
        * Hook for header, meta tags.
        */
        function bender_nofollow_construct(){
            echo '<meta name="robots" content="noindex, nofollow, noarchive" />';
            echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />';

        }
    }
    if(!function_exists('bender_nofollow')) {
        /**
        * Add nofollow, noindex, noarchive meta tags in header.
        */
        function bender_nofollow(){
            osc_add_hook('header','bender_nofollow_construct');
        }
    }
    /* logo */
    if( !function_exists('logo_header') ) {
        function logo_header() {
             $html = '<a href="'.osc_base_url().'"><img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '"></a>';
             if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . 'images/logo.jpg' ) ) {
                return $html;
             } else {
                return '<a href="'.osc_base_url().'">'.osc_page_title().'</a>';
            }
        }
    }
    if( !function_exists('bender_draw_item') ) {
        function bender_draw_item($class = false,$admin = false) {
            $size = explode('x', osc_thumbnail_dimensions());
    ?>
            <li class="listing-card <?php echo $class; ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if(osc_count_item_resources()) { ?>
                        <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_item_title() ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } else { ?>
                        <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_item_title() ; ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } ?>
                <?php } ?>
                <div class="listing-detail">
                    <div class="listing-cell">
                        <div class="listing-data">
                            <div class="listing-basicinfo">
                                <a href="<?php echo osc_item_url() ; ?>" class="title" title="<?php echo osc_item_title() ; ?>"><?php echo osc_item_title() ; ?></a>
                                <div class="listing-attributes">
                                    <a class="category" href="<?php echo osc_item_category() ; ?>" title="<?php echo osc_item_category() ; ?>"><?php echo osc_item_category() ; ?></a>
                                    <span class="location"><a href="<?php echo osc_search_url(array('sCity' => osc_item_city())); ?>"><?php echo osc_item_city(); ?></a> (<a href="<?php echo osc_search_url(array('sRegion' => osc_item_region())); ?>"><?php echo osc_item_region(); ?></a>)</span> <span class="g-hide">-</span> <?php echo osc_format_date(osc_item_pub_date()); ?>
                                    <?php if( osc_price_enabled_at_items() ) { ?><span class="currency-value"><?php echo osc_format_price(osc_item_price()); ?></span><?php } ?>
                                </div>
                                <p><?php echo osc_highlight( strip_tags( osc_item_description()) ,250) ; ?></p>
                            </div>
                            <?php if($admin){ ?>
                                EDITTT
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </li>
<?php
        }
    }
    if( !function_exists('bender_draw_categories_list') ) {
        function bender_draw_categories_list(){ ?>
        <?php if(!osc_is_home_page()){ echo '<div class="resp-wrapper">'; } ?>
        <ul class="r-list">
         <?php
         osc_goto_first_category();
         $i= 0;
         while ( osc_has_categories() ) {
            $liClass = '';
            if($i%3 == 0){
                $liClass = 'clear';
            }
            $i++;
         ?>
             <li<?php if($liClass){ echo " class='$liClass'"; } ?>>
                 <h1><a class="category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></h1>
                 <?php /**/if ( osc_count_subcategories() > 0 ) { ?>
                   <ul>
                         <?php while ( osc_has_subcategories() ) { ?>
                             <li><a class="category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></li>
                         <?php } ?>
                   </ul>
                 <?php } ?>
             </li>
        <?php } ?>
        </ul>
        <?php if(!osc_is_home_page()){ echo '</div>'; } ?>
        <?php
        }
    }
    if( !function_exists('bender_search_number') ) {
        /**
          *
          * @return array
          */
        function bender_search_number() {
            $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
            $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
            if( $search_to > osc_search_total_items() ) {
                $search_to = osc_search_total_items();
            }

            return array(
                'from' => $search_from,
                'to'   => $search_to,
                'of'   => osc_search_total_items()
            );
        }
    }
    /*
     * Helpers used at view
     */
    if( !function_exists('bender_item_title') ) {
        function bender_item_title() {
            $title = osc_item_title();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('title') != "" ) {
                    $title_ = Session::newInstance()->_getForm('title');
                    if( $title_[$locale['pk_c_code']] != "" ){
                        $title = $title_[$locale['pk_c_code']];
                    }
                }
            }
            return $title;
        }
    }
    if( !function_exists('bender_item_description') ) {
        function bender_item_description() {
            $description = osc_item_description();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('description') != "" ) {
                    $description_ = Session::newInstance()->_getForm('description');
                    if( $description_[$locale['pk_c_code']] != "" ){
                        $description = $description_[$locale['pk_c_code']];
                    }
                }
            }
            return $description;
        }
    }
    if( !function_exists('related_listings') ) {
        function related_listings() {
            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addRegion(osc_item_region());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) > 0 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
                return $iTotalItems;
            }
            unset($mSearch);

            return 0;
        }
    }
    function theme_bender_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/bender/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'bender_theme');
                osc_reset_preferences();
            }
        }

        switch( Params::getParam('action_specific') ) {
            case('settings'):
                $footerLink  = Params::getParam('footer_link');
                $defaultLogo = Params::getParam('default_logo');
                osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender_theme');
                osc_set_preference('footer_link', ($footerLink ? '1' : '0'), 'bender_theme');
                osc_set_preference('default_logo', ($defaultLogo ? '1' : '0'), 'bender_theme');

                osc_add_flash_ok_message(__('Theme settings updated correctly', 'bender'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender/admin/settings.php'));
            break;
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'bender'), 'admin');
                    } else {
                        osc_add_flash_error_message(__("An error has occurred, please try again", 'bender'), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'bender'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender/admin/header.php'));
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message(__('The logo image has been removed', 'bender'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'bender'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender/admin/header.php'));
            break;
        }
    }
    osc_add_hook('init_admin', 'theme_bender_actions_admin');
    osc_admin_menu_appearance(__('Header logo', 'bender'), osc_admin_render_theme_url('oc-content/themes/bender/admin/header.php'), 'header_bender');
    osc_admin_menu_appearance(__('Theme settings', 'bender'), osc_admin_render_theme_url('oc-content/themes/bender/admin/settings.php'), 'settings_bender');
/**

TRIGGER FUNCTIONS

*/
check_install_bender_theme();
if(osc_is_home_page()){
    osc_add_hook('inside-main','bender_draw_categories_list');
} else {
    osc_add_hook('before-content','bender_draw_categories_list');
}

if(osc_is_home_page() || osc_is_search_page()){
    moder2_add_boddy_class('has-searchbox');
}


/**

CLASSES

*/
class benderBodyClass
{
    /**
    * Custom Class for add, remove or get body classes.
    *
    * @param string $instance used for singleton.
    * @param array $class.
    */
    private static $instance;
    private $class;

    private function __construct()
    {
        $this->class = array();
    }

    public static function newInstance()
    {
        if (  !self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function add($class)
    {
        $this->class[] = $class;
    }
    public function get()
    {
        return $this->class;
    }
}
?>