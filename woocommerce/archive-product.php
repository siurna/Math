<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); ?>

<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<section>
			<div class="flex-container">
				<div class="woocommerce-category-title">
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

					<?php
					$current_cat_id = get_queried_object_id();
					$filters = get_terms(
						array(
							'taxonomy' => get_queried_object()->taxonomy,
							'parent'   => $current_cat_id,
						)
					); ?>

					<?php foreach ( $filters as $filter ) : ?>

						<?php $show_filter = get_field('show_in_filter', 'term_' . $filter->term_id); ?>
						
						<?php if ( $show_filter[0] == 'show') : ?>
							
							<div class="filter__dropdown"> 
								
							<a href="/product-category/<?= $filter->slug; ?>"><?= $filter->name; ?> </a>
							
								<?php $filter_items = get_terms(
									array(
										'taxonomy' => get_queried_object()->taxonomy,
										'parent' => $filter->term_id
									)
								); ?>
								
								<div class="filter__dropdown__list"> 

									<?php foreach ( $filter_items as $filter_item) : ?>

										<button onclick="setGetParam('<?= $filter->slug; ?>', '<?= $filter_item->slug; ?>')">
											<?= $filter_item->name; ?> 
										</button>			
									
									<?php endforeach; ?>

								</div>
							</div>

						<?php endif; ?>

					<?php endforeach;?>

				</div>
				<?php
				//show category description
				$term_object = get_queried_object();
				?>
				
				<div class="woocommerce-category-description">

					<?php $shop_description = get_field('shop_description', 6); ?>

					<?php if ( is_shop() ) : ?>
						<?= $shop_description; ?>
					<?php else: ?>
						<p><?php echo $term_object->description; ?></p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>
<div id="content">
	<section class="flex-container archive-product">
	<?php
		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();
					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
			?>

			<?php global $wp_query; ?>

			<?php if ( paginate_links() ) : ?>
				<div class="flex-container--center">
					<div class="pagination">
						<?= paginate_links([
							'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
							'total'        => $wp_query->max_num_pages,
							'current'      => max(1, get_query_var('paged')),
							'format'       => '?paged=%#%',
							// 'type'         => 'plain',
							'prev_next'    => false,
							'add_args'     => false,
							'add_fragment' => '',
						]); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php 
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
	?>
	</section>
</div>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<script>
	function setGetParam(key, value) {
		if (history.pushState) {
			var params = new URLSearchParams(window.location.search);
			params.set(key, value);

			var filterPath = "?" + params.toString();

			document.location.href = filterPath;
		}
	}
</script>

<?php

get_footer( 'shop' );
