<!-- Flexible content part -->
<?php
// check if the flexible content field has rows of data
if( have_rows('flex_content') ):
?>

	<?php
	 // loop through the rows of data
	while ( have_rows('flex_content') ) : the_row();
	  if( get_row_layout() == 'section' ):

      $title = get_sub_field('title');
      $paragraph = get_sub_field('paragraph');
      $link = get_sub_field('link');

      $should_create_on_top_container = (!empty($title)) || (!empty($paragraph)) || (!empty($link));
	?>
		<section class="section <?php
    $section_css_class = get_sub_field_object('section_css_class');
    if(!empty($section_css_class)){
      echo join($section_css_class['value'], ' ');
    } ?> <?php echo (!$should_create_on_top_container) ? 'section-map' : '' ; ?>">
			<?php

			$background_type = get_sub_field('background_type');
			if ( $background_type == 'image'): ?>

        <!-- Show background image -->
        <?php
        $background_image = get_sub_field('image');
        if (!empty($background_image)):?>
  				<div class="section-background" style="background-image: url('<?php echo $background_image['url']; ?>');">
  				</div>
			   <?php endif; ?>

			<?php elseif($background_type == 'map'): ?>
        <!-- Show google map -->
        <?php
        $background_map = get_sub_field('map');
        if (!empty($background_map)):
          $zoom = get_sub_field('map_zoom');?>

          <div class="acf-map-overlay">
            <div class="text visible-xs visible-sm"><?php echo _e('Tap to use the map', 'html5blank'); ?></div>
            <!-- <div class="text hidden-xs hidden-sm"><?php //echo _e('Click to use the map', 'html5blank'); ?></div> -->
          </div>
          <iframe class="section-background acf-map"
                  width="600"
                  height="450"
                  frameborder="0"
                  style="border:0"
                  src="https://www.google.com/maps/embed/v1/search?q=<?php echo $background_map['address']; ?>&key=AIzaSyDFbnmht3Jgsolghj6cCesCO7qO2jikl9Y&zoom=<?php echo (empty($zoom)) ? 10 : $zoom; ?>"
                  allowfullscreen>
          </iframe>
         <?php endif; ?>

			<?php endif; ?>


      <?php
      if ($should_create_on_top_container): ?>
        <div class="on-top-relative container">
          <!-- The section title -->
          <?php
          if ( !empty($title)): ?>
            <h3 class="section-title">
              <?php echo $title ?>
            </h3>
          <?php endif; ?>

          <!-- The section paragraph -->
          <?php
          if ( !empty($paragraph)): ?>
            <p class="section-paragraph" style="<?php echo (empty($link)) ? 'margin-bottom: 20px;' : '' ?>">
              <?php echo $paragraph ?>
            </p>
          <?php endif; ?>


          <!-- The section paragraph -->
          <?php
          if ( !empty($link)): ?>
            <a href="<?php echo get_the_permalink($link->ID); ?>" class="btn btn-autostyle">
              <?php echo get_the_title($link->ID); ?>
            </a>
          <?php endif; ?>


        </div>
      <?php endif; ?>


		</section>

	<?php
	  elseif( get_row_layout() == 'download' ):
	?>

	<?php
	  endif;
	endwhile;
	?>

<?php
else :

    // no layouts found

endif;

?>