<?php
class MM_FooterFeaturedSectionWidget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'mm_footer_featured_section_widget',
			'description' => 'Footer featured section widget',
		);
		parent::__construct( 'my_widget', 'My Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$widget_id = $args['widget_id'];
		$widget_title = get_field('widget_title', "widget_" . $widget_id);
		$widget_paragraph = get_field('widget_paragraph', "widget_" . $widget_id);
		$widget_background_image = get_field('widget_background_image', "widget_" . $widget_id);
		$widget_side_image = get_field('widget_side_image', "widget_" . $widget_id);
		$widget_link = get_field('widget_link', "widget_" . $widget_id);

		?>

		<section class="section section-inverted section-medium-padding css-animate on-hover">

			<?php if (!empty($widget_background_image)): ?>
				<div class="section-background enhance-img" style="background-image: url(<?php echo $widget_background_image['url'] ?>);">
				</div>
			<?php endif; ?>

			<div class="container on-top-relative">
				<div class="row">
					
					<div class="col-sm-6">
						<div class="animatable move-up">
							<h3 class="section-title" style="margin-top: 80px;">
								<?php _e( $widget_title, 'html5blank' ) ?>
							</h3>
							<p class="section-paragraph" style="margin-bottom: 20px;">
								<?php _e( $widget_paragraph, 'html5blank' ) ?>
							</p>
						</div>

						<div class="animatable fade-in-up">
							<?php if (!empty($widget_link)): ?>
								<a href="<?php echo get_permalink( get_page_by_path( __( 'meet', 'html5blank' ) ) ); ?>" class="btn btn-primary btn-outlined">
									<?php _e( 'Meet us', 'html5blank' ); ?>
								</a>
							<?php endif; ?>
						</div>
					</div>

					<?php if (!empty($widget_side_image)): ?>
						<div class="col-sm-6 text-center">
							<img src="<?php echo $widget_side_image['url']; ?>" height="250" alt="<?php $widget_side_image['alt']; ?>" />
						</div>
					<?php endif; ?>
				</div>

			</div>

		</section>

		<?php
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}


add_action('widgets_init',
	create_function('', 'return register_widget("MM_FooterFeaturedSectionWidget");')
);
?>
