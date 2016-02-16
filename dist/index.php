<?php get_header(); ?>

<div class="container">
	<div class="page-header">
		<h1><?php _e( 'Latest Posts', 'html5blank' ); ?></h1>
	</div>
</div>

	<main role="main">
		<!-- section -->
		<section class="container">

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
