<?php
$style = file_get_contents(WebThemes::newInstance()->getCurrentThemePath() . "style.css");
$customStyles = array();
$colors = seeker_dynamic_styles();
		if($colors){
			foreach($colors as $color){
					$customStyles['simple'][$color['key']] = osc_get_preference($color['key'],'seeker');
			}
}
$customStyles['simple']['@images'] = osc_current_web_theme_url('images');
$customStyles['advanced']['/@radius\((.*)\)/U'] = '-webkit-border-radius: $1; -moz-border-radius: $1; border-radius: $1';
$customStyles['advanced']['/@box\-shadow\((.*)\)/U'] = '-webkit-box-shadow: $1; -moz-box-shadow: $1; box-shadow: $1';

header("Content-type: text/css");
$style = preg_replace(array_keys($customStyles['advanced']),array_values($customStyles['advanced']), $style);
$style = str_replace(array_keys($customStyles['simple']),array_values($customStyles['simple']),$style);
echo $style;
?>