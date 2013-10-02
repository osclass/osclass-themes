var twitter_theme = window.twitter_theme || {} ;

try { console.log('init console... done') ; } catch(e) { console = { log: function() {} } }

$(document).ready(function(){
    // Dropdown languages
    // ===============================
    $(".login_nav ul li.languages").hover(
        function(){
            $(this).find("ul").show();
        },
        function(){
            $(this).find("ul").hide();
        }
    );
	// Dropdown topbar nav
    // ===============================
    $("body").bind("click", function (e) {
        $('a.menu').parent("li").removeClass("open");
    });
    $("a.menu").click(function (e) {
		$('a.menu').parent("li").removeClass("open");
        var $li = $(this).parent("li").toggleClass('open');
        return false;
    });
    // Close alerts
    // ===============================
    $(".alert-message .close").bind("click", function(e) {
       $(this).parent().fadeOut('slow');
    });
    // Close item contact modal
    // ===============================
    $(".item-contact .close").bind("click", function(e) {
       $(this).parent().parent().parent().fadeOut('slow');
    });
    $(".item-sendfriend .close").bind("click", function(e) {
       $(this).parent().parent().parent().fadeOut('slow');
    });
    // Select with choosen
    // ===============================
    if($(".chosen-select").length>0) {
        $(".chosen-select").chosen();
    }
    // Show report listings
    // ===============================
    // Show/hide Report as
    $("#report").hover(function(){
        $(this).find("span").show();
    },
    function(){
        $(this).find("span").hide();
    });

    // multiple recaptchas in the same page
    // duplicate content to each other
    if($('#recaptcha_area').parents('div.recaptcha_container').length > 0) {
        $('div.recaptcha_container').each(function() {
            if( $(this).find('#recaptcha_area').length === 0 ) {
                $(this).html( $('#recaptcha_area').parents('div.recaptcha_container').clone(true, true) );
            }
        });
    }
});

function text_validation (element) {
    if( $(element).val().length == 0 ) {
        if ( $(element).parent().parent().hasClass('error') == false ) {
            $(element).parent().parent().addClass('error') ;
            var span = $("<span>").attr('class', 'help-inline').html(text_error_required);
            $(element).parent().append(span) ;
        }
        return false;
    }
    return true;
}

function mail_validation (element) {
    if( $(element).val().length == 0 ) {
        if ( $(element).parent().parent().hasClass('error') == false ) {
            $(element).parent().parent().addClass('error') ;
            var span = $("<span>").attr('class', 'help-inline').html(text_error_required);
            $(element).parent().append(span) ;
        }
        return false ;
    } else if ( !valid_email($(element).val()) ) {
        if ( $(element).parent().parent().hasClass('error') == false ) {
            $(element).parent().parent().addClass('error') ;
            var span = $("<span>").attr('class', 'help-inline').html(text_valid_email);
            $(element).parent().append(span) ;
        }
        return false ;
    }
    return true ;
}

function valid_email( email ) {
    return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(email);
}