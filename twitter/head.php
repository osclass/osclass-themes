<meta charset="utf-8">
<!-- chrome frame -->
<meta http-equiv="X-UA-Compatible" content="chrome=1">

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo meta_title() ; ?>" />
<meta name="description" content="<?php echo meta_description() ; ?>" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- js -->
<?php
osc_enqueue_style('bootstrap', osc_current_web_theme_styles_url('bootstrap.min.css') );
osc_enqueue_style('custom', osc_current_web_theme_styles_url('custom.css') );
osc_enqueue_style('jquery-ui-datepicker', osc_assets_url('css/jquery-ui/jquery-ui.css'));
osc_enqueue_style('chosen-css', osc_current_web_theme_js_url('chosen/chosen.css') );


osc_register_script('global-theme-js', osc_current_web_theme_js_url('global.js'), 'jquery');
osc_register_script('chosen-js', osc_current_web_theme_js_url('chosen/chosen.jquery.min.js'), 'jquery');

osc_enqueue_script('jquery');
osc_enqueue_script('jquery-ui');
osc_enqueue_script('chosen-js');
osc_enqueue_script('global-theme-js');
osc_enqueue_script('php-date');

osc_run_hook('header') ; ?>