$(document).ready(function(){
    $('select[name="switch-language"]').change(function(){
        $('.switch-locale').hide();
        $('.locale-'+$(this).find('option:selected').val()).show();
    }).trigger('change');

    $('.with_sub').hover(function(){
        $(this).addClass('hover');
    },function(){
        $(this).removeClass('hover');
    });
});