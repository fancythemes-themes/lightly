<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?>
<!DOCTYPE html>

<!--[if IEMobile 7 ]>
<html <?php language_attributes(); ?> class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7 ]>
<html <?php language_attributes(); ?> class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>
<html <?php language_attributes(); ?> class="no-js ie8 oldie"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="container">

	<header class="header wrap" role="banner">
		<div id="inner-header" class="clearfix">
			<p id="logo" class="site-branding col480 left h1">
				<?php lightly_site_brand(); ?></p>

			<?php if ( is_active_sidebar( 'Header Sidebar' ) ) :?>
				<div id="sidebar-top" class="col480 right">
					<?php dynamic_sidebar( 'header-sidebar' ); ?>
				</div>
			<?php else: ?>
				<div id="search-header" class="col300 right">
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav class="primary-nav clearfix" role="navigation">
				<?php 	wp_nav_menu( array(
					'theme_location'  => 'primary',
					'container_class' => 'primary-menu col940 clearfix'
				) ); ?>
			</nav>
		<?php endif; ?>
	</header>
