$(document).ready(function(){
    $("form[name='comment_form'] .comment-authorName").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='comment_form'] .comment-authorEmail").bind({
        "blur": function (e) {
            mail_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='comment_form'] .comment-title").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });

    $("form[name='comment_form'] .comment-body").bind({
        "blur": function (e) {
            text_validation($(this));
        },
        "focus": function (e) {
            $(this).parent().parent().removeClass('error') ;
            $(this).parent().find(".help-inline").remove() ;
        }
    });
});

function doComment() {
    var error = false;
    if ( !text_validation($("form[name='comment_form'] .comment-authorName")) ) {
        error =  true;
    }

    if ( !mail_validation($("form[name='comment_form'] .comment-authorEmail")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='comment_form'] .comment-title")) ) {
        error =  true;
    }

    if ( !text_validation($("form[name='comment_form'] .comment-body")) ) {
        error =  true;
    }

    return !error;
}