$(document).ready(function(){
    $("#new_email").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doUserChangeEmail() {
    var error = false;
    if ( !mail_validation($("#new_email")) ) {
        error =  true;
    }
    
    return !error;
}