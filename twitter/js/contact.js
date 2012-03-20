$(document).ready(function(){
    $("#subject").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("#message").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("#yourName").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("#yourEmail").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doContact() {
    var error = false;
    if ( !text_validation($("#subject")) ) {
        error =  true;
    }

    if ( !text_validation($("#message")) ) {
        error =  true;
    }

    if ( !text_validation($("#yourName")) ) {
        error =  true;
    }

    if ( !mail_validation($("#yourEmail")) ) {
        error =  true;
    }

    return !error;
}