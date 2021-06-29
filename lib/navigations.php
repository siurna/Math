<?php
if ( ! function_exists( 'math_register_nav_menu' ) ) {
 
    function math_register_nav_menu(){
        register_nav_menus( array(
            'primary_menu' => __( 'Primary Menu', 'math' ),
            'language_switcher' => __( 'Language Switcher', 'math'),
            'mobile_sub_menu' => __( 'Mobile Sub Menu', 'math' ),
            'footer_menu'  => __( 'Footer Menu', 'math' ),
            'footer_info_menu'  => __( 'Footer Info Menu', 'math' ),
        ) );
    }
    add_action( 'after_setup_theme', 'math_register_nav_menu', 0 );
}