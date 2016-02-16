<?php
  function maison_theme_customizer($wp_customize)
  {
    $wp_customize->add_section( 'maison_customization_section' , array(
      'title'       => __( 'Maison identity customization', 'maison' ),
      'priority'    => 30,
      'description' => 'Customize Maison theme. Change main logo, colors and fonts.'
    ) );

    $maison_favicon = 'maison_navbar_logo';
    $wp_customize->add_setting( $maison_favicon );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $maison_favicon, array(
      'label'    => __( 'Navbar logo', 'maison' ),
      'description' => 'Upload a custom logo. Default: site title.',
      'section'  => 'maison_customization_section',
      'settings' => $maison_favicon
    ) ) );

    $maison_favicon = 'maison_favicon';
    $wp_customize->add_setting( $maison_favicon );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $maison_favicon, array(
      'label'    => __( 'Favicon and app icon', 'maison' ),
      'section'  => 'maison_customization_section',
      'settings' => $maison_favicon
    ) ) );

  }


  add_action( 'customize_register', 'maison_theme_customizer' );
 ?>
