<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wolffpress
 */

/*

IMPORTANT CLASSES:

Content in the following classes will be shifted left right or center based on the variables in _measurements.scss:
header-left 
header-center
header-right

Use this class in conjunction with header-left, header-center, or header-right to denote if a section is used for the logo.
This will prevent the logo from shrinking beyond the min-width set in _measurements.scss:
header-logo

*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<header id="masthead" class="site-header" role="banner">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wolffpress' ); ?></a>
		<!-- Use header-left, header-center, header-right inside header-wrapper to organize your header based on the variables located in _measurements.scss  -->
		<div class="header-wrapper">
			<!-- The header-logo class is a class that goes on the header section where the logo is housed. This applies the logo's min-width to that container -->
			<div class="header-left header-logo"><a href="/"><img src="<?= get_template_directory_uri() . '/assets/images/logo.png' ?>"></a></div>
			<div class="header-center">
				<nav id="site-navigation" role="navigation">
					<div id="hamburger-menu" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<div class="hamburger-top"></div>
						<div class="hamburger-middle"></div>
						<div class="hamburger-bottom"></div>
					</div>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'container_id' => 'primary-menu-container', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
			<div class="header-right">
				<div class="phone"><a href="tel:5555555555">(555) 555 5555</a></div>
				<div class="email"><a href="mailto:admin@email.com">admin@email.com</a></div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
