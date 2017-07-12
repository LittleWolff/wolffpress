<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wolffpress
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-wrapper">
			<div class="footer-content-wrapper">
				<div class="footer-left">

					<!-- sample footer menu, feel free to use or delete -->
					<nav id="footer-navigation" class="footer-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'footer-menu' ) ); ?>
					</nav>
				
				</div>

				<div class="footer-center">
						<!-- center content goes here -->
				</div>

				<div class="footer-right">
					<!-- sample contact info, feel free to use or delete -->
					<div class="footer-contact">
						<div class="phone"><a href="tel:5555555555">(555) 555 5555</a></div>
						<div class="email"><a href="mailto:admin@email.com">admin@email.com</a></div>
						<div class="social"><a href="#"><img class="social-element" src="<?= get_template_directory_uri() . '/assets/images/social-instagram.png' ?>"></a></div>
					</div>
				</div>
			</div>
			<!-- Some sites have a copyright at the bottom feel free to put it here -->
			<div class="footer-copyright-wrapper"><p class="footer-copyright">WolffPress © 2017. All (or No) Rights Reserved.</p></div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
