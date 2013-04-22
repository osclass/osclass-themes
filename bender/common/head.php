<?php
osc_enqueue_script('jquery');
osc_enqueue_script('jquery-ui');
osc_register_script('global-theme-js', osc_current_web_theme_js_url('global.js'));
osc_enqueue_script('global-theme-js');
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if( meta_description() != '' ) { ?>
<meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if( meta_keywords() != '' ) { ?>
<meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<!-- canonical -->
<?php if( osc_get_canonical() != '' ) { ?>
<link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/>
<?php } ?>
<!-- /canonical -->
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<link href="<?php echo osc_current_web_theme_url('css/main.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo osc_current_web_theme_url('js/jquery-ui/jquery-ui-1.10.2.custom.min.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" rel="stylesheet" type="text/css" />


<?php osc_run_hook('header') ; ?>