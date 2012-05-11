$(function() {
    var checkboxes = $('input[type="checkbox"]');
    checkboxes.each(function(){
        $(this).wrap("<span/>");
        var thisCheckbox = $(this);
        var parent = $(this).parent();
        parent.addClass('ui-checkbox').append('<span class="ui-icon"></span>');
        thisCheckbox.click(function(){
            $(this).trigger('focus');
            if(thisCheckbox.is(':checked')){
                parent.addClass('ui-checkbox-checked');
            } else {
                parent.removeClass('ui-checkbox-checked');
            }
        }).focus(function(){
            parent.addClass('ui-checkbox-focus');
        }).blur(function(){
            parent.removeClass('ui-checkbox-focus');
        });

        parent.click(function(){
            thisCheckbox[0].click();
        });

        if(thisCheckbox.is(':checked')){
            parent.addClass('ui-checkbox-checked');
        } else {
            parent.removeClass('ui-checkbox-checked');
        }
    });

    $('.ui-button-submit').each(function(){
        var text = $(this).text();
        var button = $('<a class="ui-button" href="#">'+text+'<a/>').click(function(){
            $(this).parents('form').submit();
            return false;
        });
        $(this).replaceWith(button);
    });

    
    $('select').each(function(){
        var thatSelect = $(this);
        thatSelect.hide();
        var uiSelecBox = $('<div class="ui-selectmenu" id="ui-'+thatSelect.attr('name')+'"></div>"');
        var uiSelect = $('<a href="#" class="ui-selectmenu-trigger"></a>');
        var uiSelectIcon = $('<span class="ui-selectmenu-icon"></span>');
        var uiSelected = $('<span class="ui-selectmenu-label">'+thatSelect.find("option:selected").text()+'</span>');
        var uiSelectList = $('<ul class="ui-selectmenu-list"/>');

        var index = 0;
        thatSelect.find('option').each(function(){
            var thatOption = $(this);
            var uiSelectOptionText = thatOption.text();
            var uiSelectOption = $('<li><a href="#">'+uiSelectOptionText+'</a></li>');
            uiSelectList.append(uiSelectOption);

            uiSelectOption.click(function(e){
                e.stopPropagation();
                thatOption.attr('selected','selected').trigger('change');
                uiSelected.html(uiSelectOptionText);
                $('.ui-selectmenu-show').removeClass('ui-selectmenu-show');
                return false;
            });
            index++;
        });
        
        uiSelect.append(uiSelected).append(uiSelectIcon);
        uiSelecBox.append(uiSelect).append(uiSelectList);
        thatSelect.after(uiSelecBox);

        uiSelect.click(function(){
            $('.ui-selectmenu-show').not($(this)).removeClass('ui-selectmenu-show');
            uiSelect.parent().addClass('ui-selectmenu-show');
            return false;
        });


    });
    
    //price range
    $("#price-range").slider({
        range: true,
        min: 0,
        max: 10000,
        step: 500,
        values: [0, 10000],
        slide: function(event, ui) {
            $('#priceMin').val(ui.values[0]);
            $('#priceMax').val(ui.values[1]);
        },
        create:function(){
            var values = $(this).slider( "option", "values" );
            $('#priceMin').val(values[0]);
            $('#priceMax').val(values[1]);
        }
    });

    //HACK FOR REALSTATE PLUGIN
    $("#sidebar .form-hook .slider").each(function(){
        var thatElement = $(this);
        var thatSlider = thatElement.children('div');
        var minValue = $('<input type="text" class="min" readonly/>');
        var maxValue = $('<input type="text" class="max" readonly/>');
        thatElement.removeClass('slider').addClass('ui-slider-box').append(minValue,maxValue);
        thatSlider.bind( "slide", function(event, ui) {
            minValue.val(ui.values[0]);
            maxValue.val(ui.values[1]);
        }).bind( "slidecreate", function() {
            var values = $(this).slider( "option", "values" );
            minValue.val(values[0]);
            maxValue.val(values[1]);
        });

    });
    //remove empty p
    $("#sidebar .form-hook p").filter( function() {
        return $.trim($(this).html()) == '';
    }).remove()

    $('.js-submit').click(function(){
        $(this).parents('form').submit();
        return false;
    });

    $('html').click(function(e) {
        e.stopPropagation();
        $('.ui-selectmenu-show').removeClass('ui-selectmenu-show');
    });

});