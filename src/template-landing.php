<?php /* Template Name: Landing Template */
get_header(); ?>

<?php
$show_page_header = true;
$show_featured_image = true;
$show_page_excerpt = true;
$show_page_content = true;
$show_sidebar = true;

$hidden_objects = get_field_object('hide_objects');

if(!empty($hidden_objects)){
  $hidden_objects_value = $hidden_objects['value'];

  if(empty($hidden_objects_value)){
    $hidden_objects_value = Array();
  }


  $show_page_header     = array_search('hide_page_header', $hidden_objects_value)     === false;
  $show_featured_image  = array_search('hide_featured_image', $hidden_objects_value)  === false;
  $show_page_excerpt    = array_search('hide_page_excerpt', $hidden_objects_value)    === false;
  $show_page_content    = array_search('hide_content', $hidden_objects_value)         === false;
  $show_sidebar         = array_search('hide_sidebar', $hidden_objects_value)         === false;
}

 ?>

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





<?php require_once 'modules/flex-layout.php'; ?>



	</main>


<style media="screen">
	<?php if(!$show_page_header): ?>
	.navbar-parent{
		display: none !important;
	}
	<?php endif;?>

	@media (max-width: 767px){
		.page-template-template-landing .section.section-large-padding .section-background{
			position: static;
			height: 310px;
	    width: 100%;
			background-size: cover;
	    background-position: right;
		}
	}
</style>


<?php // get_sidebar(); ?>

<?php //get_footer(); ?>
