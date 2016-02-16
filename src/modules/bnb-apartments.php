<?php
  add_action('init', 'create_post_type_bnb_apartment'); // Add our HTML5 Blank Custom Post Type

  // Create 1 Custom Post type for a Demo, called HTML5-Blank
  function create_post_type_bnb_apartment()
  {
    register_taxonomy_for_object_type('category', 'bnb_apartment'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'bnb_apartment');
    register_post_type('bnb_apartment', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Apartments', 'bnb_apartment'), // Rename these to suit
            'singular_name' => __('Apartment', 'bnb_apartment'),
            'add_new' => __('Add New', 'bnb_apartment'),
            'add_new_item' => __('Add New Apartment', 'bnb_apartment'),
            'edit' => __('Edit', 'bnb_apartment'),
            'edit_item' => __('Edit Apartment', 'bnb_apartment'),
            'new_item' => __('New Apartment', 'bnb_apartment'),
            'view' => __('View Apartment', 'bnb_apartment'),
            'view_item' => __('View Apartment', 'bnb_apartment'),
            'search_items' => __('Search Apartment', 'bnb_apartment'),
            'not_found' => __('No Apartments found', 'bnb_apartment'),
            'not_found_in_trash' => __('No Apartments found in Trash', 'bnb_apartment')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'rewrite' => array('slug' => 'accommodation'),
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
  }
 ?>
