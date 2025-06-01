<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Portfolio Expert
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function portfolio_expert_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}
	$classes[] = 'theme-dark';
	return $classes;
}
add_filter('body_class', 'portfolio_expert_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function portfolio_expert_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'portfolio_expert_pingback_header');

function portfolio_expert_fmain_output()
{
?>
	<a href="<?php echo esc_url(__('https://wordpress.org/', 'portfolio-expert')); ?>">
		<?php
		/* translators: %s: CMS name, i.e. WordPress. */
		printf(esc_html__('Proudly powered by %s', 'portfolio-expert'), 'WordPress');
		?>
	</a>
	<span class="sep"> | </span>
<?php
	/* translators: 1: Theme name, 2: Theme author. */
	printf(esc_html__('%1$s by %2$s.', 'portfolio-expert'), '<a href="https://wpthemespace.com/product/portfolio-expert/">Portfolio Expert</a>', 'Wp Theme Space');
}
add_action('portfolio_expert_fmain', 'portfolio_expert_fmain_output');
