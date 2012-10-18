<?php

/*
Theme Name: NewCorp
Theme URI: http://osclass.org
Description: This is the OSClass theme for a job board.
Version:  2.3.2
Author: OSClass Team
Author URI: http://osclass.org
Widgets: header,categories
Theme update URI: newcorp
*/

    function newcorp_theme_info() {
        $theme = array(
            'name'         => 'NewCorp'
            ,'version'     => '2.3.2'
            ,'description' => 'This is the OSClass theme for a job board.'
            ,'author_name' => 'OSClass Team'
            ,'author_url'  => 'http://osclass.org'
            ,'locations'   => array('header', 'categories')
        );

        return $theme;
    }

?>