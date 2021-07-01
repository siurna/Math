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