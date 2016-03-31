


			<?php
			global $footer_widget_area_id;
			if (empty($footer_widget_area_id)) {
				$footer_widget_area_id = 'widget-area-2';
			}

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
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($footer_widget_area_id)) ?>
			<!-- /section -->
		<?php endif; ?>


			<section class="section section-large-padding">
				<div class="container text-center">
					<div class="rating" style="margin-bottom: 40px;">
						<!-- <div>
							<img src="<?php echo get_template_directory_uri(); ?>/img/resources/stars.png" height="40" />
						</div> -->
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
			<section class="section section-medium-padding text-center footer">
				<div class="section-background" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/resources/section_background.png);">
				</div>

				<div class="container on-top-relative">
					<!-- copyright -->
					<div>
						<img src="<?php echo get_template_directory_uri(); ?>/img/resources/logotype.png" height="30" />
					</div>
					<div class="container footer-menu-container">
						<?php html5blank_footer_nav(); ?>
					</div>
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
		<script>var _gaq=[['_setAccount','UA-17185785-64'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));</script>

	</body>
</html>
