$(document).ready(function(){
    // User_menu show/hide submenu
    $("#user_menu .with_sub").hover(function(){
        $(this).find("ul").show();
    },
    function(){
        $(this).find("ul").hide();
    });

    // Flash messages effect
    $("#FlashMessage").slideDown('slow').delay(3000).slideUp('slow');
    
    // Open login box in situ
    $('#login_open').click(function(e) {
        e.preventDefault();
        $('#login').slideToggle('slow', function(){});
    });

    // Apply the UniForm plugin to pulldows and button
    $("select, button").uniform();

    // Show advanced search in internal pages
    $("#expand_advanced").click(function(e){
        e.preventDefault();
        $(".search .extras").slideToggle();
    });
	
    // Show/hide Report as
    $("#report").hover(function(){
        $(this).find("span").show();
    },
    function(){
        $(this).find("span").hide();
    });

	// Hover on ad list rows 
	$(".ad_list table .row").hover(function(){
		$(".ad_list table .row." + $(this).attr("rel")).css("background","#fffaf1");
	},
	function(){
		$(".ad_list table .row." + $(this).attr("rel")).css("background","#FFFFFF");
	});
	
	// Highlight the contact form when clicking the Apply for ... button
	$("#apply_for").click(function(e){
		$("#contact input,#contact textarea").effect("highlight", {color: '#ffffcc'}, 3000);
	});
});