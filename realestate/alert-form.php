<script type="text/javascript">
$(document).ready(function(){
    $(".sub_button").click(function(){
        $.post('<?php echo osc_base_url(true); ?>', {email:$("#alert_email").val(), userid:$("#alert_userId").val(), alert:$("#alert").val(), page:"ajax", action:"alerts"}, 
            function(data){
                if(data==1) { alert('<?php _e('You have sucessfully subscribed to the alert', 'realestate'); ?>'); }
                else if(data==-1) { alert('<?php _e('Invalid email address', 'realestate'); ?>'); }
                else { alert('<?php _e('There was a problem with the alert', 'realestate');?>');
                };
        });
        return false;
    });

    var sQuery = '<?php echo AlertForm::default_email_text() ; ?>' ;

    if($('input[name=alert_email]').val() == sQuery) {
        $('input[name=alert_email]').css('color', 'gray');
    }
    $('input[name=alert_email]').click(function(){
        if($('input[name=alert_email]').val() == sQuery) {
            $('input[name=alert_email]').val('');
            $('input[name=alert_email]').css('color', '');
        }
    });
    $('input[name=alert_email]').blur(function(){
        if($('input[name=alert_email]').val() == '') {
            $('input[name=alert_email]').val(sQuery);
            $('input[name=alert_email]').css('color', 'gray');
        }
    });
    $('input[name=alert_email]').keypress(function(){
        $('input[name=alert_email]').css('background','');
    })
});
</script>
<div class="ui-generic-form alert-form">
    <div class="ui-generic-form-content">
    <h3><?php _e('Subscribe to this search', 'realestate'); ?></h3>
    <form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert">
        <fieldset>
            <?php AlertForm::page_hidden(); ?>
            <?php AlertForm::alert_hidden(); ?>

            <?php if(osc_is_web_user_logged_in()) { ?>
                <?php AlertForm::user_id_hidden(); ?>
                <?php AlertForm::email_hidden(); ?>

            <?php } else { ?>
                <?php AlertForm::user_id_hidden(); ?>
                <?php AlertForm::email_text(); ?>

            <?php }; ?>
            <a href="#" class="ui-button ui-button-grey js-submit"><?php _e('Subscribe now', 'realestate'); ?>!</a>
        </fieldset>
    </form>
    </div>
</div>