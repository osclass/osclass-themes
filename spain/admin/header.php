<style type="text/css" media="screen">
    .command { background-color: white; color: #2E2E2E; border: 1px solid black; padding: 8px; }
    .theme-files { min-width: 500px; }
</style>
<h2 class="render-title"><?php _e('Header logo'); ?></h2>
<?php if( is_writable( WebThemes::newInstance()->getCurrentThemePath() . "images/") ) { ?>
    <?php if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
        <h3 class="render-title"><?php _e('Preview') ?></h3>
        <img border="0" alt="<?php echo osc_esc_html( osc_page_title() ); ?>" src="<?php echo osc_current_web_theme_url('images/logo.jpg');?>" />
        <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/spain/admin/header.php');?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action_specific" value="remove" />
            <fieldset>
                <div class="form-horizontal">
                    <div class="form-actions">
                        <input id="button_remove" type="submit" value="<?php echo osc_esc_html(__('Remove logo','spain')); ?>" class="btn btn-red">
                    </div>
                </div>
            </fieldset>
        </form>
    </p>
    <?php } else { ?>
        <div class="flashmessage flashmessage-warning flashmessage-inline" style="display: block;">
            <p><?php _e("There isn't any logo uploaded yet", 'spain'); ?></p>
        </div>
    <?php } ?>
    <h2 class="render-title separate-top"><?php _e('Upload logo') ?></h2>
    <p>
        <?php _e('The preferred size of the logo is 600x100.', 'spain'); ?>
        <?php if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) { ?>
        <?php _e('<strong>Note:</strong> Uploading another logo will overwrite the current logo.', 'spain'); ?>
        <?php } ?>
    </p>
    <form action="<?php echo osc_admin_render_theme_url('oc-content/themes/spain/admin/header.php'); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action_specific" value="upload_logo" />
        <fieldset>
            <div class="form-horizontal">
                <div class="form-row">
                    <div class="form-label"><?php _e('Logo image (png,gif,jpg)','spain'); ?></div>
                    <div class="form-controls">
                        <input type="file" name="logo" id="package" />
                    </div>
                </div>
                <div class="form-actions">
                    <input id="button_save" type="submit" value="<?php echo osc_esc_html(__('Upload','spain')); ?>" class="btn btn-submit">
                </div>
            </div>
        </fieldset>
    </form>
<?php } else { ?>
    <div class="flashmessage flashmessage-error" style="display: block;">
        <p>
            <?php
                $msg  = sprintf(__('The images folder <strong>%s</strong> is not writable on your server', 'spain'), WebThemes::newInstance()->getCurrentThemePath() ."images/" ) .", ";
                $msg .= __("OSClass can't upload logo image from the administration panel.", 'spain') . ' ';
                $msg .= __('Please make the mentioned image folder writable.', 'spain') . ' ';
                echo $msg;
            ?>
        </p>
        <p>
            <?php _e('To make a directory writable under UNIX execute this command from the shell:','spain'); ?>
        </p>
        <p class="command">
            chmod a+w <?php echo WebThemes::newInstance()->getCurrentThemePath() ."images/" ; ?>
        </p>
    </div>
<?php } ?>