$(document).ready(function(){
    $("form[name='contact_form'] .contact-yourName").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='contact_form'] .contact-yourEmail").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='contact_form'] .contact-phoneNumber").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='contact_form'] .contact-message").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doItemContact() {
    var error = false;
    if ( !text_validation($("form[name='contact_form'] .contact-yourName")) ) {
        error =  true;
    }

    if ( !mail_validation($("form[name='contact_form'] .contact-yourEmail")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='contact_form'] .contact-phoneNumber")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='contact_form'] .contact-message")) ) {
        error =  true;
    }

    return !error;
}