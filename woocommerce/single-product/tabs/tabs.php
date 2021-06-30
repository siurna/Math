<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

?>
<?php $ingredients_tab = get_field('ingredients'); ?>
<?php $custom_tabs = get_field('product_info_tabs') ?>

<?php if ( $ingredients_tab || $custom_tabs || $product_tab ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs" role="tablist">
			<?php if ( ! empty( $product_tabs ) ) : ?>

				<!-- Default Woo Tabs -->
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>">
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>

			<!-- Ingridients Tab -->
			<?php $ingridients_tab_title = esc_attr__( 'Ingridients', 'math' ); ?>
			<?php if ($ingredients_tab) : ?>
				<li class="<?= $ingridients_tab_title ?>_tab" id="tab-title-<?= $ingridients_tab_title ?>" role="tab" aria-controls="tab-<?= $ingridients_tab_title ?>">
					<a href="#tab-<?= $ingridients_tab_title ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $ingridients_tab_title  . '_tab_title', $ingridients_tab_title, $ingridients_tab_title ) ); ?>
					</a>
				</li>
			<?php endif; ?>
			
			<!-- Custom Tabs -->
			<?php foreach ( $custom_tabs as $index => $custom_tab) :?>
				<li class="<?php echo esc_attr( $index ); ?>_tab" id="tab-title-<?php echo esc_attr( $index ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $index ); ?>">
					<a href="#tab-<?php echo esc_attr( $index ); ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $custom_tab['tab_heading'] . '_tab_title', $custom_tab['tab_heading'], $custom_tab['tab_heading'] ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>

		</ul>

		<!-- Default Woo Tabs Content -->
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<!-- Ingridients Tab Content -->
		<?php $ingredients = get_the_terms( $post->ID, 'ingredients' ); ?>
		<?php if ($ingredients) : ?>
			<?php $ingredients_copy = $ingredients; ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?= $ingridients_tab_title ?> panel entry-content wc-tab" id="tab-<?= $ingridients_tab_title ?>" role="tabpanel" aria-labelledby="tab-title-<?= $ingridients_tab_title ?>">
				<?php foreach ( $ingredients_copy as $ingredient ) : ?>
					<p class="ingridient"><?= $ingredient->name; ?><?= (next($ingredients_copy)) ?  ', ': '. '; ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<!-- Custom Tabs Content -->
		<?php foreach ( $custom_tabs as $index => $custom_tab) :?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $index ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $index ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $index ); ?>">
				<?php echo $custom_tab['tab_info']; ?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>
<?php endif; ?>