<?php get_header(); ?>

	<!-- Page Header and H1 title -->
	<div class="container">
		<div class="page-header">
			<h1>
				<?php the_title(); ?>
			</h1>
			<h2 class="normal-font"><?php _e( 'Amenities, availability and price', 'html5blank' ); ?></h2>
		</div>
	</div>


	<!-- Gallery (using slick-slider + advanced custom fields gallery) -->
	<div class="bnb_apartment-slider">

		<?php
		$images = get_field('gallery');

		if( $images ): ?>
		<?php foreach( $images as $image ): ?>
				<div>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<div class="bnb_apartment-slider-description">
						<?php echo $image['caption']; ?>
					</div>
				</div>
		<?php endforeach; ?>
		<?php endif; ?>

	</div>

	<!-- The content of the apartment -->
	<!-- Apartment description -->
	<section class="section section-asy-padding">

		<div class="container">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<div class="row">
					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-6'); ?>>
						<div class="h2 section-title">
							<?php _e( 'Description', 'html5blank' ); ?>
						</div>
						<hr>
						<?php the_content(); // Dynamic Content ?>
					</article>
					<!-- /article -->

					<div class="col-sm-4 col-sm-offset-1 booking-form">
						<?php echo do_shortcode('[contact-form-7 id="4607" title="Contact form 1"]'); ?>
						<script type="text/javascript">
							jQuery(".booking-form form").on("reset", function(){
								// When the form is reset
								console.log("Form has been reset.")
								window.setTimeout(function(){
									jQuery("[name=apartment]").val("<?php the_title(); ?>");
								}, 100);
							});
							jQuery("[name=apartment]").val("<?php the_title(); ?>");
						</script>
					</div>
				</div>


			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<p><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></p>

				</article>
				<!-- /article -->

			<?php endif; ?>
		</div>

	</section>
	<!-- /section -->

	<!-- Why us? -->
	<!-- <section class="section section-inverted">
		<div class="container">
			<h3 class="section-title">
				Why us?
			</h3>
		</div>
	</section> -->

	<!-- Apartment specs -->
	<section class="section section-small-padding">

		<div class="container">
			<!-- Apartment specs -->
			<div class="row">
				<!-- col-sm-6 -->
				<div class="col-sm-6">
					<div class="h2">
						<?php _e( 'Features', 'html5blank' ); ?>
					</div>
					<hr>

					<div class="h3 section-title">
						<?php _e( 'Details', 'html5blank' ); ?>
					</div>
					<div class="bnb_apartment-amenities">
						<div class="bnb_apartment-amenities-item present">
							<?php the_field('max_guests'); ?> <?php _e('guests', 'html5blank'); ?>
						</div>
						<div class="bnb_apartment-amenities-item present">
							<?php the_field('number_of_beds'); ?> <?php _e('beds', 'html5blank'); ?>
						</div>
						<div class="bnb_apartment-amenities-item present">
							<?php the_field('number_of_bedrooms'); ?> <?php _e('bedrooms', 'html5blank'); ?>
						</div>
						<div class="bnb_apartment-amenities-item present">
							<?php the_field('number_of_bathrooms'); ?> <?php _e('bathrooms', 'html5blank'); ?>
						</div>
					</div>

				</div>
				<!-- / col-sm-6-->
			</div>
			<!-- Amenities -->
			<div class="row">
				<!-- col-sm-6 -->
				<div class="col-sm-6">
					<hr>
					<div class="h3 section-title">
						<?php _e( 'Amenities', 'html5blank' ); ?>
					</div>

					<?php

					$field = get_field_object('amenities');
					$value = $field['value'];
					$choices = $field['choices'];

					if( $choices ): ?>
					<div class="bnb_apartment-amenities">
						<?php foreach( $choices as $c ): ?>
						<div class="bnb_apartment-amenities-item <?php if(array_search($c, $value)){echo 'present';} ?>">
							<?php if(array_search($c, $value)){echo '&nbsp;&#10003;&nbsp;';}else{echo '&nbsp;&#10005;&nbsp;';} ?>
							<?php _e($c, 'html5blank'); ?>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<!-- / col-sm-6-->
			</div>
		</div>

	</section>


<!-- Apartment Map -->
<?php
$location = get_field('location');
if( !empty($location) ): ?>

	<!-- Load scripts and stuff -->
	<?php get_template_part('google-map'); ?>

	<div class="acf-map" style="margin: 0;height:400px;">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div>

<?php endif; ?>

<!-- Apartment Final description if present -->
<?php
$final_description = get_field('final_description');
if( !empty($final_description) ): ?>

	<section class="section section-small-padding">

		<div class="container">

			<div class="row">
				<div class="col-sm-6">
					<?php echo $final_description; ?>
				</div>
			</div>

		</div>

	</section>
	<!-- /section -->

<?php endif; ?>

<!-- <section class="section">
	<div class="container text-center">
		<h3>Book your adventure</h3>
		<img src="<?php echo get_template_directory_uri(); ?>/img/resources/booking_form_2.png" alt="Logo">
	</div>
</section> -->


<?php //get_sidebar(); ?>

<?php get_footer(); ?>
