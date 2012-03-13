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

     $sQuery = __("ie. PHP Programmer", 'seeker');
?>
<?php
osc_add_hook('footer_js','fjs_search');
if(!function_exists('fjs_search')){
    function fjs_search(){
        echo "\n";
?>
    var sQuery = '<?php echo $sQuery; ?>' ;

    $(document).ready(function(){
     var sPattern = $('input[name=sPattern]');
        if(sPattern.val() == sQuery) {
            sPattern.css('color', 'gray');
        }
        sPattern.click(function(){
            if(sPattern.val() == sQuery) {
                sPattern.val('').css('color', '');
            }
        });
        sPattern.blur(function(){
            if(sPattern.val() == '') {
                sPattern.val(sQuery).css('color', 'gray');
            }
        });
        sPattern.keypress(function(){
            sPattern.css('background','');
        });
       var inputOriginalPaddings = parseInt(sPattern.css('padding-left'),10)+parseInt(sPattern.css('padding-right'),10);
       var inputOriginalSize     = parseInt(sPattern.width(),10)+inputOriginalPaddings;
        $('#sCategory').change(function(){
            var rightPadding = parseInt(sPattern.css('padding-left'),10);
            var selectWidth = parseInt($('#uniform-sCategory').outerWidth(),10)+inputOriginalPaddings;
            finalWidth = inputOriginalSize-selectWidth-rightPadding;
            sPattern.css({'width':finalWidth+'px','padding-right':selectWidth+'px'});
        });
    });
    function doSearch() {
        var sPattern = $('input[name=sPattern]');
        if(sPattern.val() == sQuery){
            return false;
        }
        if(sPattern.val().length < 3) {
            sPattern.css('background', '#FFC6C6');
            return false;
        }
        return true;
    }
<?php
    }
}
?>
<div id="main-search">
<form action="<?php echo osc_base_url(true) ; ?>" method="get" class="search" onsubmit="javascript:return doSearch();">
	<label for="query"><?php _e('I\'m looking for...','seeker'); ?></label>
    <input type="hidden" name="page" value="search" />
    <fieldset class="main">
        <input type="text" name="sPattern"  id="query" value="<?php echo ( osc_search_pattern() != '' ) ? osc_search_pattern() : $sQuery; ?>" />
        <?php  if ( osc_count_categories() ) { ?>
            <?php osc_categories_select('sCategory', null, __('Select a category', 'seeker')) ; ?>
        <?php  } ?>
    </fieldset>
    <button type="submit"><?php _e('Search', 'seeker') ; ?></button>
    <div class="clear"></div>
</form>
</div>