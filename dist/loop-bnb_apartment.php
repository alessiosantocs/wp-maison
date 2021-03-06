
<?php
$index = 0;

if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class("bnb_apartment-item css-animate on-hover hover"); ?>>

		<!-- post thumbnail background -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<?php
			$index = $index + 1;
			$thumbnail_position = get_field('featured_image_position'); ?>
			<div class="bnb_apartment-background-image"
					 data-lazy="<?php
						 $size = ($index == 1) ? 'full' : 'large';
						 $attachment = wp_get_attachment_image_src(get_post_thumbnail_id(), $size);
						 echo $attachment[0]; ?>"
					 style="
					 	background-position: <?php echo $thumbnail_position ?>;
					 "></div>
			<?php // the_post_thumbnail('', array('class' => 'hidden')); ?>
		<?php endif; ?>
		<!-- /post thumbnail background -->

		<div class="bnb_apartment-content">
			<div class="container">
				<div class="animatable move-up">
					<!-- post title -->
					<h3 class="bnb_apartment-item-name">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h3>
					<!-- /post title -->

					<!-- post details -->
					<div class="excerpt bnb_apartment-excerpt">
						<?php html5wp_excerpt('html5wp_index'); ?>
					</div>
					<!-- /post details -->
				</div>


				<div class="bnb_apartment-button-container animatable fade-in-up">
					<a href="<?php the_permalink(); ?>" class="btn btn-primary">
						<?php _e( 'Description & photos', 'html5blank' ); ?>
					</a>
				</div>

			</div>
		</div>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article class="container section">
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
