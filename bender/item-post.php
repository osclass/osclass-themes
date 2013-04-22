<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
    osc_enqueue_script('jquery-validate');
    moder2_add_boddy_class('item item-post');
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<!-- only item-post.php -->
<?php ItemForm::location_javascript_new(); ?>
<?php if(osc_images_enabled_at_items()) ItemForm::photos_javascript(); ?>
    <div class="form-container form-horizontal">
        <div class="resp-wrapper">
            <div class="header">
                <h1><?php _e('Publish a listing', 'bender'); ?></h1>
            </div>
            <ul id="error_list"></ul>
                <form name="item" action="<?php echo osc_base_url(true);?>" method="post" enctype="multipart/form-data" id="item-post">
                    <fieldset>
                    <input type="hidden" name="action" value="item_add_post" />
                    <input type="hidden" name="page" value="item" />
                        <h2><?php _e('General Information', 'bender'); ?></h2>
                        <div class="control-group">
                          <label class="control-label" for="select_1"><?php _e('Category', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::category_select(null, null, __('Select a category', 'bender')); ?>
                                <?php //ItemForm::category_multiple_selects(Category::newInstance()->listAll(false), null, __('Select a category', 'bender')); ?>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="title[<?php echo osc_locale_code(); ?>]"><?php _e('Title', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::title_input('title',osc_locale_code(), osc_esc_html( bender_item_title() )); ?>
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" for="description[<?php echo osc_locale_code(); ?>]"><?php _e('Description', 'bender'); ?></label>
                          <div class="controls">
                                <?php ItemForm::description_textarea('description',osc_locale_code(), osc_esc_html( bender_item_description() )); ?>
                          </div>
                        </div>

                        <?php if( osc_price_enabled_at_items() ) { ?>
                        <div class="control-group">
                          <label class="control-label" for="price"><?php _e('Price', 'bender'); ?></label>
                          <div class="controls">
                            <?php ItemForm::price_input_text(); ?>
                            <?php ItemForm::currency_select(); ?>
                          </div>
                        </div>
                        <?php } ?>

                        <?php if( osc_images_enabled_at_items() ) { ?>
                        <div class="box photos">
                            <h2><?php _e('Photos', 'bender'); ?></h2>

                            <div class="control-group">
                              <label class="control-label" for="photos[]"><?php _e('Photos', 'bender'); ?></label>
                              <div class="controls">
                                <input type="file" name="photos[]" />
                              </div>
                            </div>

                            <div id="photos">
                                <div class="row">
                                    <input type="file" name="photos[]" />
                                </div>
                            </div>
                            <a href="#" onclick="addNewPhoto(); uniform_input_file(); return false;"><?php _e('Add new photo', 'bender'); ?></a>

                        </div>
                        <?php } ?>
                        <?php /*
                        <div class="generic-input input-big has-placeholder input-file">
                        <div class="bg"></div>
                        <div class="label">Attach</div>
                        <span class="placeholder">CV</span>
                        <input type="file" name="attachment">
                        </div>
                        */ ?>
                        <div class="box location">
                            <h2><?php _e('Listing Location', 'bender'); ?></h2>

                            <div class="control-group">
                              <label class="control-label" for="country"><?php _e('Country', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::country_select(osc_get_countries(), osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="region"><?php _e('Region', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::region_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="city"><?php _e('City', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::city_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="cityArea"><?php _e('City Area', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::city_area_text(osc_user()); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="address"><?php _e('Address', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::address_text(osc_user()); ?>
                              </div>
                            </div>
                        </div>
                        <!-- seller info -->
                        <?php if(!osc_is_web_user_logged_in() ) { ?>
                        <div class="box seller_info">
                            <h2><?php _e("Seller's information", 'bender'); ?></h2>
                            <div class="control-group">
                              <label class="control-label" for="contactName"><?php _e('Name', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::contact_name_text(); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="contactEmail"><?php _e('E-mail', 'bender'); ?></label>
                              <div class="controls">
                                <?php ItemForm::contact_email_text(); ?>
                              </div>
                            </div>
                            <div class="control-group">
                              <div class="controls checkbox">
                                <?php ItemForm::show_email_checkbox(); ?> <label for="showEmail"><?php _e('Show e-mail on the listing page', 'bender'); ?></label>
                              </div>
                            </div>
                        </div>
                        <?php }; ?>
                        <?php ItemForm::plugin_post_item(); ?>
                            <div class="control-group">
                            <?php if( osc_recaptcha_items_enabled() ) {?>
                                <div class="controls">
                                        <?php osc_show_recaptcha(); ?>
                                </div>
                                <?php }?>
                                <div class="controls">
                                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Publish", 'bender');?></button>
                                </div>
                            </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <script type="text/javascript">
   /*function uniform_input_file(){
        photos_div = $('div.photos');
        $('div',photos_div).each(
            function(){
                if( $(this).find('div.uploader').length == 0  ){
                    divid = $(this).attr('id');
                    if(divid != 'photos'){
                        divclass = $(this).hasClass('box');
                        if( !$(this).hasClass('box') & !$(this).hasClass('uploader') & !$(this).hasClass('row')){
                            $("div#"+$(this).attr('id')+" input:file").uniform({fileDefaultText: fileDefaultText,fileBtnText: fileBtnText});
                        }
                    }
                }
            }
        );
    }*/

    /*setInterval("uniform_plugins()", 250);
    function uniform_plugins() {

        var content_plugin_hook = $('#plugin-hook').text();
        content_plugin_hook = content_plugin_hook.replace(/(\r\n|\n|\r)/gm,"");
        if( content_plugin_hook != '' ){

            var div_plugin_hook = $('#plugin-hook');
            var num_uniform = $("div[id*='uniform-']", div_plugin_hook ).size();
            if( num_uniform == 0 ){
                if( $('#plugin-hook input:text').size() > 0 ){
                    $('#plugin-hook input:text').uniform();
                }
                if( $('#plugin-hook select').size() > 0 ){
                    $('#plugin-hook select').uniform();
                }
            }
        }
    }*/
    <?php if(osc_locale_thousands_sep()!='' || osc_locale_dec_point() != '') { ?>
    $().ready(function(){
        $("#price").blur(function(event) {
            var price = $("#price").prop("value");
            <?php if(osc_locale_thousands_sep()!='') { ?>
            while(price.indexOf('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>')!=-1) {
                price = price.replace('<?php echo osc_esc_js(osc_locale_thousands_sep());  ?>', '');
            }
            <?php }; ?>
            <?php if(osc_locale_dec_point()!='') { ?>
            var tmp = price.split('<?php echo osc_esc_js(osc_locale_dec_point())?>');
            if(tmp.length>2) {
                price = tmp[0]+'<?php echo osc_esc_js(osc_locale_dec_point())?>'+tmp[1];
            }
            <?php }; ?>
            $("#price").prop("value", price);
        });
    });
    <?php }; ?>
</script>
<script type="text/javascript">
if (typeof(FileReader) === 'function') {
  //sexy drag and drop action
  console.log('supports');
} else {
   //no drag and drop support available :(
    console.log('DO NOT!');
};

// Makes sure the dataTransfer information is sent when we
  // Drop the item in the drop box.
  jQuery.event.props.push('dataTransfer');

  var z = -40;
  // The number of images to display
  var maxFiles = 5;
  var errMessage = 0;

  // Get all of the data URIs and put them in an array
  var dataArray = [];

  // Bind the drop event to the dropzone.
  $('#drop-files').bind('drop', function(e) {
    var files = e.dataTransfer.files;
    console.log(files);
  });

/*
  // Makes sure the dataTransfer information is sent when we
  // Drop the item in the drop box.
  jQuery.event.props.push('dataTransfer');

  var z = -40;
  // The number of images to display
  var maxFiles = 5;
  var errMessage = 0;

  // Get all of the data URIs and put them in an array
  var dataArray = [];

  // Bind the drop event to the dropzone.
  $('#drop-files').bind('drop', function(e) {

    // This variable represents the files that have been dragged
    // into the drop area
    var files = e.dataTransfer.files;

    // Show the upload holder
    //$('#uploaded-holder').show();

    // For each file
    $.each(files, function(index, file) {

      // Some error messaging
      if (!files[index].type.match('image.*')) {

        if(errMessage == 0) {
          $('#drop-files').html('Hey! Images only');
          ++errMessage
        }
        else if(errMessage == 1) {
          $('#drop-files').html('Stop it! Images only!');
          ++errMessage
        }
        else if(errMessage == 2) {
          $('#drop-files').html("Can't you read?! Images only!");
          ++errMessage
        }
        else if(errMessage == 3) {
          $('#drop-files').html("Fine! Keep dropping non-images.");
          errMessage = 0;
        }
        return false;
      }

      // Check length of the total image elements

      if($('#dropped-files > .image').length < maxFiles) {
        // Change position of the upload button so it is centered
        var imageWidths = ((220 + (40 * $('#dropped-files > .image').length)) / 2) - 20;
        $('#upload-button').css({'left' : imageWidths+'px', 'display' : 'block'});
      }

      // Start a new instance of FileReader
      var fileReader = new FileReader();

        // When the filereader loads initiate a function
        fileReader.onload = (function(file) {

          return function(e) {

            // Push the data URI into an array
            dataArray.push({name : file.name, value : this.result});

            // Move each image 40 more pixels across
            z = z+40;
            // This is the image
            var image = this.result;


            // Just some grammatical adjustments
            if(dataArray.length == 1) {
              $('#upload-button span').html("1 file to be uploaded");
            } else {
              $('#upload-button span').html(dataArray.length+" files to be uploaded");
            }
            // Place extra files in a list
            if($('#dropped-files > .image').length < maxFiles) {
              // Place the image inside the dropzone
              $('#dropped-files').append('<div class="image" style="left: '+z+'px; background: url('+image+'); background-size: cover;"> </div>');
            }
            else {

              $('#extra-files .number').html('+'+($('#file-list li').length + 1));
              // Show the extra files dialogue
              $('#extra-files').show();

              // Start adding the file name to the file list
              $('#extra-files #file-list ul').append('<li>'+file.name+'</li>');

            }
          };

        })(files[index]);

      // For data URI purposes
      fileReader.readAsDataURL(file);

    });
*/


  $('#drop-files').bind('dragenter', function() {
    $(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bb2b2b'});
    return false;
  });
  $('#drop-files').bind('dragleave', function() {
    $(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bababa'});
    return false;
  });

  $('#drop-files').bind('drop', function() {
    $(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'});
    return false;
  });




  if (typeof(FileReader) === 'function'){
    console.log('soportado');
  } else {
    console.log('NO soportado');
  }
</script>
<?php osc_current_web_theme_path('footer.php'); ?>