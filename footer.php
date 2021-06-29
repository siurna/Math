        <?php get_template_part( 'template-parts/instagram' ); ?>
        
        <footer>
            <div class="flex-container">
                <div class="footer-col--xs footer__brand">
                    <?php the_custom_logo(); ?>
                    <?php if ( have_rows('social_links', 'option') ) : ?>

                        <div class="footer__social">       
                            <?php while ( have_rows('social_links', 'option') ) : the_row(); ?>

                                <?php $social_icon = get_sub_field('social_icon'); ?>
                                
                                <a href="<?php the_sub_field('social_link'); ?>" target="_blank" class="footer__social__link">
                                    <img src="<?= $social_icon['url']; ?>" alt="<?= $social_icon['alt']; ?>">
                                </a>

                            <?php endwhile; ?>
                        </div>

                    <?php endif; ?>
                </div>
                <div class="footer-col--xs footer-menu--left">
                    <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer_menu',
                            'container' => 'nav',
                            'menu_class' => 'nav--footer'
                        ) 
                    ); ?>
                </div>
                <div class="footer-col--sm footer-menu--right">
                    <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer_info_menu',
                            'container' => 'nav',
                            'menu_class' => 'nav--footer'
                        ) 
                    ); ?>
                    <?php if ( have_rows( 'payment_methods', 'option' ) ) : ?>
                        <div class="footer__payment">

                            <?php while ( have_rows( 'payment_methods', 'option' ) ) : the_row(); ?>

                                <?php $pay_logo = get_sub_field('provider_logo'); ?>
                                <?php $pay_link = get_sub_field('provider_link'); ?>
                                
                                <div class="footer__payment__icon">

                                    <?php if ( $pay_logo && $pay_link ) : ?>
                                        <a href="<?= $pay_link; ?>" target="_blank">
                                            <img src="<?= $pay_logo['url']; ?>" alt="<?= $pay_logo['alt']; ?>">
                                        </a>
                                    <?php else : ?>
                                        <img src="<?= $pay_logo['url']; ?>" alt="<?= $pay_logo['alt']; ?>">
                                    <?php endif; ?>
                                </div>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="footer-col--md">
                    <div class="form-row--lg">
                        <h5><?php esc_html_e( 'MATH naujienlaiškis', 'math' ); ?></h5>    
                    </div>
                    <form action="">
                        <div class="form-row">
                            <label for="user-email" name="user-email" class="block">
                                <?php esc_html_e( 'El. Pašto adresas *', 'math' ); ?>
                            </label>
                            <input type="email" id="user-email" required>
                        </div>
                        <div class="form-row">
                            <label for="aggree-privacy" class="aggree">
                                <input type="checkbox" name="aggree-privacy" id="aggree-privacy">   
                                <?php esc_html_e( 'Užpildydamas šią formą aš sutinku su MATH privatumo politika.', 'math' ); ?>
                            </label>
                        </div>
                        <div class="form-row">
                            <label for="aggree-newsletter" class="aggree">
                                <input type="checkbox" name="aggree-newsletter" id="aggree-newsletter">
                                <?php esc_html_e( 'Sutinku gauti naujienas apie MATH produktus nurodytu el. paštu.', 'math' ); ?>
                            </label>                        
                        </div>
                        <div class="form-row">
                            <input type="submit" value="<?php esc_html_e( 'Užsisakyti naujienas', 'math' ); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>