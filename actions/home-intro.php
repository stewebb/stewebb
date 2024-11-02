<?php
/*
*
* Home intro section for Portfolio Expert section
*
*
*/



function portfolio_expert_intro_section_output()
{
  $portfolio_expert_dfimgh = get_template_directory_uri() . '/assets/img/man.png';
  $portfolio_expert_intro_img = get_theme_mod('portfolio_expert_intro_img', $portfolio_expert_dfimgh);
  $portfolio_expert_intro_subtitle = get_theme_mod('portfolio_expert_intro_subtitle', __('WELCOME TO MY WORLD', 'portfolio-expert'));
  $portfolio_expert_intro_title = get_theme_mod('portfolio_expert_intro_title', __('Hi, I’m Jone Lue <span>A Web Designer</span>', 'portfolio-expert'));
  $portfolio_expert_intro_desc = get_theme_mod('portfolio_expert_intro_desc');
  $portfolio_expert_header_btnurl = get_theme_mod('portfolio_expert_header_btnurl', '#');
  $portfolio_expert_intro_btntext = get_theme_mod('portfolio_expert_intro_btntext', __('Contact Me', 'portfolio-expert'));

?>
  <!-- home -->
  <section class="home-intro" id="sa-home">
    <div class="container">
      <div class="home-all-content">
        <div class="content">
          <?php if ($portfolio_expert_intro_subtitle) : ?>
            <h5><?php echo esc_html($portfolio_expert_intro_subtitle); ?></h5>
          <?php endif; ?>
          <?php if ($portfolio_expert_intro_title) : ?>
            <h1><?php
                echo wp_kses($portfolio_expert_intro_title, array(
                  'span' => array(),
                  'br' => array()
                ));
                ?></h1>
          <?php endif; ?>
          <?php if ($portfolio_expert_intro_desc) : ?>
            <p><?php echo esc_html($portfolio_expert_intro_desc); ?></p>
          <?php endif; ?>
          <?php if ($portfolio_expert_header_btnurl) : ?>
            <a href="<?php echo esc_url($portfolio_expert_header_btnurl); ?>" class="intro-btn"><?php echo esc_html($portfolio_expert_intro_btntext); ?></a>
          <?php endif; ?>
        </div>


        <?php if ($portfolio_expert_intro_img) : ?>
          <div class="hero-img">
            <img src="<?php echo esc_url($portfolio_expert_intro_img); ?>" alt="<?php esc_attr($portfolio_expert_intro_title); ?>">
          <?php else : ?>
            <div class="hero-img px-noimg">
            <?php endif; ?>
            </div>

          </div>
      </div>
  </section>

<?php
}
add_action('portfolio_expert_profile_intro', 'portfolio_expert_intro_section_output');
