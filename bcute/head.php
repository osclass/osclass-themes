<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo meta_title() ; ?>" />
<meta name="description" content="<?php echo meta_description() ; ?>" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<link href="<?php echo osc_current_web_theme_styles_url('style.css') ; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo osc_current_web_theme_styles_url('tabs.css') ; ?>" rel="stylesheet" type="text/css" />

<script>
    var fileDefaultText = '<?php _e('No file selected','bcute'); ?>';
    var fileBtnText     = '<?php _e('Choose File','bcute'); ?>';
</script>

<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery-ui.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('jquery.uniform.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('global.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('tabber-minimized.js') ; ?>"></script>

<?php osc_run_hook('header') ; ?>