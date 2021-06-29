<?php $terms = get_the_terms( $post->ID, 'product_badges' ); ?>
<?php if ($terms) : ?>
    <div class="product-photo__badge">
        <?php foreach ( $terms as $term ) : ?>
            <?php $badge_image = get_field('product_badge_image', $term); ?>
            <img src="<?= $badge_image['url']; ?>" alt="<?= $badge_image['alt']; ?>">
        <?php endforeach; ?>
    </div>
<?php endif; ?>