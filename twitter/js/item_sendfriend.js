$(document).ready(function(){
    $("form[name='sendfriend'] .sendfriend-yourName").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='sendfriend'] .sendfriend-yourEmail").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='sendfriend'] .sendfriend-friendName").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='sendfriend'] .sendfriend-friendEmail").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='sendfriend'] .sendfriend-message").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doItemSendFriend() {
    var error = false;
    if ( !text_validation($("form[name='sendfriend'] .sendfriend-yourName")) ) {
        error =  true;
    }

    if ( !mail_validation($("form[name='sendfriend'] .sendfriend-yourEmail")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='sendfriend'] .sendfriend-friendName")) ) {
        error =  true;
    }

    if ( !mail_validation($("form[name='sendfriend'] .sendfriend-friendEmail")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='sendfriend'] .sendfriend-message")) ) {
        error =  true;
    }

    return !error;
}