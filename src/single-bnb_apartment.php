<?php get_header(); ?>

	<!-- Gallery (using slick-slider + advanced custom fields gallery) -->
	<div class="bnb_apartment-slider">

		<?php
		$images = get_field('gallery');

		if( $images ): ?>
		<?php foreach( $images as $image ): ?>
				<div>
					<img data-lazyslide-img="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" data-height="<?php echo $image['height']; ?>" data-width="<?php echo $image['width']; ?>" class="slider-img" />
					<div class="bnb_apartment-slider-description">
						<?php echo $image['caption']; ?>
					</div>
				</div>
		<?php endforeach; ?>
		<?php endif; ?>

	</div>

	<!-- Page Header and H1 title -->
	<div class="container">
		<div class="page-header">
			<h1>
				<?php the_title(); ?>
			</h1>
			<h2 class="normal-font">
				<?php
				$apartment_definition = get_field('apartment_definition');
				if (!empty($apartment_definition)): ?>
					<?php echo $apartment_definition; ?>
				<?php else: ?>
					<?php _e( 'Features, amenities and photos', 'html5blank' ); ?></h2>
				<?php endif; ?>
		</div>
	</div>

	<script type="text/javascript">
		// Fixing dimensions and preload images
		(function(){
			var imgs = $(".slider-img");

			var fixImages = function(){
				var imgs = $(".slider-img");

				// console.log(imgs);
				if ($(".bnb_apartment-slider").hasClass("fullscreen")) {
					console.log("exit");
					imgs.removeAttr("width");
					return false;
				}
				// console.log(imgs.length);
				imgs.each(function(){
					var img = $(this);
					var url = img.attr("data-lazyslide-img");
					var height = img.attr("data-height");
					var width = img.attr("data-width");
					var newWidth = 0;

					var domHeight = img.height();

					newWidth = width * domHeight / height;

					if (newWidth == 0) {
						console.error("%s | %s | %s", width, height, domHeight);
					}

					img.attr("width", newWidth);
				});

			};

			var startFixingImages = function(){
				return window.setInterval(fixImages, 100);
			};

			var loadedImages = [];
			var preloadImages = function(){
				var imgs = $(".slider-img");

				imgs.each(function(){
					var img = $(this);
					var url = img.attr("data-lazyslide-img");

					// If the url is already in the array then the image has already been loaded
					if (loadedImages.indexOf(url) >= 0) {
						img.removeAttr("data-lazyslide-img");
						img.attr("src", url);
					// Else check if it's time to load the image
					}else if (img.parent().hasClass('slick-active') && url !== undefined) {
						img.removeAttr("data-lazyslide-img");
						img.attr("src", url);
						loadedImages.push(url);
					}else if(img.parent().prev().hasClass('slick-current') && url !== undefined){
						img.removeAttr("data-lazyslide-img");
						img.attr("src", url);
						loadedImages.push(url);
					}else if(img.parent().next().hasClass('slick-current') && url !== undefined){
						img.removeAttr("data-lazyslide-img");
						img.attr("src", url);
						loadedImages.push(url);
					}
				});

			};

			var startPreloadingImages = function(){
				return window.setInterval(preloadImages, 100);
			};

			startPreloadingImages();
			startFixingImages();

			// Only on desktop
			if ($(window).width() >= 768) {
				console.log("Starting tasks");
			}
		})()

	</script>

	<!-- The content of the apartment -->
	<!-- Apartment description -->
	<section class="section section-asy-padding">

		<div class="container">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<div class="row">
					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-6'); ?>>

						<?php if (empty($apartment_definition)): ?>
							<div class="h2 section-title">
								<?php _e( 'Description', 'html5blank' ); ?>
							</div>
							<hr>
						<?php endif; ?>

						<?php the_content(); // Dynamic Content ?>
					</article>
					<!-- /article -->

					<div class="col-sm-4 col-sm-offset-1 booking-form">
						<?php echo do_shortcode(__("[contact-form-7 id='4643' title='Check Availability Form ENG']", "html5blank")); ?>
						<script type="text/javascript">
							var daylabel = "<?php _e('day', 'html5blank'); ?>";
							var eveninglabel = "<?php _e('evening', 'html5blank'); ?>";
							var datetime = new Date();
							var hours = datetime.getHours();
							var partofday;

							if(hours < 17){
								partofday = daylabel;
							}else{
								partofday = eveninglabel;
							}

							var updateForm = function(){
								jQuery("[name=apartment]").val("<?php the_title(); ?>");
								jQuery("[name=partofday]").val(partofday);
							};

							jQuery(".booking-form form").on("reset", function(){
								// When the form is reset
								console.log("Form has been reset.")
								window.setTimeout(function(){
									updateForm();
								}, 100);
							});

							updateForm();
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
						<?php if (($max_guests = get_field('max_guests')) > 0): ?>
							<div class="bnb_apartment-amenities-item present">
								<?php echo $max_guests; ?> <?php _e('guests', 'html5blank'); ?>
							</div>
						<?php endif; ?>

						<?php if (($number_of_beds = get_field('number_of_beds')) > 0): ?>
							<div class="bnb_apartment-amenities-item present">
								<?php echo $number_of_beds; ?> <?php _e('beds', 'html5blank'); ?>
							</div>
						<?php endif; ?>

						<?php if (($number_of_sofa_beds = get_field('number_of_sofa_beds')) > 0): ?>
							<div class="bnb_apartment-amenities-item present">
								<?php echo $number_of_sofa_beds; ?> <?php _e('sofa beds', 'html5blank'); ?>
							</div>
						<?php endif; ?>

						<?php if (($number_of_bedrooms = get_field('number_of_bedrooms')) > 0): ?>
							<div class="bnb_apartment-amenities-item present">
								<?php echo $number_of_bedrooms; ?> <?php _e('bedrooms', 'html5blank'); ?>
							</div>
						<?php endif; ?>

						<?php if (($number_of_bathrooms = get_field('number_of_bathrooms')) > 0): ?>
							<div class="bnb_apartment-amenities-item present">
								<?php echo $number_of_bathrooms; ?> <?php _e('bathrooms', 'html5blank'); ?>
							</div>
						<?php endif; ?>
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
						<?php foreach( $choices as $k => $c ): ?>
							<?php
							$is_present = array_search($k, $value) !== false;
							if ($is_present): ?>
								<div class="bnb_apartment-amenities-item <?php if(array_search($k, $value) !== false){echo 'present';} ?>">
									<?php if($is_present){echo '&nbsp;&#10003;&nbsp;';}else{echo '&nbsp;&#10005;&nbsp;';} ?>
									<?php _e($c, 'html5blank'); ?>
								</div>
							<?php endif; ?>

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
	<?php// get_template_part('google-map'); ?>

	<!-- <div class="acf-map" style="margin: 0;height:400px;">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div> -->

	<div class="acf-map-container">
		<div class="acf-map-overlay">
			<div class="text visible-xs visible-sm"><?php echo _e('Tap to use the map', 'html5blank'); ?></div>
			<!-- <div class="text hidden-xs hidden-sm"><?php // echo _e('Click to use the map', 'html5blank'); ?></div> -->
		</div>
		<iframe class="acf-map"
						width="600"
						height="450"
						frameborder="0"
						style="border:0"
						src="https://www.google.com/maps/embed/v1/search?q=<?php echo $location['address']; ?>&key=AIzaSyDFbnmht3Jgsolghj6cCesCO7qO2jikl9Y&zoom=10"
						allowfullscreen>
		</iframe>
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

<?php
global $footer_widget_area_id;
$footer_widget_area_id = 'widget-area-before-footer-accommodation';

get_footer(); ?>
