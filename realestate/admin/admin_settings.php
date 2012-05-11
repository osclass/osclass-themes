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
            case('upload_logo_footer'):
                $package = Params::getFiles("logo");
                
                if ($package['error'] == UPLOAD_ERR_OK) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" ) ){
                        osc_add_flash_ok_message( _m('The logo image has been uploaded correctly'), 'admin');
                    } else {
                        osc_add_flash_error_message( _m("An error has occurred, please try again"), 'admin');
                    }
                } else {
                    osc_add_flash_error_message( _m("An error has occurred, please try again"), 'admin');
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
            case('footer_remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" ) ) {
                    unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" );
                    osc_add_flash_ok_message( _m('The logo image has been removed'), 'admin');
                }else{
                    osc_add_flash_error_message( _m("Image not found"), 'admin');
                }

            break;
        }
    }
?>
    <?php osc_show_flash_message('admin') ; ?>
                <?php if(is_writable( WebThemes::newInstance()->getCurrentThemePath() ."images/") )  { ?>

    
    <div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
        <div style="padding: 20px;">
            <p style="border-bottom: 1px black solid;padding-bottom: 10px;">
                <img style="padding-right: 10px;"src="<?php echo osc_current_admin_theme_url('images/info-icon.png') ; ?>"/>
                <?php _e('The preferred size of the logo is 400x95','realestate'); ?>.
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
                <strong><?php _e('Note: Uploading another logo will overwrite current logo','realestate'); ?>.</strong>
                <?php } ?>
            </p>

            <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/realestate/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action_specific" value="upload_logo" />
                <p>
                    <label for="package"><?php _e('Logo image','realestate'); ?> (png,gif,jpg)</label>
                    <input type="file" name="logo" id="package" />
                </p>
                <input id="button_save" type="submit" value="<?php _e('Upload','realestate'); ?>" />
            </form>
            <div>
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {?>
                <p>
                    Preview:<br>
                    <img border="0" alt="<?php echo osc_page_title(); ?>" src="<?php echo osc_current_web_theme_url('images/logo.jpg');?>"/>
                    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/realestate/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action_specific" value="remove" />
                        <input id="button_remove" type="submit" value="<?php _e('Remove logo','realestate'); ?>" />
                    </form>
                </p>
                <?php } else { ?>
                    <p><?php _e('Has not uploaded any logo image','realestate');?></p>
                <?php } ?>
            </div>
        </div>   
    </div>

    <div id="settings_form" style="border: 1px solid #ccc; background: #eee; margin-top:20px; ">
        <div style="padding: 20px;">
            <p style="border-bottom: 1px black solid;padding-bottom: 10px;">
                <img style="padding-right: 10px;"src="<?php echo osc_current_admin_theme_url('images/info-icon.png') ; ?>"/>
                <?php _e('The preferred size of the logo for footer is 300x75','realestate'); ?>.
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" ) ) { ?>
                <strong><?php _e('Note: Uploading another logo will overwrite current footer logo','realestate'); ?>.</strong>
                <?php } ?>
            </p>

            <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/realestate/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action_specific" value="upload_logo_footer" />
                <p>
                    <label for="package"><?php _e('Logo image for footer','realestate'); ?> (png,gif,jpg)</label>
                    <input type="file" name="logo" id="package" />
                </p>
                <input id="button_save" type="submit" value="<?php _e('Upload','realestate'); ?>" />
            </form>
            <div>
                <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo-footer.jpg" ) ) {?>
                <p>
                    Preview:<br>
                    <img border="0" alt="<?php echo osc_page_title(); ?>" src="<?php echo osc_current_web_theme_url('images/logo-footer.jpg');?>"/>
                    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/realestate/admin/admin_settings.php');?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action_specific" value="footer_remove" />
                        <input id="button_remove" type="submit" value="<?php _e('Remove logo footer','realestate'); ?>" />
                    </form>
                </p>
                <?php } else { ?>
                    <p><?php _e('Has not uploaded any logo image for footer','realestate');?></p>
                <?php } ?>
            </div>
        </div>   
    </div>
    

            <div style="clear: both;"></div>

            <?php } else { ?>

            <div id="flash_message">
                <p>
                    <?php
                        $msg  = sprintf(__('The images folder %s is not writable on your server','realestate'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) .", ";
                        $msg .= __('OSClass can\'t upload logo image from the administration panel','realestate') . '. ';
                        $msg .= __('Please make the mentioned images folder writable','realestate') . '.';
                        echo $msg;
                    ?>
                </p>
                <p>
                    <?php _e('To make a directory writable under UNIX execute this command from the shell','realestate'); ?>:
                </p>
                <p style="background-color: white; border: 1px solid black; padding: 8px;">
                    chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() ."images/" ; ?>
                </p>
            </div>
            
            <?php } ?>
        