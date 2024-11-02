<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Portfolio Expert
 */

$portfolio_expert_blog_container = get_theme_mod('portfolio_expert_blog_container', 'container');
$portfolio_expert_blog_layout = get_theme_mod('portfolio_expert_blog_layout', 'rightside');

if (is_active_sidebar('sidebar-1') && $portfolio_expert_blog_layout != 'fullwidth') {
	$portfolio_expert_blog_column = 'col-lg-9';
} else {
	$portfolio_expert_blog_column = 'col-lg-12';
}
get_header();
?>

<div class="<?php echo esc_attr($portfolio_expert_blog_container); ?> mt-5 mb-5 pt-5 pb-5 nxsingle-post">
	<div class="row main-content">
		<?php if (is_active_sidebar('sidebar-1') && $portfolio_expert_blog_layout == 'leftside') : ?>
			<div class="col-lg-3 widget-sidebar">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
		<div class="<?php echo esc_attr($portfolio_expert_blog_column); ?> site-content">
			<main id="primary" class="site-main">

				<?php
				while (have_posts()) :
					the_post();

					get_template_part('template-parts/content', get_post_type());

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'portfolio-expert') . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'portfolio-expert') . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div>
		<?php if (is_active_sidebar('sidebar-1') && $portfolio_expert_blog_layout == 'rightside') : ?>
			<div class="col-lg-3 widget-sidebar">
				<?php get_sidebar(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
