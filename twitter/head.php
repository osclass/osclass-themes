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

<!-- css -->
<link rel="stylesheet" type="text/css" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_js_url('chosen/chosen.css') ; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_styles_url('custom.css') ; ?>" />

<!-- js -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('global.js') ; ?>"></script>
<script type="text/javascript" src="<?php echo osc_current_web_theme_js_url('chosen/chosen.min.js') ; ?>"></script>

<?php osc_run_hook('header') ; ?>