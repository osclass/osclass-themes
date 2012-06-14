$(document).ready(function() {
    if( $("#regionId").length == 0 ) 
        $("#region").before( $("<select>").attr('id', 'regionId').attr('name', 'regionId').attr('style', 'display:none').attr('disabled', true) ) ;
    if( $("#cityId").length == 0 ) 
        $("#city").before( $("<select>").attr('id', 'cityId').attr('name', 'cityId').attr('style', 'display:none').attr('disabled', true) ) ;
    
    if( $("#region").length == 0) 
        $("#regionId").before( $("<input>").attr('type', 'text').attr('name', 'region').attr('id', 'region').attr('style', 'display:none').attr('disabled', true) ) ;
    if( $("#city").length == 0) 
        $("#cityId").before( $("<input>").attr('type', 'text').attr('name', 'city').attr('id', 'city').attr('style', 'display:none').attr('disabled', true) ) ;
    
    $("#countryId").bind("change", function() {
        var country_code = $(this).val() ;
        var result       = '';
        if (country_code != '') {
            $("#regionId").attr('disabled', false) ;
            $("#cityId").attr('disabled', true) ;
            $.ajax({
                type: "POST",
                url: ajax_region_url + country_code,
                dataType: "json",
                success: function(data) {
                    var length = data.length;
                    if( length > 0 ) {
                        result += '<option value="">' + text_select_region + '</option>' ;
                        for(key in data) {
                            result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                        }
                        $("#region").attr('style', 'display:none') ;
                        $("#region").attr('disabled', true) ;
                        $("#city").attr('style', 'display:none') ;
                        $("#city").attr('disabled', true) ;
                        $("#regionId").attr('style', '') ;
                        $("#regionId").attr('disabled', false) ;
                        $("#cityId").attr('style', '') ;
                        $("#cityId").attr('disabled', true) ;
                        
                        $("#regionId").html( result ) ;
                        $("#cityId").html( $("<option>").html(text_select_city) ) ;
                    } else {
                        $("#region").attr('style', '') ;
                        $("#region").attr('disabled', false) ;
                        $("#city").attr('style', '') ;
                        $("#city").attr('disabled', false) ;
                        $("#regionId").attr('style', 'display:none') ;
                        $("#regionId").attr('disabled', true) ;
                        $("#cityId").attr('style', 'display:none') ;
                        $("#cityId").attr('disabled', true) ;
                    }
                }
            })
        } else {
            $("#region").attr('style', 'display:none') ;
            $("#city").attr('style', 'display:none') ;
            $("#regionId").attr('style', '') ;
            $("#cityId").attr('style', '') ;
            $("#regionId").html( $("<option>").html(text_select_region) ) ;
            $("#cityId").html( $("<option>").html(text_select_city) ) ;
            $("#regionId").attr('disabled', true) ;
            $("#cityId").attr('disabled', true) ;
        }
    });

    $("#regionId").bind("change", function() {
        var region_code = $(this).val() ;
        var result      = '';
        if(region_code != '') {
            $("#cityId").attr('disabled', false);
            $.ajax({
                type: "POST",
                url: ajax_city_url + region_code,
                dataType: "json",
                success: function(data) {
                    var length = data.length;
                    if( length > 0 ) {
                        result += '<option value="">' + text_select_city + '</option>' ;
                        for(key in data) {
                            result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                        }
                        $("#city").attr('style', 'display:none') ;
                        $("#city").attr('disabled', true) ;
                        $("#cityId").attr('style', '') ;
                        $("#cityId").attr('disabled', false) ;
                        
                        $("#cityId").html(result) ;
                    } else {
                        $("#city").attr('style', '') ;
                        $("#city").attr('disabled', false) ;
                        $("#cityId").attr('style', 'display:none') ;
                        $("#cityId").attr('disabled', true) ;
                    }
                }
            });
        } else {
            $("#cityId").attr('disabled', true);
        }
    });
});