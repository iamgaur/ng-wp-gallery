(function($){

  jQuery('#nwg_images_add').click(function(e) {
    e.preventDefault();
    var imageFrame;
    if(imageFrame){
      imageFrame.open();
    }
    // Define image_frame as wp.media object
    imageFrame = wp.media({
        
        title: 'Select Image',
        multiple : true,
        library : {
          type : 'image',
        }
      });
      imageFrame.on( 'select', function(){
        var attachments = imageFrame.state().get('selection').toJSON();
         console.log(attachments);
          for(var i=0; i< attachments.length; i++){
            $('ul.nwg-data-list').append("<li class='ng_gallery_listing'><img class='ng_gallery_img' src='"+attachments[i].url+"'/><input type='hidden' name='nwg_images[]' value='"+attachments[i].id+"'/><div class='img-option'><a href='"+attachments[i].url+"' class='thickbox dashicons dashicons-search alignleft'></a> <a class='dashicons dashicons-trash alignright remove-ngw-image'></a> </div></li>");
            
          }
      });
                  
    imageFrame.open();
  });

  // Remove image 
  $(document).on('click', '.img-option .remove-ngw-image', function(e) {
		e.preventDefault();
    
    $(this).parent().parent('.ng_gallery_listing').remove();
  });
  
  // Sortable implement on gallery images
  $( ".ng_gallery_images .nwg-data-list" ).sortable();
  $( ".ng_gallery_images .nwg-data-list" ).disableSelection();
  

})(jQuery);