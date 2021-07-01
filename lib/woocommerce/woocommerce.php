<?php 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_before_cart_totals',10 );

remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

// Remove breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Remove pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Remove default content wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

add_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_coupon_form', 15 );
// Add Main content wrapper
function math_wrapper_start() {
    echo '<div id="main">';
}
add_action('woocommerce_before_main_content', 'math_wrapper_start', 10);

function math_wrapper_end() {
    echo '</div>';
}
add_action('woocommerce_after_main_content', 'math_wrapper_end', 10);


///////////////////
/* Product Page */
/////////////////

function math_before_quantity_field() {
    echo "<div class='quantity__wrapper'>";
    echo "<div class='qty-label'>";
    echo _e( 'Kiekis', 'math' );
    echo "</div>";
    echo "<div class='quantity__input__wrapper'>";
    echo "<button id='qty-dec' class='qty-control' type='button'>-</button>";
}
add_action('woocommerce_before_quantity_input_field', 'math_before_quantity_field', 10);

function math_after_quantity_field() {
    echo "<button id='qty-inc' class='qty-control' type='button'>+</button>";
    echo "</div>";
    echo "</div>";
}
add_action('woocommerce_after_quantity_input_field', 'math_after_quantity_field', 10);

// remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
add_action( 'woocommerce_after_add_to_cart_button', 'woocommerce_output_all_notices', 30);



function math_before_add_to_cart_button() {
    echo '<div class="add-to-cart__wrapper">';
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'math_before_add_to_cart_button', 10 );

function math_after_add_to_cart_button() {
    echo '</div>';
}
add_action( 'woocommerce_after_add_to_cart_button', 'math_after_add_to_cart_button', 10 );

function woocommerce_custom_single_add_to_cart_text() {
    return __( 'Į krepšelį', 'woocommerce' ); 
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 

// Remove product meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes' , 10);




// Change related products number per page
function math_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'math_related_products_args', 20 );

// Remove tabs
function math_reviews_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Removes the reviews tab

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'math_reviews_product_tabs', 98 );
function math_additional_info_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'math_additional_info_product_tabs', 99 );

// Add product reviews
// add_action( 'woocommerce_after_single_product_summary', 'comments_template', 17 );

function math_display_product_tags() { 
    global $products;
    $product_id = $product->id;
    $terms = get_the_terms( $product_id, 'product_tag' );
    if ($terms) :
        echo '<div class="product-tags">';
            foreach ( $terms as $term ) : 
                $dont_show = get_field('dont_show_tag_on_page', $term);
                if ($dont_show != true) : 
                    echo '<span class="product-tag">' . $term->name . '  </span>';
                endif;
            endforeach;
        echo '</div>';
    endif;
};
add_action( 'woocommerce_shop_loop_item_title' , 'math_display_product_tags', 15 );

// Add Add To Cart Button
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Show cart contents / total Ajax
 */
function math_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<div class="navbar__user-area__cart__count"><?= WC()->cart->get_cart_contents_count() ?></div>
	<?php
	$fragments['div.navbar__user-area__cart__count'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'math_header_add_to_cart_fragment' );

// Change excerpt length
function math_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'math_custom_excerpt_length', 999 );


/*
* Changing the maximum quantity to 55 for all the WooCommerce products
*/

function woocommerce_quantity_input_max_callback( $max, $product ) {
	$max = 55;  
	return $max;
}
add_filter( 'woocommerce_quantity_input_max', 'woocommerce_quantity_input_max_callback', 10, 2 );

function custom_cart_max_qty( $args, $product ) {
    $args['max_value'] = 55;
    return $args;
}
add_filter( 'woocommerce_quantity_input_args', 'custom_cart_max_qty', 10, 2 );



/* Checkout */ 



function math_email_domain_autofill() { ?>
    <p class="form-row form-row-wide">
        <button class="email-domain">@gmail.com</button>
        <button class="email-domain">@yahoo.com</button>
        <button class="email-domain">@hotmail.com</button>
    </p>
<?php
}
add_action( 'woocommerce_after_checkout_billing_form', 'math_email_domain_autofill', 10 );

