<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo meta_title() ; ?>" />
<meta name="description" content="<?php echo meta_description() ; ?>" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon.ico') ; ?>" />

<link href="<?php echo osc_current_web_theme_styles_url('style.css') ; ?>" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery-extends.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.validate.min.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('global.js') ; ?>"></script>

<?php osc_run_hook('header') ; ?>