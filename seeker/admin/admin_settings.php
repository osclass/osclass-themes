<?php
    if(Params::getParam("action_specific")!='') {
        switch(Params::getParam("action_specific")) {
            case('upload_logo'):
                $package = Params::getFiles("logo");
                
                if ($package['error'] == UPLOAD_ERR_OK) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ){
                        osc_add_flash_ok_message( _m('The logo image has been uploaded correctly'), 'admin');
                    } else {
                        osc_add_flash_error_message( _m("An error has occurred, please try again"), 'admin');
                    }
                } else {
                    osc_add_flash_error_message( _m("An error has occurred, please try again"), 'admin');
                }
            break;
            case('update_colors'):
            	$colorsParams = Params::getParam("color");
            	if($colorsParams){
            		foreach($colorsParams as $key=>$value){
            		
            			osc_set_preference($key,$value,'seeker');
            		}
            	}            	
            break;
            case('reset_default_colors'):
            	$dynamic_styles = seeker_dynamic_styles();
    			if($dynamic_styles){
					foreach($dynamic_styles as $d_style){
							osc_set_preference($d_style['key'],$d_style['value'],'seeker');
					}
				}
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message( _m('The logo image has been removed'), 'admin');
                }else{
                    osc_add_flash_error_message( _m("Image not found"), 'admin');
                }
            break;
            case('update_placeholder'):
                osc_set_preference('keyword_placeholder',Params::getParam("placeholder"),'seeker');
            break;
        }
    }
    osc_reset_preferences();
?>
    <?php osc_show_flash_message('admin') ; ?>
	<link rel="stylesheet" media="screen" type="text/css" href="<?php echo osc_current_web_theme_url('admin/css/colorpicker.css');?>" />
	<script type="text/javascript" src="<?php echo osc_current_web_theme_url('admin/js/colorpicker.js');?>"></script>
	
    <div id="settings_form" style="border: 1px solid #ccc; background: #eee; padding: 20px;">

            <?php if(is_writable( WebThemes::newInstance()->getCurrentThemePath() ."images/") )  { ?>

            <p style="border-bottom: 1px black solid;padding-bottom: 10px;">
                <img style="padding-right: 10px;"src="<?php echo osc_current_admin_theme_url('images/info-icon.png') ; ?>"/>
                <?php _e('The preferred size of the logo is 600x100','seeker'); ?>.
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
                <strong><?php _e('Note: Uploading another logo will overwrite current logo','seeker'); ?>.</strong>
                <?php } ?>
            </p>

            <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action_specific" value="upload_logo" />
                <p>
                    <label for="package"><?php _e('Logo image','seeker'); ?> (png,gif,jpg)</label>
                    <input type="file" name="logo" id="package" />
                </p>
                <input id="button_save" type="submit" value="<?php _e('Upload','seeker'); ?>" />
            </form>
            <div>
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {?>
                <p>
                    Preview:<br>
                    <img border="0" alt="<?php echo osc_page_title(); ?>" src="<?php echo osc_current_web_theme_url('images/logo.jpg');?>"/>
                    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action_specific" value="remove" />
                        <input id="button_remove" type="submit" value="<?php _e('Remove logo','seeker'); ?>" />
                    </form>
                </p>
                <?php } else { ?>
                    <p><?php _e('Has not uploaded any logo image','seeker');?></p>
                <?php } ?>
            </div>
            <div style="clear: both;"></div>

            <?php } else { ?>

            <div id="flash_message">
                <p>
                    <?php
                        $msg  = sprintf(__('The images folder %s is not writable on your server','seeker'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) .", ";
                        $msg .= __('OSClass can\'t upload logo image from the administration panel','seeker') . '. ';
                        $msg .= __('Please make the mentioned images folder writable','seeker') . '.';
                        echo $msg;
                    ?>
                </p>
                <p>
                    <?php _e('To make a directory writable under UNIX execute this command from the shell','seeker'); ?>:
                </p>
                <p style="background-color: white; border: 1px solid black; padding: 8px;">
                    chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() ."images/" ; ?>
                </p>
            </div>
            
            <?php } ?>
	</div>
	
	<div id="settings_form_color" style="border: 1px solid #ccc; background: #eee; margin-top:15px; padding:20px;">
		<form action="<?php echo osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php');?>" method="post">
		<?php
		$dynamic_styles = seeker_dynamic_styles();
		if($dynamic_styles){
			foreach($dynamic_styles as $d_style){
					echo '<label>'.$d_style['name'].'</label><div class="colorSelector" style="background-color:'.osc_get_preference($d_style['key'],'seeker').'"><input type="hidden" name="color['.$d_style['key'].']" value="'.osc_get_preference($d_style['key'],'seeker').'"/></div>';
			}
		}
		?>
			<input type="hidden" name="action_specific" value="update_colors" />
			<input id="button_remove" type="submit" value="<?php _e('Update colors','seeker'); ?>" />
        </form>
        <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php');?>" method="post">
			<input type="hidden" name="action_specific" value="reset_default_colors" />
			<input id="button_remove" type="submit" value="<?php _e('Reset default colors','seeker'); ?>" />
        </form>
        
	</div>
	<script type="text/javascript">
	var colors = new Array();
	<?php
	$dynamic_styles = seeker_dynamic_styles();
		if($dynamic_styles){
			foreach($dynamic_styles as $d_style){
					echo "colors.push(\"".osc_get_preference($d_style['key'],'seeker')."\");\n";
			}
		}
	?>
	//colors[$('.colorSelector').index(colorSelector)]
	$('.colorSelector').each(function(){
		var colorSelector = $(this);
			colorSelector.ColorPicker({
			color: colors[$('.colorSelector').index(colorSelector)],
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				colorSelector.css('backgroundColor', '#' + hex);
				colorSelector.find('input').val('#' + hex);
			}
		});
	});
	</script>

    <div id="settings_placeholder" style="border: 1px solid #ccc; background: #eee; margin-top:15px; padding:20px;">
        <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/seeker/admin/admin_settings.php');?>" method="post">
            <input type="hidden" name="action_specific" value="update_placeholder" />
            <input type="text" name="placeholder" value="<?php echo osc_get_preference('keyword_placeholder','seeker'); ?>">
            <input id="button_remove" type="submit" value="<?php _e('Update placeholder','seeker'); ?>" />
        </form>        
    </div>