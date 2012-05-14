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
    //Preferences
    if(!osc_get_preference('keyword_placeholder','realestate')){
        osc_set_preference('keyword_placeholder',__('Luxury Villas'),'realestate');
    }
    function item_realestate_attributes(){
        //get_realestate_attributes
        if(function_exists('get_realestate_attributes')){
            $data = get_realestate_attributes();
            $print = array();
            if(isset($data['attributes']['property_type'])){
                $print[] = $data['attributes']['property_type']['value'];
            }
            if(isset($data['attributes']['plot_area'])){
                $print[] = $data['attributes']['plot_area']['value'].' m<sup>2</sup>';
            }
            if($print){
                echo join('<br />',$print);
            }
        }
        return false;
    }
    function multilanguage_form_input_text($locale,$field){
        $name = str_replace('%locale%',$locale['pk_c_code'],$field['name']);
        echo '<input id="'.$name.'" type="text" name="'.$name.'" value="'.osc_esc_html(htmlentities($field['value'][$locale['pk_c_code']], ENT_COMPAT, "UTF-8")).'" '.$fields['args'].' />' ;
    }
    function multilanguage_form_input_textarea($locale,$field){
        $name = str_replace('%locale%', $locale['pk_c_code'], $field['name']);
        $txt = '' ;
        if( array_key_exists('value', $field) ) {
            if( array_key_exists($locale['pk_c_code'], $field['value']) ) {
                $txt = $field['value'][$locale['pk_c_code']];
            }
        }
        echo '<textarea id="'.$name.'" name="'.$name.'" '.$fields['args'].'>'.$txt.'</textarea>';
    }
    function multilanguage_form_input_select($locale,$field){
        $name = str_replace('%locale%',$locale['pk_c_code'],$field['name']);
        echo '<select id="'.$name.'" name="'.$name.'" '.$fields['args'].'>';
             if($field['options'][$locale['pk_c_code']]){
                 foreach($field['options'][$locale['pk_c_code']] as $option){
                    echo '<option value="'.$option['value'].'">'.$option['label'].'</option>';
                 }
             }
        echo '</select>';
    }
    function multilanguage_form_label($locale,$field){
        $required = '';
        if($field['required']){
            if($field['required']==true){
                $required = '*';
            }
        }
        $name = str_replace('%locale%',$locale['pk_c_code'],$field['name']);
        echo '<label for="'.$name.']">' . $field['label'] .$required. '</label>';
    }
    function multilanguage_form_create_field($locale,$field,$label = true){
        if(!isset($field['args'])){
            $fields['args'] = '';
        }
        if(!isset($field['value'][$locale['pk_c_code']])){
            $fields['value'][$locale['pk_c_code']] = '';
        }
        if($label){
            multilanguage_form_label($locale,$field);
        }
        call_user_func_array('multilanguage_form_input_'.$field['type'],array($locale,$field));
    }
    function multilanguage_form($fields) {
            $locales = osc_get_locales();
            $item = osc_item();
            $num_locales = count($locales);
            
            foreach($locales as $locale) {
                foreach($fields as $field){
                    if($num_locales > 1){
                        echo '<div class="switch-locale locale-'.$locale['pk_c_code'].'">';
                    }
                    multilanguage_form_create_field($locale,$field);
                    if($num_locales > 1){
                        echo '</div>';
                    }
                }
             }
    }
    if( !OC_ADMIN ) {
        if( !function_exists('add_close_button_fm') ) {
            function add_close_button_fm($message){
                return $message.'<a class="close">×</a>' ;
            }
            osc_add_filter('flash_message_text', 'add_close_button_fm') ;
        }
        if( !function_exists('add_close_button_action') ) {
            function add_close_button_action(){
                echo '<script type="text/javascript">';
                    echo '$(".FlashMessage .close").click(function(){';
                        echo '$(this).parent().hide();';
                    echo '});';
                echo '</script>';
            }
            osc_add_hook('footer', 'add_close_button_action') ;
        }
    }

    if( !function_exists('get_gravatar') ) {
        function get_gravatar($email = null, $size = 65) {
            $email = md5( strtolower( trim( $email ) ) );
            $default = urlencode( osc_current_web_theme_url('images/avatar.png') );
            return "http://www.gravatar.com/avatar/$email?s=$size&d=$default";
            // "0bc83cb571cd1c50ba6f3e8a78ef1346"
        }
    }
    if( !function_exists('logo_header') ) {
        function logo_header() {

             $html = '<a id="logo" href="' . osc_base_url() . '"><img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '" /></a>';
             if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                return $html;
             } else {
                return '<a id="logo" class="logo-text" href="' . osc_base_url() . '">' . osc_page_title() . '</a>';

            }
        }
    }
    if( !function_exists('logo_footer') ) {
        function logo_footer() {

             $html = '<a id="logo-footer" href="' . osc_base_url() . '"><img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo-footer.jpg') . '" /></a>';
             if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" ) ) {
                return $html;
             } else {
                return '<a id="logo-footer" class="logo-footer-text" href="' . osc_base_url() . '">' . osc_page_title() . '</a>';

            }
        }
    }

    if( !function_exists('realestate_theme_admin_menu') ) {
        function realestate_theme_admin_menu() {
            echo '<h3><a href="#">'. __('Realstate theme','realestate') .'</a></h3>
            <ul>
                <li><a href="' . osc_admin_render_theme_url('oc-content/themes/realestate/admin/admin_settings.php') . '">&raquo; '.__('Settings theme', 'realestate').'</a></li>
            </ul>';
        }

        osc_add_hook('admin_menu', 'realestate_theme_admin_menu');
    }
    $sQuery = osc_get_preference('keyword_placeholder','realestate') ;
    osc_add_hook('footer','fjs_search');
    if(!function_exists('fjs_search')){
        function fjs_search(){
            echo "\n";
    ?>
    <script type="text/javascript">
    var sQuery = '<?php echo osc_esc_js( osc_get_preference('keyword_placeholder','realestate') ) ; ?>' ;
    $(document).ready(function(){
                var element = $('input[name="sPattern"]');
                element.focus(function(){
                        $(this).prev().hide();
                }).blur(function(){
                    if($(this).val() == '') {
                        $(this).prev().show();
                    }
                }).prev().click(function(){
                        $(this).hide();
                        $(this).next().focus();
                });
                if(element.val() != ''){
                    element.prev().hide();
                }
            });
    function doSearch() {
        var sPattern = $('input[name=sPattern]');
        if(sPattern.val() == ''){
            return false;
        }
        return true;
    }
    </script>
    <?php
        }
    }
?>