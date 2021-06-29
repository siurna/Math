<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= (is_home()) ? get_the_title( get_option('page_for_posts', true) ) : the_title(); ?> | <?php bloginfo( 'name' ); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="header__wrapper">
        <?php $announcement_text = get_field('announcement_text', 'option'); ?>
        <?php $announcement_link = get_field('announcement_link', 'option'); ?>
        <?php $left_for_freebie = get_field('announcement_how_much_for_freebie', 'option'); ?>
        <?php $accouncement_success_msg = get_field('announce_about_success', 'option'); ?>
        <?php $announcement_bg = get_field('announcement_color', 'option'); ?>
        <?php $hide_on_home = get_field('hide_on_home', 'option'); ?>
        <?php $announcement_off = get_field('turn_off_announcement_bar', 'option'); ?>

        <?php $freebie_price = get_field('freebie_price', 'option'); ?>
        <?php $cart_total = WC()->cart->total; ?>

        <?php if ( $announcement_text && $announcement_off[0] != 'off') : ?>
            
            <?php if ( is_front_page() && $hide_on_home[0] == 'hide' ) : ?>

                <?php $hide_on_home_style = 'display: none;'; ?>

            <?php else: ?>

                <?php $hide_on_home_style = ''; ?>

            <?php endif; ?>

            <div class="announcement" <?= $announcement_bg ? 'style="background-color:' . $announcement_bg . '; ' . $hide_on_home_style . ' "' : ''; ?> >

                <?php if ( $cart_total == 0 ) : ?>
                    <p>
                        <?= $announcement_text ?>
                    </p>

                    <?php if ( $announcement_link ) : ?>
                        <a href="<?= $announcement_link['url'] ?>" target="<?= $announcement_link['target']; ?>">
                            <?= $announcement_link['title']; ?>
                        </a>
                    <?php endif; ?>
                    
                <?php elseif ( $left_for_freebie && $cart_total < $freebie_price ) : ?>

                    
                    <?php $difference = $freebie_price - $cart_total; ?>

                    <?php $freebie_announcement = str_replace("PRICE", $difference , $left_for_freebie); ?>
                    
                    <p><?= $freebie_announcement; ?></p>

                <?php elseif ( $accouncement_success_msg && $cart_total > $freebie_price )  : ?>

                    <p><?= $accouncement_success_msg ?></p>

                <?php endif; ?>

                <button class="announcement__close">
                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64"><path d="M32 29.714L53.714 8 56 10.286 34.286 32 56 53.714 53.714 56 32 34.286 10.286 56 8 53.714 29.714 32 8 10.286 10.286 8 32 29.714z" fill="#162317" fill-rule="evenodd"/></svg>
                </button>
            </div>
        <?php endif; ?>

        <header class="main-header <?= ($announcement_text || $announcement_link) ? 'announcement-on' : ''; ?>">
            <div class="main-header__filling"></div>
            <div class="flex-container--between">
                <div class="main-navigation__toggler just-relative">
                    <span class="main-navigation__toggler-content">
                        <?php esc_html_e( 'Meniu', 'math' ); ?>   
                    </span>
                </div>
                <div class="main-navigation__toggler--mobile just-relative">
                    <span><img src="<?= get_template_directory_uri(); ?>/dist/assets/images/hamburger.png" alt="MENU"></span>
                </div>
                <div class="navbar__brand">
                    <?php the_custom_logo(); ?>
                </div>
                <?php if (class_exists( 'WooCommerce' )) : ?>
                    <div class="navbar__user-area">
                        <?php math_custom_languages_list(); ?>
                        <?php wp_nav_menu( array(
                            'theme_location' => 'language_switcher',
                        ));?>
                        <?php if ( is_user_logged_in() ) : ?>
                            <div class="navbar__user-area__login">
                                <a href="<?= esc_url( get_permalink(  get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                    <?php esc_html_e( 'Mano paskyra', 'math' ); ?>
                                </a>
                            </div>
                            <div class="navbar__user-area__cart">
                                <a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                    <img src="<?= get_template_directory_uri(); ?>/dist/assets/images/cart.png" alt="Cart" class="navbar__user-area__cart__icon">
                                    <div class="navbar__user-area__cart__count"><p><?= WC()->cart->get_cart_contents_count() ?></p></div>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="navbar__user-area__login">
                                <a href="<?= esc_url( get_permalink(  get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                    <?php esc_html_e( 'Prisijungti', 'math' ); ?>    
                                </a>
                            </div>
                            <div class="navbar__user-area__cart">
                                <a class="navbar__user-area__cart" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
                                    <img src="<?= get_template_directory_uri(); ?>/dist/assets/images/cart.png" alt="Cart" class="navbar__user-area__cart__icon">
                                    <div class="navbar__user-area__cart__count"><p><?= WC()->cart->get_cart_contents_count(); ?></p></div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </header>
        <?php wp_nav_menu( 
            array( 
                'theme_location' => 'mobile_sub_menu',
                'container' => 'nav',
                'menu_class' => 'nav-mobile--sub'
            ) 
        ); ?>
    </div>

    <div class="main-navigation">
        <div class="main-navigation__close">
            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64"><path d="M32 29.714L53.714 8 56 10.286 34.286 32 56 53.714 53.714 56 32 34.286 10.286 56 8 53.714 29.714 32 8 10.286 10.286 8 32 29.714z" fill="#162317" fill-rule="evenodd"/></svg>
        </div>
        <div class="flex-container">
            <?php wp_nav_menu( 
                array( 
                    'theme_location' => 'primary_menu',
                    'container' => 'nav'
                ) 
            ); ?>
        </div>
    </div>    
    <div class="mobile-navigation">
        <div class="mobile-navigation__close">
            <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 64 64"><path d="M32 29.714L53.714 8 56 10.286 34.286 32 56 53.714 53.714 56 32 34.286 10.286 56 8 53.714 29.714 32 8 10.286 10.286 8 32 29.714z" fill="#162317" fill-rule="evenodd"/></svg>
        </div>
        
        <div class="flex-container">
            <div class="mobile-navigation__menu">
                <?php wp_nav_menu( 
                    array( 
                        'theme_location' => 'primary_menu',
                        'container' => 'nav'
                    ) 
                ); ?>
            </div>
        </div>

        <div class="container">
            <?php if (class_exists( 'WooCommerce' )) : ?>
                <div class="mobile-navigation__user-area">
                    <?php if ( is_user_logged_in() ) : ?>
                        <div class="mobile-navigation__user-area__login">
                            <a href="<?= esc_url( get_permalink(  get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                <?php esc_html_e( 'Mano paskyra', 'math' ); ?>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="mobile-navigation__user-area__login">
                            <a href="<?= esc_url( get_permalink(  get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                <?php esc_html_e( 'Prisijungti', 'math' ); ?>    
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>