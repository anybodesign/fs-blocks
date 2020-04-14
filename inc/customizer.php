<?php defined('ABSPATH') or die();
/**
 * FS Onepage Customizer functionality
 *
 * @package WordPress
 * @subpackage FS_Onepage
 * @since 1.0
 * @version 1.0
 */
 
 
 // Customizer Settings
 
function fs_customize_register($wp_customize) {
	 
	 
	// Create Some Sections
	
	$wp_customize->add_section('fs_options_section', array(
		'title' 		=> __('Theme Options', 'fs-onepage'),
		'description' 	=> __('Theme customisation', 'fs-onepage'),
		'priority'		=> 30,
	));
	$wp_customize->add_section('fs_color_section', array(
		'title' 		=> __('Theme Colors', 'fs-onepage'),
		'description' 	=> __('Colors customisation', 'fs-onepage'),
		'priority'		=> 40,
	));
	
	
	// Theme Colors
	
	
		// Primary color
		
		$wp_customize->add_setting('primary_color', array(
			'default'			=> '303030',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'primary_color_ctrl', array(
			'label'		=> __('Primary color', 'fs-onepage'),
			'section'	=> 'colors',
			'settings'	=> 'primary_color',
		)));
		
		// Secondary color
		
		$wp_customize->add_setting('secondary_color', array(
			'default'			=> '4682B4',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'secondary_color_ctrl', array(
			'label'		=> __('Secondary color', 'fs-onepage'),
			'section'	=> 'colors',
			'settings'	=> 'secondary_color',
		)));
		
		// Contrast color
		
		$wp_customize->add_setting('third_color', array(
			'default'			=> '909090',
			'sanitize_callback'	=> 'sanitize_hex_color',
			'capability'		=> 'edit_theme_options',
			'type'				=> 'theme_mod',
			'transport'			=> 'refresh', 
		));
		$wp_customize->add_control( new WP_Customize_Color_control($wp_customize, 'third_color_ctrl', array(
			'label'		=> __('Contrast color', 'fs-onepage'),
			'section'	=> 'colors',
			'settings'	=> 'third_color',
		)));

		
	// Theme Options
	

		// Carousel for Posts
		
		$wp_customize->add_setting('carousel_posts', array(
			'default'	=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',				
		));
		$wp_customize->add_control('carousel_posts_ctrl', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display your posts like a carousel', 'fs-onepage'),
			'section'		=> 'fs_options_section',
			'settings'		=> 'carousel_posts',
		));	
	
		// Open News in Modals
		
		$wp_customize->add_setting('modals', array(
			'default'	=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',				
		));
		$wp_customize->add_control('modals_ctrl', array(
			'type'			=> 'checkbox',
			'label'			=> __('Open your posts with Fancybox (available in a future release)', 'fs-onepage'),
			'section'		=> 'fs_options_section',
			'settings'		=> 'modals',
		));	

	
	// Theme settings


		// Site logo
		
		$wp_customize->add_setting('site_logo', array(
			'default'				=> '',
			'sanitize_callback'		=> 'esc_url_raw'
		));
		
		$wp_customize->add_control( new WP_Customize_Image_control($wp_customize, 'site_logo_ctrl', array(
			'label'			=> __('Site Logo', 'fs-onepage'),
			'section'		=> 'title_tagline',
			'settings'		=> 'site_logo',
		)));	
		
		
		// Footer text
		
		$wp_customize->add_setting('footer_text', array(
			'default'				=> '',
			'sanitize_callback'		=> 'sanitize_text_field'
		));
		$wp_customize->add_control('footer_text_ctrl', array(
			'label'			=> __('Custom footer text', 'fs-onepage'),
			'description'	=> __('Add a custom text instead of the year and blog name.', 'fs-onepage'),
			'section'		=> 'fs_options_section',
			'settings'		=> 'footer_text',
		));	
		
		// WP Credits
		
		$wp_customize->add_setting('display_wp', array(
			'default'			=> false,
			'sanitize_callback'	=> 'fs_customizer_sanitize_checkbox',		
		));
		
		$wp_customize->add_control('display_wp_ctrl', array(
			'type'			=> 'checkbox',
			'label'			=> __('Display WordPress Link', 'fs-onepage'),
			'section'		=> 'fs_options_section',
			'settings'		=> 'display_wp',
		));
	 
}
add_action('customize_register', 'fs_customize_register');


// Sanitize

function fs_customizer_sanitize_checkbox( $input ) {
	if ( $input === true || $input === '1' ) {
		return '1';
	}
	return '';
}


// Customizer Colors Output

function fs_colors() {
	?>
	<style>
		.front-page-content::after,
		.fancybox-arrow::after,
		input[type="submit"],
		.action-btn,
		button.action-btn,
		input[type=submit].action-btn,
		thead,
		input[type="text"].focus-visible, 
		input[type="email"].focus-visible, 
		input[type="tel"].focus-visible, 
		input[type="url"].focus-visible,
		input[type="date"].focus-visible,
		input[type="password"].focus-visible,
		input[type="file"].focus-visible,
		input[type="number"].focus-visible,
		input[type="search"].focus-visible,
		textarea.focus-visible, 
		select.focus-visible,
		a.focus-visible .post-title,
		.widget_categories ul li.current-cat a,
		.widget_categories ul li a:hover, 
		.widget_categories ul li a.focus-visible,
		.widget_nav_menu ul li.current-cat a,
		.widget_nav_menu ul li a:hover, 
		.widget_nav_menu ul li a.focus-visible,
		.slick-dots li button:hover,
		.slick-dots li button.focus-visible,
		.skiplinks a,
		.wp-block-file a.wp-block-file__button,
		.wp-block-button .wp-block-button__link,
		.sub-menu > li a:hover, 
		.sub-menu > li a.focus-visible,
		.sub-menu > li.current-menu-item a,
		.acf-block-gallery-figure .acf-block-gallery-caption,
		.page-banner,
		.page-banner::after { 
			background-color: <?php echo get_theme_mod('primary_color', '#303030'); ?>; 
		}
		.has-primary-color-background-color {
			background-color: <?php echo get_theme_mod('primary_color', '#303030'); ?> !important; 			
		}
		
		.wp-block-gallery .blocks-gallery-image figcaption, 
		.wp-block-gallery .blocks-gallery-item figcaption { 
			background: <?php echo get_theme_mod('primary_color', '#303030'); ?>; 
		}
		legend,
		.formfield-radio input[type="radio"].focus-visible + span,
		.formfield-radio input[type="checkbox"].focus-visible + span,
		#menu-toggle span,
		#menu-toggle span::before,
		#menu-toggle span::after,
		.onepage-menu > li.current-menu-item > a,
		.slick-dots li button {
			border-color: <?php echo get_theme_mod('primary_color', '#303030'); ?>;
		}
		.onepage-menu > li > a:hover,
		.onepage-menu > li > a.focus-visible,
		.site-title a:hover,
		.site-title a.focus-visible,
		.has-text-color.has-primary-color-color {
			color: <?php echo get_theme_mod('primary_color', '#303030'); ?>;
		}
		
		@media only screen and (min-width: 45em) {
			
			.main-menu > li.current-menu-item > a {
				border-color: <?php echo get_theme_mod('primary_color', '#303030'); ?>;
			}
			.main-menu > li > a:hover,
			.main-menu > li > a.focus-visible {
				color: <?php echo get_theme_mod('primary_color', '#303030'); ?>;
			}
		}
		
		.formfield-radio input[type="radio"] + label::after,
		.formfield-radio input[type="radio"] + span::after,
		body::after,
		.wp-block-file a.wp-block-file__button:hover,
		.wp-block-file a.wp-block-file__button.focus-visible,
		.wp-block-button .wp-block-button__link:hover,
		.wp-block-button .wp-block-button__link.focus-visible {
			background-color: <?php echo get_theme_mod('secondary_color', '#4682B4'); ?>;
		}
		.has-secondary-color-background-color {
			background-color: <?php echo get_theme_mod('secondary_color', '#4682B4'); ?> !important;
		}

		.formfield-checkbox input[type="checkbox"] + label::after,
		.formfield-checkbox input[type="checkbox"] + span::after,
		.content-area p a:not([class*="action-btn"]),
		.content-area p a:not([class*="action-btn"]):active,
		.has-text-color.has-secondary-color-color {
			color: <?php echo get_theme_mod('secondary_color', '#4682B4'); ?>
		}
		.formfield-select--container {
			border-top-color: <?php echo get_theme_mod('secondary_color', '#4682B4'); ?>;
		}
		legend,
		.content-area p a:not([class*="action-btn"]) {
			border-color: <?php echo get_theme_mod('secondary_color', '#4682B4'); ?>;
		}
		
		.has-third-color-background-color {
			background-color: <?php echo get_theme_mod('third_color', '#909090'); ?> !important; 			
		}
		.has-text-color.has-third-color-color {
			color: <?php echo get_theme_mod('third_color', '#909090'); ?> !important; 			
		}		
		
	</style>
	<?php
}
add_action('wp_head','fs_colors');
