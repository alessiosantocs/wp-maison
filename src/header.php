<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<?php if ( get_theme_mod( 'maison_favicon' ) ) : ?>
			<link href="<?php echo get_theme_mod( 'maison_favicon' ); ?>" rel="shortcut icon">
			<link href="<?php echo get_theme_mod( 'maison_favicon' ); ?>" rel="apple-touch-icon-precomposed">
			<link href="<?php echo get_theme_mod( 'maison_favicon' ); ?>" rel="apple-touch-icon">
		<?php endif; ?>
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        // conditionizr.config({
        //     assets: '<?php echo get_template_directory_uri(); ?>',
        //     tests: {}
        // });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<div class="navbar-parent">
			<!-- header -->
			<header class="navbar navbar-maison header clear" role="banner">

				<div class="container">

					<!-- logo -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
							<div class="rotate">
				        <span class="icon-bar first-bar"></span>
				        <span class="icon-bar second-bar"></span>
							</div>
			      </button>

			      <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php if ( get_theme_mod( 'maison_navbar_logo' ) ) : ?>
								<img src="<?php echo esc_url( get_theme_mod( 'maison_navbar_logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo-img" height="80">
							<?php else : ?>
						    <hgroup>
									<?php bloginfo( 'name' ); ?>
						    </hgroup>
							<?php endif; ?>
			      </a>
			    </div>
					<!-- /logo -->

					<!-- nav -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<div style="padding: 15px;" class="visible-xs visible-sm">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img" height="80">
						</div>
						<?php html5blank_nav("pull-right"); ?>
					</div>
					<!-- /nav -->
				</div>

			</header>
			<!-- /header -->
		</div>

		<!-- layout-container -->
		<div class="layout-container">
