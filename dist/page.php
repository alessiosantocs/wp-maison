<?php get_header(); ?>

<?php
$show_page_header = true;
$show_featured_image = true;
$show_page_excerpt = true;
$show_page_content = true;

$hidden_objects = get_field_object('hide_objects');

if(!empty($hidden_objects)){
  $hidden_objects_value = $hidden_objects['value'];

  if(empty($hidden_objects_value)){
    $hidden_objects_value = Array();
  }


  $show_page_header = array_search('hide_page_header', $hidden_objects_value) === false;
  $show_featured_image = array_search('hide_featured_image', $hidden_objects_value) === false;
  $show_page_excerpt = array_search('hide_page_excerpt', $hidden_objects_value) === false;
  $show_page_content = array_search('hide_content', $hidden_objects_value) === false;
}

 ?>

	<?php if ($show_page_header): ?>

		<div class="container">
			<div class="page-header">
				<h1>
					<?php
					$featured_title = get_field('featured_title');
					if ( !empty($featured_title) ): ?>
						<?php echo $featured_title;?>
					<?php else:?>
						<?php the_title(); ?>
					<?php endif;?>
				</h1>
				<?php
				$featured_subtitle = get_field('featured_subtitle');
				if ( !empty($featured_subtitle) ): ?>
					<h2 class="normal-font">
						<?php echo $featured_subtitle;?>
					</h2>
				<?php endif;?>
			</div>
		</div>

	<?php endif; ?>

	<?php if ($show_featured_image): ?>

		<!-- The featured image -->
		<?php if (get_the_post_thumbnail()): ?>
			<?php
			$post_thumbnail_id = get_post_thumbnail_id();
			$thumbnail_attributes = wp_get_attachment_image_src( $post_thumbnail_id , 'full');
			 ?>
			<section class="section section-inverted section-large-padding">
				<div class="section-background enhance-img" style="background-image: url('<?php echo $thumbnail_attributes[0]; ?>');">
				</div>

				<div class="container on-top-relative">
				</div>
			</section>
		<?php endif; ?>

	<?php endif; ?>


<?php if ($show_page_excerpt || $show_page_content): ?>

	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<?php if ($show_page_excerpt): ?>

						<!-- The excerpt -->
						<?php
						$the_excerpt = get_field('page_excerpt');
						if (!empty($the_excerpt)): ?>
							<p class="lead">
								<?php echo $the_excerpt; ?>
							</p>
						<?php endif; ?>

					<?php endif; ?>

					<!-- The content -->
					<?php if ($show_page_content): ?>
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>

<!-- Flexible content part -->
<?php
// check if the flexible content field has rows of data
if( have_rows('flex_content') ):
?>

	<?php
	 // loop through the rows of data
	while ( have_rows('flex_content') ) : the_row();
	  if( get_row_layout() == 'section' ):
	?>
		<section class="section <?php
    $section_css_class = get_sub_field_object('section_css_class');
    if(!empty($section_css_class)){
      echo join($section_css_class['value'], ' ');
    } ?>">
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
        if (!empty($background_map)):?>

          <!-- Load scripts and stuff -->
          <?php get_template_part('google-map'); ?>

          <div  class="section-background acf-map" style="margin: 0;">
            <div class="marker"
                  data-lat="<?php echo $background_map['lat']; ?>"
                  data-lng="<?php echo $background_map['lng']; ?>"></div>
          </div>
         <?php endif; ?>

			<?php endif; ?>


			<div class="on-top-relative container">
				<!-- The section title -->
				<?php
				$title = get_sub_field('title');
				if ( !empty($title)): ?>
					<h3 class="section-title">
						<?php echo $title ?>
					</h3>
				<?php endif; ?>

				<!-- The section paragraph -->
				<?php
				$paragraph = get_sub_field('paragraph');
				$link = get_sub_field('link');

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

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
