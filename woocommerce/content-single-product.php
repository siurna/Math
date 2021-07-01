<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section id="content">
	<div class="flex-container">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */

				do_action( 'woocommerce_single_product_summary' );
				?>

				<?php if ( have_rows('countdown', 'option')) : ?>

					<div class="countdown__wrapper expired">

					<?php $i = 0; ?>
						<?php while ( have_rows('countdown', 'option')) : the_row(); ?>

							<?php global $product; ?>
							<?php $product_id = $product->get_id(); ?>
							<?php $show_counter_in = get_sub_field('products_to_show_counter');?>

							<?php if ( $show_counter_in == false ) : ?>
								<script>
									document.querySelector(".countdown__wrapper").classList.remove("expired");
								</script>
								<div class="countdown__text">
									<p><?php the_sub_field('countdown_text'); ?></p>
								</div>
								<div class="countdown__timer">
									<div class="countdown__timer__item">
										<div class="countdown__timer__item--num" id="day--global--<?= $i; ?>"></div>
										<p><?php esc_html_e( 'DIENOS', 'math' ); ?></p>
									</div>
									<div class="countdown__timer__separator">:</div>
									<div class="countdown__timer__item">
										<div class="countdown__timer__item--num" id="hour--global--<?= $i; ?>"></div>
										<p><?php esc_html_e( 'VALANDOS', 'math' ); ?></p>
									</div>
									<div class="countdown__timer__separator">:</div>
									<div class="countdown__timer__item">
										<div class="countdown__timer__item--num" id="min--global--<?= $i; ?>"></div>
										<p><?php esc_html_e( 'MINUTĖS', 'math' ); ?></p>
									</div>
									<div class="countdown__timer__separator">:</div>
									<div class="countdown__timer__item">
										<div class="countdown__timer__item--num" id="sec--global--<?= $i; ?>"></div>
										<p><?php esc_html_e( 'SEKUNDĖS', 'math' ); ?></p>
									</div>
								</div>
								<?php $countdown_end = get_sub_field('countdown_end_date'); ?>
								<script>
									// Set the date we're counting down to
									var countDownDate<?= $i; ?> = new Date("<?= $countdown_end; ?>").getTime();
									
									// Update the count down every 1 second
									var x = setInterval(function() {

										// Get today's date and time
										var now = new Date().getTime();

										// Find the distance between now and the count down date
										var distance = countDownDate<?= $i; ?> - now;

										// Time calculations for days, hours, minutes and seconds
										var days = '0' + Math.floor(distance / (1000 * 60 * 60 * 24));
										var hours = '0' + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
										var minutes = '0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
										var seconds = '0' + Math.floor((distance % (1000 * 60)) / 1000);

										// Display the result in the element
										document.querySelector("#day--global--<?= $i; ?>").innerHTML = days.slice(-2);
										document.querySelector("#hour--global--<?= $i; ?>").innerHTML = hours.slice(-2);
										document.querySelector("#min--global--<?= $i; ?>").innerHTML = minutes.slice(-2);
										document.querySelector("#sec--global--<?= $i; ?>").innerHTML = seconds.slice(-2);

										// If the count down is finished, write some text
										if (distance < 0) {
											clearInterval(x);
											document.querySelector(".countdown__wrapper").classList.add("expired");
										}
									}, 1000);
								</script>
							<?php else: ?>
								<?php foreach ($show_counter_in as $key => $selected_product) : ?>
									<?php if ( $product_id == $selected_product->ID) : ?>
										<script>
											document.querySelector(".countdown__wrapper").classList.remove("expired");
										</script>
										<div class="countdown__text">
											<p><?php the_sub_field('countdown_text'); ?></p>
										</div>
										<div class="countdown__timer">
											<div class="countdown__timer__item">
												<div class="countdown__timer__item--num" id="day--local--<?= $i; ?>"></div>
												<p><?php esc_html_e( 'DIENOS', 'math' ); ?></p>
											</div>
											<div class="countdown__timer__separator">:</div>
											<div class="countdown__timer__item">
												<div class="countdown__timer__item--num" id="hour--local--<?= $i; ?>"></div>
												<p><?php esc_html_e( 'VALANDOS', 'math' ); ?></p>
											</div>
											<div class="countdown__timer__separator">:</div>
											<div class="countdown__timer__item">
												<div class="countdown__timer__item--num" id="min--local--<?= $i; ?>"></div>
												<p><?php esc_html_e( 'MINUTĖS', 'math' ); ?></p>
											</div>
											<div class="countdown__timer__separator">:</div>
											<div class="countdown__timer__item">
												<div class="countdown__timer__item--num" id="sec--local--<?= $i; ?>"></div>
												<p><?php esc_html_e( 'SEKUNDĖS', 'math' ); ?></p>
											</div>
										</div>
										<?php $countdown_end = get_sub_field('countdown_end_date'); ?>
										<script>
											// Set the date we're counting down to
											var countDownDateLocal<?= $i; ?> = new Date("<?= $countdown_end; ?>").getTime();
											
											// Update the count down every 1 second
											var x = setInterval(function() {

												// Get today's date and time
												var now = new Date().getTime();

												// Find the distance between now and the count down date
												var distance = countDownDateLocal<?= $i; ?> - now;

												// Time calculations for days, hours, minutes and seconds
												var days = '0' + Math.floor(distance / (1000 * 60 * 60 * 24));
												var hours = '0' + Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
												var minutes = '0' + Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
												var seconds = '0' + Math.floor((distance % (1000 * 60)) / 1000);

												// Display the result in the element
												document.querySelector("#day--local--<?= $i; ?>").innerHTML = days.slice(-2);
												document.querySelector("#hour--local--<?= $i; ?>").innerHTML = hours.slice(-2);
												document.querySelector("#min--local--<?= $i; ?>").innerHTML = minutes.slice(-2);
												document.querySelector("#sec--local--<?= $i; ?>").innerHTML = seconds.slice(-2);

												// If the count down is finished, write some text
												if (distance < 0) {
													clearInterval(x);
													document.querySelector(".countdown__wrapper").classList.add("expired");
												}
											}, 1000);
										</script>	
									<?php endif; ?>						
								<?php endforeach; ?>
							<?php endif; ?>
							<?php $i++; ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>

				<?php if( have_rows('shipping_info', 'option')) : ?>
					<div class="shipping-info__wrapper">
						<?php while( have_rows('shipping_info', 'option') ) : the_row(); ?>

							<?php $shipping_icon = get_sub_field('shipping_icon'); ?>

							<?php $show_info_in = get_sub_field('products_to_show_info_in'); ?>
							<?php $show_info_from_date = strtotime(get_sub_field('shipping_show_from')); ?>
							<?php $show_info_to_date = strtotime(get_sub_field('shipping_show_to')); ?>

							<?php if ((!$show_info_from_date || $show_info_from_date <= time()) && (!$show_info_to_date || $show_info_to_date >= time())) : ?>

								<?php if ( $product_id == $show_info_in[0]->ID || $show_info_in[0]->ID == null) : ?>

									<div class="shipping-info__content">

										<?php if($shipping_icon) : ?>

											<div class="shipping-info__icon">
												<img src="<?= $shipping_icon['url']; ?>" alt="<?= $shipping_icon['alt']; ?>">
											</div>

										<?php endif; ?>

										<div class="shipping-info__text">
											<?php the_sub_field('shipping_text'); ?>
										</div>
										
									</div>

								<?php endif; ?>

							<?php endif; ?>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>				
			</div>
		</div>

		<div class="flex-container flex-container--sm">
			<?php if(have_rows('product_badges')): ?>
				<?php while(have_rows('product_badges')) : the_row(); ?>
					<?php $badge_icon = get_sub_field('badge_icon'); ?>
					<div class="product-badge__wrapper">
						<div class="product-badge__img">
							<img src="<?= $badge_icon['url']; ?>" alt="">
						</div>
						<div class="product-badge__txt">
							<p>
								<?php the_sub_field('badge_text'); ?>
							</p>
						</div>
					</div>			
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
		
	</div>
</section>
<?php do_action( 'woocommerce_after_single_product' ); ?>
