<?php get_header(); ?>

	<div class="container">
		<div class="page-header">
			<h1><?php _e( 'Stay at Boschi di Montecalvi', 'html5blank' ); ?></h1>
			<h2 class="normal-font"><?php _e( 'Each accomodation is unique. Find the one that’s best for you', 'html5blank' ); ?></h2>
		</div>
	</div>

	<div class="bnb_apartment-container">
		<section>

			<?php get_template_part('loop-bnb_apartment'); ?>

			<?php // get_template_part('pagination'); ?>

		</section>
	</div>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
