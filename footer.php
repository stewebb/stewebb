<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Portfolio Expert
 */

?>

<footer id="colophon" class="site-footer pt-3 pb-3">
	<div class="container">
		<div class="info-news site-info text-center">
			<?php
			do_action('portfolio_expert_fmain');
			?>
		</div><!-- .site-info -->
	</div><!-- .container -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>