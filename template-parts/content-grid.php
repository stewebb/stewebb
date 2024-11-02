<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Portfolio Expert
 */
$portfolio_expert_blog_layout = get_theme_mod('portfolio_expert_blog_layout', 'rightside');
if ($portfolio_expert_blog_layout == 'fullwidth' || !is_active_sidebar('sidebar-1')) {
	$portfolio_expert_grid = 4;
} else {
	$portfolio_expert_grid = 6;
}
$portfolio_expert_categories = get_the_category();
if ($portfolio_expert_categories) {
	$portfolio_expert_category = $portfolio_expert_categories[mt_rand(0, count($portfolio_expert_categories) - 1)];
} else {
	$portfolio_expert_category = '';
}
?>
<div class="col-lg-<?php echo esc_attr($portfolio_expert_grid); ?> grid-item mb-5">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="grid-item-post">
			<?php if (has_post_thumbnail()) : ?>
				<div class="grid-item-img">
					<a class="grid-item-img-link" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
			<?php endif; ?>
			<div class="grid-item-details">
				<?php if ($portfolio_expert_category) : ?>
					<div class="grid-item-topmeta">
						<a class="catimg-top" href="<?php echo esc_url(get_category_link($portfolio_expert_category)); ?>"><?php echo esc_html($portfolio_expert_category->name); ?></a>
					</div>
				<?php endif; ?>
				<?php the_title('<h2 class="grid-item-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
				<?php the_excerpt(); ?>
				<?php if ('post' === get_post_type()) :
				?>
					<div class="entry-meta grid-meta">
						<?php
						portfolio_expert_posted_by();
						?>
						<span class="grid-meta-date"><?php echo get_the_date(); ?></span>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>

		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>