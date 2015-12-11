

			<?php
			$show_footer_featured_item = true;
			if (is_page()){
				$hidden_objects = get_field_object('hide_objects');

				if(!empty($hidden_objects)){
				  $hidden_objects_value = $hidden_objects['value'];

				  if(empty($hidden_objects_value)){
				    $hidden_objects_value = Array();
				  }

				  $show_footer_featured_item = array_search('hide_last_featured_content', $hidden_objects_value) === false;
				}
			} ?>


		<?php if ($show_footer_featured_item): ?>
			<!-- section -->
			<section class="section section-inverted section-medium-padding css-animate on-hover">

				<div class="section-background enhance-img" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/resources/random_background.jpg);">
				</div>

				<div class="container on-top-relative">
					<div class="row">
						<div class="col-sm-6">
							<div class="animatable move-up">
								<h3 class="section-title" style="margin-top: 80px;">
									<?php _e( 'The team', 'html5blank' ) ?>
								</h3>
								<p class="section-paragraph" style="margin-bottom: 20px;">
									<?php _e( 'Let Giada and her team take care of you.', 'html5blank' ) ?>
								</p>
							</div>

							<div class="animatable fade-in-up">
								<a href="<?php echo get_permalink( get_page_by_path( __( 'meet', 'html5blank' ) ) ); ?>" class="btn btn-primary btn-outlined">
									<?php _e( 'Meet us', 'html5blank' ); ?>
								</a>
							</div>
						</div>
						<div class="col-sm-6 text-center">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/chief_of_staff.png" height="250" />
						</div>
					</div>

				</div>

			</section>
			<!-- /section -->
		<?php endif; ?>


			<section class="section section-large-padding">
				<div class="container text-center">
					<div class="rating" style="margin-bottom: 40px;">
						<div>
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/stars.png" height="40" />
						</div>
						<p>
							<?php echo sprintf( __( 'More than %s guests like you recommended us on:', 'html5blank' ), '300' ); ?>
						</p>
					</div>
					<div class="row">
						<div class="col-sm-3" style="margin-bottom: 20px;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/airbnb_logo.png" height="40" />
						</div>
						<div class="col-sm-3" style="margin-bottom: 20px;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/tripadvisor_logo.png" height="40" />
						</div>
						<div class="col-sm-3" style="margin-bottom: 20px;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/booking_logo.png" height="40" />
						</div>
						<div class="col-sm-3" style="margin-bottom: 50px;">
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/facebook_logo.png" height="40" />
						</div>
					</div>

					<div class="text-center">
						<a href="<?php echo get_permalink( get_page_by_path( __( 'contact-us', 'html5blank' ) ) ); ?>" class="btn btn-primary">
							<?php _e( 'Contact us', 'html5blank' ); ?>
						</a>
					</div>
				</div>
			</section>


			<!-- footer -->
			<section class="section section-medium-padding text-center">
				<div class="section-background" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/resources/section_background.png);">
				</div>

				<div class="container on-top-relative">
					<!-- copyright -->
					<div>
						<img src="<?php echo get_template_directory_uri(); ?>/img/resources/logotype.png" height="30" />
					</div>
					<br>
					<p class="small">
						&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>.
					</p>
					<!-- /copyright -->
				</div>


			</section>
			<!-- /footer -->

		</div>
		<!-- /layout-container -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
