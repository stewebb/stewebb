<?php

/**
 * Portfolio Expert Theme Customizer
 *
 * @package Portfolio Expert
 */


// adctive call back function for header social
if (!function_exists('portfolio_expert_header_social_callback')) :
	function portfolio_expert_header_social_callback()
	{
		if (get_theme_mod('portfolio_expert_header_social_show') == 1) {
			return true;
		} else {
			return false;
		}
	}
endif;

// adctive call back function for header social
if (!function_exists('portfolio_expert_menubar_callback')) :
	function portfolio_expert_menubar_callback()
	{
		if (get_theme_mod('portfolio_expert_menubar_show') == 1) {
			return true;
		} else {
			return false;
		}
	}
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function portfolio_expert_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	//select sanitization function
	function portfolio_expert_sanitize_select($input, $setting)
	{
		$input = sanitize_key($input);
		$choices = $setting->manager->get_control($setting->id)->choices;
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}
	function portfolio_expert_sanitize_image($file, $setting)
	{
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		);
		//check file type from file name
		$file_ext = wp_check_filetype($file, $mimes);
		//if file has a valid mime type return it, otherwise return default
		return ($file_ext['ext'] ? $file : $setting->default);
	}

	$wp_customize->add_setting('portfolio_expert_hide_tagline', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  ' ',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_hide_tagline', array(
		'label'      => __('Hide Site Tagline?', 'portfolio-expert'),
		'section'    => 'title_tagline',
		'settings'   => 'portfolio_expert_hide_tagline',
		'type'       => 'checkbox',
	));

	$wp_customize->add_panel('portfolio_expert_settings', array(
		'priority'       => 50,
		'title'          => __('Portfolio Expert Theme settings', 'portfolio-expert'),
		'description'    => __('All Portfolio Expert theme settings', 'portfolio-expert'),
	));
	$wp_customize->add_section('portfolio_expert_header', array(
		'title' => __('Portfolio Expert Header Settings', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio Expert theme header settings', 'portfolio-expert'),
		'panel'    => 'portfolio_expert_settings',

	));

	// Header Menu bar

	$wp_customize->add_setting('portfolio_expert_menubar_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_menubar_show', array(
		'label'      => __('Show Menubar Section?', 'portfolio-expert'),
		'section'    => 'portfolio_expert_header',
		'settings'   => 'portfolio_expert_menubar_show',
		'type'       => 'checkbox',
	));

	$wp_customize->add_setting('portfolio_expert_menubarlogo_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_menubarlogo_show', array(
		'label'      => __('Show Menubar Logo?', 'portfolio-expert'),
		'section'    => 'portfolio_expert_header',
		'settings'   => 'portfolio_expert_menubarlogo_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_expert_menubar_callback',

	));
	$wp_customize->add_setting('portfolio_expert_mainmenu_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_mainmenu_show', array(
		'label'      => __('Show Main Menu?', 'portfolio-expert'),
		'section'    => 'portfolio_expert_header',
		'settings'   => 'portfolio_expert_mainmenu_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_expert_menubar_callback',

	));
	$wp_customize->add_setting('portfolio_expert_menusearch_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  '',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_menusearch_show', array(
		'label'      => __('Show Menubar Search Icon?', 'portfolio-expert'),
		'section'    => 'portfolio_expert_header',
		'settings'   => 'portfolio_expert_menusearch_show',
		'type'       => 'checkbox',
		'active_callback' => 'portfolio_expert_menubar_callback',
	));

	//Portfolio Expert Home intro
	$wp_customize->add_section('portfolio_expert_intro', array(
		'title' => __('Agency Intro Settings', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Agency Intro section settings', 'portfolio-expert'),
		'panel'    => 'portfolio_expert_settings',
	));
	$wp_customize->add_setting('portfolio_expert_intro_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  1,
		'sanitize_callback' => 'absint',
		'transport'     => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_intro_show', array(
		'label'      => __('Show Agency Intro? ', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_intro_show',
		'type'       => 'checkbox',
	));
	$wp_customize->add_setting('portfolio_expert_intro_img', array(
		'capability'        => 'edit_theme_options',
		'default'           => get_template_directory_uri() . '/assets/img/man.png',
		'sanitize_callback' => 'portfolio_expert_sanitize_image',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control(
		$wp_customize,
		'portfolio_expert_intro_img',
		array(
			'label'    => __('Upload Profile Image', 'portfolio-expert'),
			'description'    => __('Image size should be 450px width & 460px height for better view.', 'portfolio-expert'),
			'section'  => 'portfolio_expert_intro',
			'settings' => 'portfolio_expert_intro_img',
		)
	));
	$wp_customize->add_setting('portfolio_expert_intro_subtitle', array(
		'default' => __('WELCOME TO MY WORLD', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_intro_subtitle', array(
		'label'      => __('Intro Subtitle', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_intro_subtitle',
		'type'       => 'text',
	));
	$wp_customize->add_setting('portfolio_expert_intro_title', array(
		'default' => __('Hi, I’m Jone Lue <span>A Web Designer</span>', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_intro_title', array(
		'label'      => __('Intro Title', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_intro_title',
		'type'       => 'text',
	));
	$wp_customize->add_setting('portfolio_expert_intro_desc', array(
		'default' => '',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_intro_desc', array(
		'label'      => __('Intro Description', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_intro_desc',
		'type'       => 'textarea',
	));
	$wp_customize->add_setting('portfolio_expert_header_social_show', array(
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'default'       =>  '',
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_header_social_show', array(
		'label'      => __('Show Header Social?', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_header_social_show',
		'type'       => 'checkbox',

	));
	// header social links start
	// Header facebook url
	$wp_customize->add_setting('portfolio_expert_header_btnurl', array(
		'default' => '#',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_header_btnurl', array(
		'label'      => __('Button url', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_hfacebook_link',
		'type'       => 'url',
		'active_callback' => 'portfolio_expert_header_social_callback',
	));
	$wp_customize->add_setting('portfolio_expert_intro_btntext', array(
		'default' => __('Contact Me', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_intro_btntext', array(
		'label'      => __('Button Text', 'portfolio-expert'),
		'section'    => 'portfolio_expert_intro',
		'settings'   => 'portfolio_expert_intro_btntext',
		'type'       => 'text',
	));


	//Portfolio Expert PLus blog settings
	$wp_customize->add_section('portfolio_expert_blog', array(
		'title' => __('Portfolio Expert Blog Settings', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio Expert theme blog settings', 'portfolio-expert'),
		'panel'    => 'portfolio_expert_settings',

	));
	$wp_customize->add_setting('portfolio_expert_blog_container', array(
		'default'        => 'container',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_expert_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_blog_container', array(
		'label'      => __('Container type', 'portfolio-expert'),
		'description' => __('You can set standard container or full width container. ', 'portfolio-expert'),
		'section'    => 'portfolio_expert_blog',
		'settings'   => 'portfolio_expert_blog_container',
		'type'       => 'select',
		'choices'    => array(
			'container' => __('Standard Container', 'portfolio-expert'),
			'container-fluid' => __('Full width Container', 'portfolio-expert'),
		),
	));

	$wp_customize->add_setting('portfolio_expert_blog_layout', array(
		'default'        => 'rightside',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_expert_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_blog_layout', array(
		'label'      => __('Select Blog Layout', 'portfolio-expert'),
		'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'portfolio-expert'),
		'section'    => 'portfolio_expert_blog',
		'settings'   => 'portfolio_expert_blog_layout',
		'type'       => 'select',
		'choices'    => array(
			'rightside' => __('Right Sidebar', 'portfolio-expert'),
			'leftside' => __('Left Sidebar', 'portfolio-expert'),
			'fullwidth' => __('No Sidebar', 'portfolio-expert'),
		),
	));
	$wp_customize->add_setting('portfolio_expert_blog_style', array(
		'default'        => 'grid',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_expert_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_blog_style', array(
		'label'      => __('Select Blog Style', 'portfolio-expert'),
		'section'    => 'portfolio_expert_blog',
		'settings'   => 'portfolio_expert_blog_style',
		'type'       => 'select',
		'choices'    => array(
			'grid' => __('Grid Style', 'portfolio-expert'),
			'list' => __('List Style', 'portfolio-expert'),
			'classic' => __('Classic Style', 'portfolio-expert'),
		),
	));
	//Portfolio Expert page settings
	$wp_customize->add_section('portfolio_expert_page', array(
		'title' => __('Portfolio Expert Page Settings', 'portfolio-expert'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Portfolio Expert theme blog settings', 'portfolio-expert'),
		'panel'    => 'portfolio_expert_settings',

	));
	$wp_customize->add_setting('portfolio_expert_page_container', array(
		'default'        => 'container',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_expert_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_page_container', array(
		'label'      => __('Page Container type', 'portfolio-expert'),
		'description' => __('You can set standard container or full width container for page. ', 'portfolio-expert'),
		'section'    => 'portfolio_expert_page',
		'settings'   => 'portfolio_expert_page_container',
		'type'       => 'select',
		'choices'    => array(
			'container' => __('Standard Container', 'portfolio-expert'),
			'container-fluid' => __('Full width Container', 'portfolio-expert'),
		),
	));
	$wp_customize->add_setting('portfolio_expert_page_header', array(
		'default'        => 'show',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'portfolio_expert_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('portfolio_expert_page_header', array(
		'label'      => __('Show Page header', 'portfolio-expert'),
		'section'    => 'portfolio_expert_page',
		'settings'   => 'portfolio_expert_page_header',
		'type'       => 'select',
		'choices'    => array(
			'show' => __('Show all pages', 'portfolio-expert'),
			'hide-home' => __('Hide Only Front Page', 'portfolio-expert'),
			'hide' => __('Hide All Pages', 'portfolio-expert'),
		),
	));




	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'portfolio_expert_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'portfolio_expert_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'portfolio_expert_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function portfolio_expert_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function portfolio_expert_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function portfolio_expert_customize_preview_js()
{
	wp_enqueue_script('portfolio-expert-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), PORTFOLIO_EXPERT_VERSION, true);
}
add_action('customize_preview_init', 'portfolio_expert_customize_preview_js');
