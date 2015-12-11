<?php /* Template Name: Home Template */ get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="section section-primary">

			<?php
			$value_proposition_background = get_field('value_proposition_background');
			if ( !empty($value_proposition_background) ): ?>
				<div class="section-background" style="background-image: url('<?php echo $value_proposition_background['url']; ?>');">
				</div>
			<?php endif; ?>

			<div class="container on-top-relative">
				<h1 class="section-title"><?php echo get_field('value_proposition'); ?></h1>
				<p class="section-paragraph"><?php echo get_field('value_proposition_subtitle'); ?></p>

				<?php
				$call_to_action = get_field('call_to_action');
				if ( !empty($call_to_action) ): ?>

					<a href="<?php echo get_field('call_to_action_url'); ?>" class="btn btn-transparent-white">
						<?php echo $call_to_action; ?>
					</a>

				<?php endif; ?>
			</div>

		</section>
		<!-- /section -->


		<?php

$posts = get_field('featured_sections');

if( $posts ): ?>
    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
    <section class="section section-inverted">
        <?php setup_postdata($post); ?>

				<div class="section-background enhance-img">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</div>

				<div class="container on-top-relative">
					<h3 class="section-title">
						<?php
						$featured_section_title = get_field('featured_title');
						if ( !empty($featured_section_title) ): ?>

							<?php echo $featured_section_title; ?>

						<?php else:	 ?>

							<?php the_title(); ?>

						<?php endif; ?>
					</h3>
					<p class="section-paragraph">
						<?php echo get_field('page_excerpt'); ?>
					</p>

					<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-outlined"><?php the_title(); ?></a>
				</div>
		</section>
    <?php endforeach; ?>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>


	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
