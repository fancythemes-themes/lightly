<?php

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

/**
 * Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lightly_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Add Posts Section */
	$wp_customize->add_section( 'theme_settings',
		array(
			'title'    => esc_html__( 'Theme Settings', 'lightly' ),
			'priority' => 20,
		)
	);

	/* Add Featured Posts setting option */
	$wp_customize->add_section( 'featured_slider',
		array(
			'title'    => esc_html__( 'Featured Slider', 'lightly' ),
			'priority' => 30,
		)
	);

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial( 'site_brand', array(
		'selector'        => '.header .site-branding',
		'settings'        => array( 'custom_logo' ),
		'render_callback' => 'lightly_site_brand',
	) );
}

add_action( 'customize_register', 'lightly_customize_register' );


/**
 * List of customizer settings
 */
function lightly_customize_items( $settings ) {

	/* Options for the Post settings Section */

	$settings[] = array(
		'label'                => esc_html__( 'Disable Category/Tags Meta Box on Single Page', 'lightly' ),
		'id'                   => 'disable_category_meta_box',
		'section'              => 'theme_settings',
		'default'              => 0,
		'priority'             => 5,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
	);

	$settings[] = array(
		'label'                => esc_html__( 'Disable Post Navigation Box on Single Page', 'lightly' ),
		'id'                   => 'disable_post_nav_box',
		'section'              => 'theme_settings',
		'default'              => 0,
		'priority'             => 10,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
	);

	$settings[] = array(
		'label'                => esc_html__( 'Disable Author Box on Single Page', 'lightly' ),
		'id'                   => 'disable_author_box',
		'section'              => 'theme_settings',
		'default'              => 0,
		'priority'             => 15,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
	);

	$settings[] = array(
		'label'                => esc_html__( 'Disable Related Posts Box on Single Page', 'lightly' ),
		'id'                   => 'disable_related_box',
		'section'              => 'theme_settings',
		'default'              => 0,
		'priority'             => 20,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
	);

	$settings[] = array(
		'label'             => esc_html__( 'Exclude Categories', 'lightly' ),
		'id'                => 'exclude_posts_categories',
		'section'           => 'theme_settings',
		'default'           => '',
		'priority'          => 20,
		'control'           => 'select',
		'sanitize_callback' => 'lightly_sanitize_choice',
		'choices'           => lightly_choice_taxonomy(),
		'description'       => esc_html__( 'Choose which categories to exclude from recent posts on homepage', 'lightly' )
	);


	/* Options for the Featured Slider Section */

	$settings[] = array(
		'label'                => esc_html__( 'Activate Featured Posts Slider', 'lightly' ),
		'id'                   => 'enable_featured_slider',
		'section'              => 'featured_slider',
		'default'              => 0,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
		'description'          => esc_html__( 'The Featured posts slider, check it to show on homepage', 'lightly' )
	);

	$settings[] = array(
		'label'             => esc_html__( 'Featured Posts Title', 'lightly' ),
		'id'                => 'featured_slider_title',
		'section'           => 'featured_slider',
		'default'           => esc_html__( 'Featured', 'lightly' ),
		'transport'         => 'postMessage',
		'control'           => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'description'       => esc_html__( 'The featured posts slider title', 'lightly' )
	);

	$settings[] = array(
		'label'             => esc_html__( 'Post Categories.', 'lightly' ),
		'id'                => 'featured_slider_category',
		'section'           => 'featured_slider',
		'default'           => '',
		'control'           => 'select',
		'sanitize_callback' => 'lightly_sanitize_choice',
		'choices'           => lightly_choice_taxonomy(),
		'description'       => esc_html__( 'Choose which categories to show on the slider', 'lightly' )
	);

	$settings[] = array(
		'label'             => esc_html__( 'Show Maximum Posts Number', 'lightly' ),
		'id'                => 'featured_slider_posts_number',
		'section'           => 'featured_slider',
		'default'           => 8,
		'control'           => 'select',
		'sanitize_callback' => 'lightly_sanitize_choice',
		'choices'           => array(
			'1'  => '1',
			'2'  => '2',
			'3'  => '3',
			'4'  => '4',
			'5'  => '5',
			'6'  => '6',
			'7'  => '7',
			'8'  => '8',
			'9'  => '9',
			'10' => '10'
		),
		'description'       => esc_html__( 'Select the number of posts to show on the slider.', 'lightly' )
	);

	$settings[] = array(
		'label'                => esc_html__( 'Enable Auto Slide', 'lightly' ),
		'id'                   => 'featured_slider_auto_slide',
		'section'              => 'featured_slider',
		'default'              => 1,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
		'description'          => esc_html__( 'Check if you want the slider do auto sliding.', 'lightly' )
	);

	$settings[] = array(
		'label'             => esc_html__( 'Auto slide timer', 'lightly' ),
		'id'                => 'featured_slider_auto_slide_timer',
		'section'           => 'featured_slider',
		'default'           => 5,
		'control'           => 'select',
		'sanitize_callback' => 'lightly_sanitize_choice',
		'choices'           => array(
			'1'  => '1',
			'2'  => '2',
			'3'  => '3',
			'4'  => '4',
			'5'  => '5',
			'6'  => '6',
			'7'  => '7',
			'8'  => '8',
			'9'  => '9',
			'10' => '10'
		),
		'description'       => esc_html__( 'Select the auto slide time, in second(s).', 'lightly' )
	);

	$settings[] = array(
		'label'                => esc_html__( 'Hide On Page 2 & Next', 'lightly' ),
		'id'                   => 'featured_slider_hide_next',
		'section'              => 'featured_slider',
		'default'              => 0,
		'control'              => 'checkbox',
		'sanitize_callback'    => 'lightly_sanitize_checkbox',
		'sanitize_js_callback' => 'lightly_sanitize_checkbox_js',
		'description'          => esc_html__( 'Hide the featured slider to show headline for page 2 and next.', 'lightly' )
	);

	return $settings;
}

add_filter( 'lightly_customizer_settings', 'lightly_customize_items' );


/**
 * Register Customize Settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lightly_customizer_settings( $wp_customize ) {

	$settings = apply_filters( 'lightly_customizer_settings', array() );

	$i = 1;

	foreach ( $settings as $setting ) {
		$wp_customize->add_setting( $setting['id'], array(
			'default'              => empty( $setting['default'] ) ? null : $setting['default'],
			'transport'            => empty( $setting['transport'] ) ? null : $setting['transport'],
			'capability'           => empty( $setting['capability'] ) ? 'edit_theme_options' : $setting['capability'],
			'theme_supports'       => empty( $setting['theme_supports'] ) ? null : $setting['theme_supports'],
			'sanitize_callback'    => empty( $setting['sanitize_callback'] ) ? null : $setting['sanitize_callback'],
			'sanitize_js_callback' => empty( $setting['sanitize_js_callback'] ) ? null : $setting['sanitize_js_callback'],
			'type'                 => empty( $setting['type'] ) ? null : $setting['type'],
		) );

		$setting['control_id'] = empty( $setting['control_id'] ) ? $setting['id'] : $setting['control_id'];

		if ( 'image' === $setting['control'] ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting['control_id'],
				array(
					'label'           => empty( $setting['label'] ) ? null : $setting['label'],
					'section'         => empty( $setting['section'] ) ? null : $setting['section'],
					'settings'        => $setting['id'],
					'default'         => empty( $setting['default'] ) ? '' : $setting['default'],
					'priority'        => empty( $setting['priority'] ) ? $i : $setting['priority'],
					'active_callback' => empty( $setting['active_callback'] ) ? null : $setting['active_callback'],
					'description'     => empty( $setting['description'] ) ? null : $setting['description'],
				)
			) );
		} else if ( 'color' === $setting['control'] ) {
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting['control_id'],
				array(
					'label'           => empty( $setting['label'] ) ? null : $setting['label'],
					'section'         => empty( $setting['section'] ) ? null : $setting['section'],
					'settings'        => $setting['id'],
					'default'         => empty( $setting['default'] ) ? '' : $setting['default'],
					'priority'        => empty( $setting['priority'] ) ? $i : $setting['priority'],
					'active_callback' => empty( $setting['active_callback'] ) ? null : $setting['active_callback'],
					'description'     => empty( $setting['description'] ) ? null : $setting['description'],
				)
			) );
		} else {
			$wp_customize->add_control( $setting['control_id'], array(
				'settings'        => $setting['id'],
				'default'         => empty( $setting['default'] ) ? '' : $setting['default'],
				'label'           => empty( $setting['label'] ) ? null : $setting['label'],
				'section'         => empty( $setting['section'] ) ? null : $setting['section'],
				'type'            => empty( $setting['control'] ) ? null : $setting['control'],
				'choices'         => empty( $setting['choices'] ) ? null : $setting['choices'],
				'input_attrs'     => empty( $setting['input_attrs'] ) ? null : $setting['input_attrs'],
				'priority'        => empty( $setting['priority'] ) ? $i : $setting['priority'],
				'active_callback' => empty( $setting['active_callback'] ) ? null : $setting['active_callback'],
				'description'     => empty( $setting['description'] ) ? null : $setting['description'],
			) );
		}

		$i ++;
	}
}

add_action( 'customize_register', 'lightly_customizer_settings', 100 );


/**
 * Binds JS for Live Theme Customizer Preview
 */
function lightly_customize_preview_js() {
	wp_enqueue_script( 'lightly-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'lightly_customize_preview_js' );
