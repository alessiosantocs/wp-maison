<?php
  function maison_theme_customizer($wp_customize)
  {
    $wp_customize->add_section( 'maison_customization_section' , array(
      'title'       => __( 'Maison identity customization', 'maison' ),
      'priority'    => 30,
      'description' => 'Customize Maison theme. Change main logo, colors and fonts.'
    ) );

    // Navbar logo
    $maison_favicon = 'maison_navbar_logo';
    $wp_customize->add_setting( $maison_favicon );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $maison_favicon, array(
      'label'    => __( 'Navbar logo', 'maison' ),
      'description' => 'Upload a custom logo to show in navbar. Default: site title.',
      'section'  => 'maison_customization_section',
      'settings' => $maison_favicon
    ) ) );

    // Favicon & App icon
    $maison_favicon = 'maison_favicon';
    $wp_customize->add_setting( $maison_favicon );
    $wp_customize->add_control( new WP_Customize_Site_Icon_Control( $wp_customize, $maison_favicon, array(
      'label'    => __( 'Favicon and app icon', 'maison' ),
      'description' => 'Png icon to use as favicon and app icon. Default: No Favicon.',
      'section'  => 'maison_customization_section',
      'settings' => $maison_favicon
    ) ) );

    // Navbar style
    $maison_navbar_style = 'maison_navbar_style';
    $wp_customize->add_setting( $maison_navbar_style );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $maison_navbar_style, array(
      'label'    => __( 'Navbar style', 'maison' ),
      'description' => 'Choose how the navbar is displayed. Transparent or solid.',
      'section'  => 'maison_customization_section',
      'settings' => $maison_navbar_style,
      'type' => 'select',
      'choices' => array(
        'navbar_style_transparent' => __('Transparent', 'maison'),
        'navbar_style_solid' => __('Solid', 'maison')
      )
    ) ) );

    // Primary font
    // $maison_navbar_style = 'maison_primary_font_file';
    // $wp_customize->add_setting( $maison_navbar_style );
    // $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $maison_navbar_style, array(
    //   'label'    => __( 'Primary font file', 'maison' ),
    //   'description' => 'Upload a custom font for primary texts and titles.',
    //   'section'  => 'maison_customization_section',
    //   'settings' => $maison_navbar_style,
    //   'type' => 'file'
    // ) ) );
  }


  add_action( 'customize_register', 'maison_theme_customizer' );
 ?>
