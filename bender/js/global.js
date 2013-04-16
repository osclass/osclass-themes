function isResponsive(){
     if($('#responsive-trigger').is(':visible')){
          return true;
     }
     return false;
}
$('.r-list h1 a').click(function(){
     if(isResponsive()){
          var $parent = $(this).parent().parent();
          if($parent.hasClass('active')){
            $parent.removeClass('active');
          } else {
            $parent.addClass('active');
          }
          return false;
     }
});
//helper
/*$("[data-bclass-toggle]").click(function () {
  console.log($(this));
  var thatData = $(this).attr('data-bclass-toggle');
  $('body').toggleClass(thatData);
  return false;


});*/

function createPlaceHolder($element){


    /*$('body').on('change','.has-placeholder input, .has-placeholder textarea',function(){
        var placeholder = $(this).next();
        var thatInput  = $(this);

        if(thatInput.parents('.has-placeholder').hasClass('input-file')){
            placeholder = $(this).prev();
            var defaultText = placeholder.text();

                filename = $(this).val()
                if (filename === "") {
                    filename = defaultText;
                } else {
                    filename = filename.split(/[\/\\]+/);
                    filename = filename[(filename.length - 1)];
                }

                placeholder.text(filename);
        }
    });*/
  var $wrapper = $('<div class="has-placeholder '+$element.attr('class')+'" />');
  $element.wrap($wrapper);
  var $label = $('<label/>');
      $label.append($element.attr('placeholder'));
      $element.removeAttr('placeholder');

  $element.before($label);
  $element.bind('remove', function() {
        $wrapper.remove();
    });


}
//Function
function toggleClass(element,destination,isObject){
    var $selector = $('['+element+']');
    $selector.click(function (event) {


      var thatClass  = $(this).attr(element);
      var thatDestination;
      if (typeof(isObject) != "undefined"){
        var thatDestination  = $(destination);
      } else {
        var thatDestination  = $($(this).attr(destination));
      }
      thatDestination.toggleClass(thatClass);

      event.preventDefault();
      return;
    });

/*
    var $selector = $('['+element+']');
    $selector.click(function () {
      var thatClass  = $(this).attr(element);
      $('body').toggleClass(thatClass);
      return false;
    });*/
}

//<a href="#" data-class-toggle="grid" data-destination="#listing-card-list">grid</a>

function selectUi(thatSelect){
    var uiSelect = $('<a href="#" class="select-box-trigger"></a>');
    var uiSelectIcon = $('<span class="select-box-icon">0</span>');
    var uiSelected = $('<span class="select-box-label">'+thatSelect.find("option:selected").text()+'</span>');
    var uiWrap = $('<div class="select-box '+thatSelect.attr('class')+'" />');

    thatSelect.css('filter', 'alpha(opacity=40)').css('opacity', '0');
    thatSelect.wrap(uiWrap);


    uiSelect.append(uiSelected).append(uiSelectIcon);
    thatSelect.parent().append(uiSelect);
    uiSelect.click(function(){
        return false;
    });
    thatSelect.change(function(){
        uiSelected.text(thatSelect.find('option:selected').text());
    });
    thatSelect.bind('removed', function() {
        thatSelect.parent().remove();
    });
}
$(document).ready(function(event){

  toggleClass('data-bclass-toggle','body',true);
  /*toggleClass('data-class-toggle','data-destination');
  <a href="<?php echo osc_update_search_url(array('sShowAs'=> 'list')); ?>" class="list-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span>Lista</span></a>
  <a href="<?php echo osc_update_search_url(array('sShowAs'=> 'gallery')); ?>" class="grid-button" data-class-toggle="listing-grid" data-destination="#listing-card-list"><span>Grid</span></a>
  */
  $('.doublebutton a').click(function (event) {

      var thisParent = $(this).parent();
      if($(this).hasClass('grid-button')){
        thisParent.addClass('active');
        $('#listing-card-list').addClass('listing-grid');
      } else {
        thisParent.removeClass('active');
        $('#listing-card-list').removeClass('listing-grid');
      }

      event.preventDefault();
      return;
    });


    /////// STARTS PLACE HOLDER
    $('body').on('focus','.has-placeholder input, .has-placeholder textarea',function(){
        var placeholder = $(this).prev();
        var thatInput  = $(this);

        if(thatInput.parents('.has-placeholder').not('.input-file')){
            placeholder.hide();
        }
    });
    $('body').on('blur','.has-placeholder input, .has-placeholder textarea',function(){
        var placeholder = $(this).prev();
        var thatInput  = $(this);

        if(thatInput.parents('.has-placeholder').not('.input-file')){
            if(thatInput.val() == '') {
                placeholder.show();
            }
        }
    });

    $('body').on('click touchstart','.has-placeholder label',function(){
        var placeholder = $(this)
        var thatInput  = $(this).parents('.has-placeholder').find('input, textarea');
        if(thatInput.attr('disabled') != 'disabled'){
            placeholder.hide();
            thatInput.focus();
        }
    });

    $('input[placeholder]').each(function(){
      createPlaceHolder($(this));
    });

    $('body').on("created", '[name^="select_"]',function(evt) {
      console.log('fuuuu');
      selectUi($(this));
    });

    $('select').each(function(){
        selectUi($(this));
    });

    $('.flashmessage .ico-close').click(function(){
        $(this).parents('.flashmessage').remove();
    });
    $('#mask_as_form select').on('change',function(){
        $('#mask_as_form').submit();
        $('#mask_as_form').submit();
    });

    $("a[rel=image_group]").fancybox({
        openEffect : 'none',
        closeEffect : 'none',
        nextEffect : 'fade',
        prevEffect : 'fade',
        loop : false,
        helpers : {
                title : {
                        type : 'inside'
                }
        }
    });
});
