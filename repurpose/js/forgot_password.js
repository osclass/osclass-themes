$(document).ready(function(){
    $("#new_password").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#new_password2").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doUserForgotPassword() {
    var error = false;
    if ( !text_validation($("#new_password")) ) {
        error =  true;
    }
    
    if ( !text_validation($("#new_password2")) ) {
        error =  true;
    }
    
    return !error;
}