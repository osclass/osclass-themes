$(document).ready(function(){
    $("#s_name").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#s_password").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#s_password2").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
    
    $("#s_email").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doUserRegister() {
    var error = false;
    if ( !text_validation($("#s_name")) ) {
        error =  true;
    }
    
    if ( !text_validation($("#s_password")) ) {
        error =  true;
    }
    
    if ( !text_validation($("#s_password2")) ) {
        error =  true;
    }
    
    if ( !mail_validation($("#s_email")) ) {
        error =  true;
    }
    
    return !error;
}