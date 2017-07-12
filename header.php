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
		<div class="header-wrapper">
			<div class="header-left"><a class="brand" href="/"><img src="<?= get_template_directory_uri() . '/assets/images/logo.png' ?>"></a></div>

				<nav id="site-navigation" class="header-center" role="navigation">
					<div id="hamburger-menu" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<div class="hamburger-top"></div>
						<div class="hamburger-middle"></div>
						<div class="hamburger-bottom"></div>
					</div>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
				</nav><!-- #site-navigation -->

			<div class="header-right">
				<div class="phone"><a href="tel:5555555555">(555) 555 5555</a></div>
				<div class="email"><a href="mailto:admin@email.com">admin@email.com</a></div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
