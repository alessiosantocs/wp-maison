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
				<?php $value_proposition = get_field('value_proposition'); ?>
				<h1 class="section-title <?php if(strlen($value_proposition) > 57){echo 'section-title-longest';}elseif(strlen($value_proposition) > 52){echo 'section-title-long';} ?>"><?php echo get_field('value_proposition'); ?></h1>
				<p class="section-paragraph"><?php echo get_field('value_proposition_subtitle'); ?></p>

				<?php
				$call_to_action = get_field('call_to_action');
				if ( !empty($call_to_action) ): ?>

					<a href="<?php echo get_field('call_to_action_url'); ?>" class="btn btn-primary">
						<?php echo $call_to_action; ?>
					</a>

				<?php endif; ?>
			</div>

		</section>
		<!-- /section -->

<?php
$text_section_title = get_field('text_section_title');
$text_section_description = get_field('text_section_description');

if (!empty($text_section_title) && !empty($text_section_description)):?>
	<section class="section">
		<div class="container on-top-relative">
			<h3 class="section-title">
				<?php echo $text_section_title; ?>
			</h3>

			<p class="section-paragraph" style="margin-bottom: 0;">
				<?php echo $text_section_description; ?>
			</p>

		</div>
	</section>
<?php endif; ?>

		<?php

$posts = get_field('featured_sections');

if( $posts ): ?>
    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
    <section class="section section-inverted">
        <?php setup_postdata($post); ?>

				<div class="section-background">
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

					<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-outlined">
						<?php
						$featured_cta = get_field('featured_cta');
						if ( !empty($featured_cta) ): ?>

							<?php echo $featured_cta; ?>

						<?php else:	 ?>

							<?php the_title(); ?>

						<?php endif; ?>
					</a>
				</div>
		</section>
    <?php endforeach; ?>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>

<?php
// Featured links
$posts = get_field('featured_links');

if( $posts ): ?>
	<section class="section">
		<div class="container">
			<div class="row">

			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>

					<div class="col-sm-4">
						<h4 class="">
							<a href="<?php the_permalink(); ?>">
								<?php
								$featured_section_title = get_field('featured_title');
								if ( !empty($featured_section_title) ): ?>

									<?php echo $featured_section_title; ?>

								<?php else:	 ?>

									<?php the_title(); ?>

								<?php endif; ?>
							</a>
						</h4>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large', Array('style' => 'width: 100%; min-height: 200px;')); // Fullsize image for the single post ?>
						</a>
					</div>
			<?php endforeach; ?>
			</div>
		</div>
	</section>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>


	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
