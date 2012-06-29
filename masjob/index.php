<?php

/*
Theme Name: MasJob
Theme URI: http://osclass.org
Description: This theme is for job boards.
Version: 1.0.1
Author: OSClass team
Author URI: http://osclass.org
Widgets: header,categories,footer
Theme update URI: repurpose
*/

function masjob_theme_info() {
    $theme = array(
        'name'        => 'MasJob',
        'version'     => '1.0.1',
        'description' => 'This theme is for job boards.',
        'author_name' => 'OSClass team',
        'author_url'  => 'http://osclass.org',
        'locations'   => array('header', 'categories', 'footer')
    ) ;

    return $theme ;
}

?>
