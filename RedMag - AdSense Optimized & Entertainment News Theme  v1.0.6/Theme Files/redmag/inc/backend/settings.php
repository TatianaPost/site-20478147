<?php

	// Theme Version
	if ( ! function_exists( 'redmag_theme_version' ) ) :
		function redmag_theme_version() {
			$redmag_theme = wp_get_theme(get_template());
			return $redmag_theme->get('Version');
		}
	endif;

	// Theme Name
	if ( ! function_exists( 'redmag_theme_name' ) ) :
		function redmag_theme_name() {
			$redmag_theme = wp_get_theme();
			return $redmag_theme->get('Name');
		}
	endif;

	function redmag_load_settings()
	{
		$settings=array(
			'home'=> array(
				'name_home'			=>esc_html__('Home', 'redmag' ),
				'live_preview'		=>esc_url('http://redmag.nanoagency.co/'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home1.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
			'home-2'=> array(
				'name_home'			=>esc_html__('Home 2', 'redmag' ),
				'live_preview'		=>esc_url('http://redmag.nanoagency.co/home-2'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home2.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
			'home-3'=> array(
				'name_home'			=>esc_html__('Home 3', 'redmag' ),
				'live_preview'		=>esc_url('http://redmag.nanoagency.co/home-3'),
				'demo_xml'			=>esc_url('http://guide.nanoagency.co'),
				'demo_image'		=>get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
				'class_install'		=>esc_attr('show'),
				'class_active'		=>esc_attr('hidden'),
				'class_deactivate'	=>esc_attr('hidden')
			),
		);

		return $settings;
	}
	$redmag_settings = redmag_load_settings();
?>