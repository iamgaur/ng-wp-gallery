<?php 
  // Set border
  $ngwgborder = get_post_meta($postId, "nwg_border", true);
  $ngwgborder = $ngwgborder ? "nwg-border" : "";

  // Set Border Radius 
  $ngwgborderRadius = get_post_meta($postId, "nwg_border_radius", true);
  $ngwgborderRadius = $ngwgborderRadius ? " nwg-border-radius" : "";
?>
<ul class="ngw-grid-view">
    <?php $imagesData = get_post_meta($postId, 'nwg_images', true);
        if (!empty($imagesData)) {
            foreach ($imagesData as $value) {
            if(file_exists(get_attached_file($value))) {
        ?>
        <li>
            <a class="ng-gallery-grid-view" data-fancybox="gallery" href="<?php echo esc_url(wp_get_attachment_url($value)); ?>">
            
                <img class="<?php echo $ngwgborder.$ngwgborderRadius; ?>" src="<?php echo esc_url(wp_get_attachment_url($value)); ?>" alt="">
            
            </a>
            </li>
    <?php         
            }
            }
        }    
?>
</div>