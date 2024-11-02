<?php

/**
 * The file for header all actions
 *
 *
 * @package Portfolio Expert
 */


// Portfolio Expert mene style
function portfolio_expert_main_menu_output()
{
	$portfolio_expert_menubar_show = get_theme_mod('portfolio_expert_menubar_show', 1);
	if (empty($portfolio_expert_menubar_show)) {
		return;
	}

	$portfolio_expert_menubarlogo_show = get_theme_mod('portfolio_expert_menubarlogo_show', 1);
	$portfolio_expert_mainmenu_show = get_theme_mod('portfolio_expert_mainmenu_show', 1);
	$portfolio_expert_menusearch_show = get_theme_mod('portfolio_expert_menusearch_show');

?>
	<div class="menu-bar ">
		<div class="container">
			<div class="menubar-content">
				<?php
				if ($portfolio_expert_menubarlogo_show) {
					portfolio_expert_logo_output();
				}
				?>
				<div class="portfolio-expert-container menu-inner">
					<?php if ($portfolio_expert_mainmenu_show) : ?>
						<nav id="site-navigation" class="main-navigation">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'menu_id'        => 'portfolio-expert-menu',
								'menu_class'        => 'portfolio-expert-menu',
							));
							?>
						</nav><!-- #site-navigation -->
					<?php endif; ?>
					<?php if ($portfolio_expert_menusearch_show) : ?>
						<div class="serach-show">
							<div class="besearch-icon">
								<a href="#" id="besearch"><i class="fas fa-search"></i></a>
							</div>
							<div id="bspopup" class="soff">
								<div id="affsearch" class="sopen">
									<?php get_search_form(); ?>
									<small class="beshop-cradit"><?php esc_html_e('Portfolio Expert Theme By', 'portfolio-expert') ?> <a id="stcradit" class="scrad" target="_blank" title="<?php esc_attr_e('Portfolio Expert Theme', 'portfolio-expert') ?>" href="<?php echo esc_url('https://wpthemespace.com/product/portfolio-expert/'); ?>"><?php esc_html_e('Wp Theme Space', 'portfolio-expert') ?></a></small>
									<button data-widget="remove" id="sremoveClass" class="sclose" type="button">×</button>
								</div>
							</div>
						</div>
				</div>
			<?php endif; ?>

			</div>

		</div>
	</div>

<?php
}
add_action('portfolio_expert_main_menu', 'portfolio_expert_main_menu_output');



// Portfolio Expert mene style
function portfolio_expert_mobile_menu_output()
{
?>
	<div id="wsm-menu" class="mobile-menu-bar wsm-menu">
		<div class="container">
			<nav id="mobile-navigation" class="mobile-navigation">
				<button id="mmenu-btn" class="menu-btn" aria-expanded="false">
					<span class="mopen"><?php esc_html_e('Menu', 'portfolio-expert'); ?></span>
					<span class="mclose"><?php esc_html_e('Close', 'portfolio-expert'); ?></span>
				</button>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'menu_id'        => 'wsm-menu-ul',
					'menu_class'        => 'wsm-menu-has',
				));
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

<?php
}
add_action('portfolio_expert_mobile_menu', 'portfolio_expert_mobile_menu_output');


function portfolio_expert_logo_output()
{
	$portfolio_expert_hide_tagline = get_theme_mod('portfolio_expert_hide_tagline');
?>
	<div class="head-logo-sec">
		<?php if (has_custom_logo()) : ?>
			<div class="site-branding brand-logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php endif; ?>
		<?php
		if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
			<div class="site-branding brand-text">
				<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					$portfolio_expert_description = get_bloginfo('description', 'display');
					if (($portfolio_expert_description || is_customize_preview()) && !empty($portfolio_expert_hide_tagline)) :
					?>
						<p class="site-description"><?php echo $portfolio_expert_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
													?></p>
					<?php endif; ?>
				<?php endif; ?>

			</div><!-- .site-branding -->
		<?php endif; ?>
	</div>
<?php
}
