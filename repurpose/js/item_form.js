var is_loading = true ;

function fill_subcategory_select ( id ) {
	var category    = $("select.category") ;
	var subcategory = $("select.subcategory") ;

	// reset subcategory select
	subcategory.html("") ;

	// check that the category has subcategories
	if( typeof twitter_theme.categories["id_" + id] === "undefined" ) {
		subcategory.append( $("<option>").attr('value', id) ) ;
		subcategory.css("display", "none") ;
		$("select.subcategory").trigger('change') ;
		return true;
	}

	subcategory.html()
	subcategory.append( $("<option>").attr('value', id).html(twitter_theme.text_select_subcategory) ) ;
	$.each(twitter_theme.categories["id_" + id], function(key, value) {
		subcategory.append( $("<option>").attr('value', value.id).html(value.name) ) ;
	}) ;
	subcategory.css("display", "") ;
	return true;
}

/* PHOTO */
function add_photo_field() {
    var num_img = $('.photos input[name="photos[]"]').size() + $(".photos ul li").length ;
    if( twitter_theme.max_number_photos != 0 && num_img < twitter_theme.max_number_photos ) {
		var file        = $("<input>").attr('type', 'file').attr('name', 'photos[]') ;
		var remove_link = $("<a>").attr('href', 'javascript://').addClass('remove').html(twitter_theme.photo_remove_text) ;
		remove_link.bind('click', function(event) {
			$(this).parent().parent().remove() ;
		}) ;
        var remove      = $("<span>").addClass("help-inline").html(twitter_theme.remove_link) ;
		var div         = $("<div>").addClass('input-file').append(file).append(remove) ;

		$(".more-photos").append(div) ;
    } else {
        alert(twitter_theme.max_images_fields_txt) ;
    }
}

function delete_image(photo_id, item_id, name, secret) {
    var result = confirm(twitter_theme.delete_photo_txt);

    if(result) {
        $.ajax({
            type: "POST",
            url: twitter_theme.ajax_url,
			data: { action: "delete_image", id: photo_id, item: item_id, code: name, secret: secret },
            dataType: 'json',
            success: function(data) {
                if(data.success) {
					$("li[name=" + name + "]").fadeOut('slow') ;
                    $("li[name=" + name + "]").remove() ;
                }
            }
        }) ;
    }
}

function ajax_country (input) {
	var country_code = $(input).attr('value') ;
	if(country_code != "") {
		$.ajax({
			type: "POST",
			url: twitter_theme.ajax_url,
			dataType: "json",
			data: { action: "regions", countryId: country_code },
			success: function(data) {
				if( data.length > 0 ) {
					$("select.region_id").html($("<option>").attr('value', '').html(twitter_theme.text_select_region)) ;
					$.each(data, function(key, value){
						$("select.region_id").append( $("<option>").attr('value', value.pk_i_id).html(value.s_name) ) ;
					}) ;
					$("select.region_id").attr('disabled', false) ;
					$("select.city_id").html($("<option>").html(twitter_theme.text_select_city)) ;
				} else {
					$("select.region_id").html($("<option>").html(twitter_theme.text_no_regions)) ;
					$("select.city_id").html($("<option>").html(twitter_theme.text_no_cities)) ;
				}
				if( is_loading && twitter_theme.region_select_id != "" ) {
					$("select.region_id").val(twitter_theme.region_select_id) ;
					$("select.region_id").trigger('change') ;
					if( $("select.region_id").length == 0 ) {
						ajax_region($("input.region_id")) ;
					}
				}
			}
		}) ;
	} else {
		$("select.region_id").attr('disabled', true) ;
		$("select.region_id").html($("<option>").html(twitter_theme.text_select_region)) ;
		$("select.city_id").attr('disabled', true) ;
		$("select.city_id").html($("<option>").html(twitter_theme.text_select_city)) ;
	}
}

function ajax_region (input) {
	var region_code = $(input).attr('value') ;
	if(region_code != "") {
		$.ajax({
			type: "POST",
			url: twitter_theme.ajax_url,
			dataType: "json",
			data: {  action: "cities", regionId: region_code },
			success: function(data) {
				if( data.length > 0 ) {
					$("select.city_id").html($("<option>").html(twitter_theme.text_select_city)) ;
					$.each(data, function(key, value){
						$("select.city_id").append( $("<option>").attr('value', value.pk_i_id).html(value.s_name) ) ;
					}) ;
					$("select.city_id").attr('disabled', false) ;
					if( is_loading ) {
						$("select.city_id").val(twitter_theme.city_select_id) ;
					}
				} else {
					$("select.city_id").html($("<option>").html(twitter_theme.text_no_cities)) ;
				}
				is_loading = false;
			}
		}) ;
	} else {
		$("select.city_id").attr('disabled', true) ;
		$("select.city_id").html($("<option>").html(twitter_theme.text_select_city)) ;
	}
}

$(document).ready(function() {
	$("select.category").bind("change", function(event) {
		fill_subcategory_select( $(this).attr("value") ) ;
	})

	if( twitter_theme.category_selected_id !== "null" ) {
		$("select.category").val(twitter_theme.category_selected_id) ;
		fill_subcategory_select( twitter_theme.category_selected_id ) ;
	}
	$("select.subcategory").val(twitter_theme.subcategory_selected_id) ;

	/* JS location */
	$("select.country_id").val(twitter_theme.country_select_id) ;
	/* init selects */
	if( $("select.country_id").val() == "" ) {
		$("select.region_id").attr('disabled', true);
	}

	if( $("select.region_id").val() == "" ) {
		$("select.city_id").attr('disabled', true);
	}

	$("select.country_id").bind('change', function(event) {
		ajax_country( $(this) ) ;
	}) ;

	$("select.region_id").bind('change', function(event) {
		ajax_region( $(this) ) ;
	}) ;

	$("select.country_id").trigger('change') ;
	if( $("select.country_id").length == 0 ) {
		ajax_country($("input.country_id")) ;
	}
	/* JS location end */

	/* Plugins hooks */
    $("select.subcategory, select.category").bind('change', function(event) {
        var cat_id = $(this).val();
        if( cat_id != "" ) {
            $.ajax({
                type: "POST",
                url: twitter_theme.ajax_url,
                data: { action: "runhook", hook: "item_" + twitter_theme.page, catId: cat_id, itemId: twitter_theme.item_id } ,
                dataType: 'html',
                success: function(data){
                    $("#plugin-hook").html(data);
                }
            });
        }
    });
	/* Plugins hooks end */
	$("select.subcategory").trigger('change') ;
}) ;