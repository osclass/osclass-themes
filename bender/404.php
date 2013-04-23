<?php
    // meta tag robots
    osc_add_hook('header','bender_nofollow_construct');

    bender_add_boddy_class('error');
    osc_current_web_theme_path('header.php') ;
?>
<div class="content error">
    <h1><?php _e('Page not found', 'bender'); ?></h1>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>