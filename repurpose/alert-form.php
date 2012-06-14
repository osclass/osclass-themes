<script type="text/javascript">
    $(document).ready(function() {
        $(".alert-button").bind('click', function() {
            $.post("<?php echo osc_base_url(true); ?>", { email: $("#alert_email").val(), userid: $("#alert_userId").val(), alert: $("#alert").val(), page: "ajax", action: "alerts" }, 
                function(data) {
                    if(data == 1) {
                        alert("<?php _e('You have sucessfully subscribed to the alert', 'modern') ; ?>") ; 
                    } else if(data == -1) { 
                        alert("<?php _e('Invalid email address', 'twitter') ; ?>") ; 
                    } else {
                        alert("<?php _e('There was a problem with the alert', 'twitter') ; ?>") ;
                    }
                }
            );
            return false;
        }) ;
    }) ;
</script>
<h4><?php _e('Subscribe to this search', 'twitter') ; ?></h4>
<form action="<?php echo osc_base_url(true); ?>" method="post" name="sub_alert" id="sub_alert">
    <fieldset>
        <?php AlertForm::page_hidden() ; ?>
        <?php AlertForm::alert_hidden() ; ?>
        <?php if( osc_is_web_user_logged_in() ) { ?>
            <?php AlertForm::user_id_hidden() ; ?>
            <?php AlertForm::email_hidden() ; ?>
        <?php } else { ?>
            <?php AlertForm::user_id_hidden() ; ?>
            <input id="alert_email" type="text" name="alert_email" value="">
        <?php } ?>
        <button type="submit" class="btn alert-button" ><?php _e('Subscribe now!', 'twitter') ; ?></button>
    </fieldset>
</form>