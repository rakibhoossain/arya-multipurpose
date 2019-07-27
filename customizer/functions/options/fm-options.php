<?php

$defaults = arya_multipurpose_get_default_theme_options();

// Section - Footer
$wp_customize->add_section( 'arya_multipurpose_fm', 
	array(
		'priority'		=> 2,
		'title'			=> esc_html__( 'FM settings', 'arya-multipurpose' ),
	)
);

// FM streamming link
$wp_customize->add_setting( 'arya_multipurpose_fm_link', 
	array(
		'sanitize_callback'		=> 'esc_url_raw',
		'default'				=> $defaults['arya_multipurpose_fm_link'],
		'capability'        => 'edit_theme_options',
	)
);

$wp_customize->add_control( 
	'arya_multipurpose_fm_link',
	array(
		'label'				=> esc_html__( 'Streamming link', 'arya-multipurpose' ),
		'type'				=> 'text',
		'section' 			=> 'arya_multipurpose_fm',
	) 
);

// FM - Background
$wp_customize->add_setting( 'arya_multipurpose_fm_bg', 
	array(
		'sanitize_callback'		=> 'esc_url_raw',
		'default'				=> $defaults['arya_multipurpose_fm_bg'],
		'capability'        => 'edit_theme_options',
	)
);


$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'arya_multipurpose_fm_bg',
           array(
               'label'      => __( 'Background image', 'arya-multipurpose' ),
               'section'    => 'arya_multipurpose_fm',
               'settings'   => 'arya_multipurpose_fm_bg', 
           )
       )
   );

// FM - Logo text
$wp_customize->add_setting( 'arya_multipurpose_fm_text', 
	array(
		'sanitize_callback'		=> 'esc_url_raw',
		'default'				=> $defaults['arya_multipurpose_fm_text'],
		'capability'        => 'edit_theme_options',
	)
);


$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'arya_multipurpose_fm_text',
           array(
               'label'      => __( 'Logo text', 'arya-multipurpose' ),
               'section'    => 'arya_multipurpose_fm',
               'settings'   => 'arya_multipurpose_fm_text', 
           )
       )
   );

// FM - large Logo
$wp_customize->add_setting( 'arya_multipurpose_fm_lg_logo', 
	array(
		'sanitize_callback'		=> 'esc_url_raw',
		'default'				=> $defaults['arya_multipurpose_fm_lg_logo'],
		'capability'        => 'edit_theme_options',
	)
);


$wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'arya_multipurpose_fm_lg_logo',
           array(
               'label'      => __( 'Big logo', 'arya-multipurpose' ),
               'section'    => 'arya_multipurpose_fm',
               'settings'   => 'arya_multipurpose_fm_lg_logo', 
           )
       )
   );