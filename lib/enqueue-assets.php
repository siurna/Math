<?php

// Main Theme Assets
function math_assets() {
    // Styles
    wp_enqueue_style( 'math-google-fonts', '//fonts.googleapis.com/css2?family=Raleway:wght@300;400;700&display=swap', array(), '1.0.0', 'all');
    wp_enqueue_style( 'math-stylesheet', get_template_directory_uri() . '/dist/assets/css/bundle.css', array('math-google-fonts'), '1.0.0', 'all');

    // Scripts
    wp_enqueue_script( 'math-in-view', get_template_directory_uri() . '/vendor/in-view.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'math-scripts', get_template_directory_uri() . '/dist/assets/js/bundle.js', array('math-in-view'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'math_assets');

// Theme Admin Assets
function math_admin_assets() {
    // Styles
    wp_enqueue_style( 'math-admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', array(), '1.0.0', 'all');

    // Scripts
    wp_enqueue_script( 'math-admin-scripts', get_template_directory_uri() . '/dist/assets/js/admin.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'math_admin_assets');