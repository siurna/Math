<?php
require_once('lib/enqueue-assets.php');
require_once('lib/theme-support.php');
require_once('lib/ics.php');
require_once('lib/wp-rest-api.php');
require_once('lib/custom-post-types.php');
require_once('lib/gutenberg.php');
require_once('lib/navigations.php');
require_once('lib/woocommerce/woocommerce.php');

if (function_exists('acf_add_options_page')) {

    acf_add_options_sub_page(array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'parent_slug' => 'themes.php',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Promotions',
        'menu_title' => 'Promotions',
        'parent_slug' => 'woocommerce',
    ));

}

function math_filter_products($tax_query)
{

    // 	// Commented better version of categories pick up but needs a test!

    // 	// $current_cat_id = get_queried_object_id();
    // 	// $filters = get_terms(
    // 	// 	array(
    // 	// 		'taxonomy' => get_queried_object()->taxonomy,
    // 	// 		'parent'   => $current_cat_id,
    // 	// 	)
    // 	// );

    // 	// foreach ( $filters as $filter ) :

    // 	// 	$show_filter = get_field('show_in_filter', 'term_' . $filter->term_id);

    // 	// 	if ( $show_filter[0] == 'show') :

    // 	// 		if ( isset($_GET[$filter->slug])) {
    // 	// 			$filter_term = $_GET[$filter->slug];

    // 	// 		}
    // 	// 	endif;
    // 	// endforeach;

    $categories = get_categories(array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'child_of' => 0,
    ));

    foreach ($categories as $category) {

        if (isset($_GET[$category->slug])) {
            $filter_term = $_GET[$category->slug];

            $tax_query->set('tax_query', array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $filter_term,
                ),

            ));
        }
    }
}

add_action('woocommerce_product_query', 'math_filter_products');

function dump($var)
{
    echo '<pre>';
    echo var_dump($var);
    echo '</pre>';
}


add_action('wp_footer', 'cart_update_qty_script');
function cart_update_qty_script()
{
    if (is_cart()) :
        ?>
        <script type="text/javascript">
            (function ($) {
                $(function () {
                    $('div.woocommerce').on('change', 'input.qty', function (e) {
                        $("[name='update_cart']").trigger('click');
                    });
                });
            })(jQuery);
        </script>
    <?php
    endif;
}


function math_custom_languages_list()
{
    $languages = icl_get_languages('skip_missing=0&orderby=asc');
    if (!empty($languages)) {
        echo '<div><ul id="menu-language-switcher" class="menu">';
        echo '<li class="dropdown">';
        echo '<a href="#">';
        foreach ($languages as $l) {
            if ($l['active'] != '0') {
                if ($l['country_flag_url']) {
                    echo '<img src="' . $l['country_flag_url'] . '" alt="' . $l['language_code'] . '" class="lang-icon" />';
                }
            }
        }
        echo strtoupper(ICL_LANGUAGE_CODE);
        echo '</a>';
        echo '<ul class="sub-menu">';
        foreach ($languages as $l) {
            if ($l['active'] == '0') {
                echo '<li>';
                echo '<a href="' . $l['url'] . '">';
                if ($l['country_flag_url']) {
                    echo '<img src="' . $l['country_flag_url'] . '" alt="' . $l['language_code'] . '" class="lang-icon" />';
                }
                echo icl_disp_language($l['native_name']);
                echo '</a>';
                echo '</li>';
            }
        }
        echo '</ul>';
        echo '</li>';
        echo '</div>';
    }
}

// Filter works well for changing Woo Select options button names, but problem is that it stops rendering home page
add_filter('woocommerce_product_add_to_cart_text', function ($text) {
    global $product;

    if (!$product) {
        return $text;
    }

    if ($product->is_type('variable')) {
        $text = $product->is_purchasable() ? __('Daugiau', 'woocommerce') : __('Read more', 'woocommerce');
    }

    return $text;
}, 10);

function wc_varb_price_range( $wcv_price, $product ) {

    $prefix = sprintf('%s: ', __('From', 'wcvp_range'));

    $wcv_reg_min_price = $product->get_variation_regular_price( 'min', true );
    $wcv_min_sale_price    = $product->get_variation_sale_price( 'min', true );
    $wcv_max_price = $product->get_variation_price( 'max', true );
    $wcv_min_price = $product->get_variation_price('min', true);

    if (!is_product()) {
        return $wcv_price;
    }

    $wcv_price = ( $wcv_min_sale_price == $wcv_reg_min_price ) ?
        wc_price( $wcv_reg_min_price ) :
        '<del>' . wc_price( $wcv_reg_min_price ) . '</del>' . '<ins>' . wc_price( $wcv_min_sale_price ) . '</ins>';

    return ( $wcv_min_price == $wcv_max_price ) ?
        $wcv_price :
        '';
}

add_filter( 'woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2 );