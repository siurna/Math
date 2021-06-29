<?php

function math_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Section with Article and Image.
        acf_register_block_type(array(
            'name'              => 'article-and-image',
            'title'             => __('Article & Image'),
            'description'       => __('Section with Article and Image with options.'),
            'render_template'   => 'template-parts/blocks/article-and-image.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
        ));

        // Section with Article and Heading.
        acf_register_block_type(array(
            'name'              => 'article-and-heading',
            'title'             => __('Article & Heading'),
            'description'       => __('Section with Article and Heading with options.'),
            'render_template'   => 'template-parts/blocks/article-and-heading.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
        ));

        // Section with Article and Heading.
        acf_register_block_type(array(
            'name'              => 'narrow-text',
            'title'             => __('Narrow Text'),
            'description'       => __('Narrow text field in the center of container.'),
            'render_template'   => 'template-parts/blocks/narrow-text.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
        ));
    }
}
add_action('acf/init', 'math_acf_init_block_types');
