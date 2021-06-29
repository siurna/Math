<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <a href=" <?php the_permalink(); ?>" class="post">
            <div class="post__content">
                <?php $cover_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'large');?>
                <?php if ($cover_img) : ?>
                    <div class="post__image">
                        <?= $cover_img; ?>
                    </div>
                <?php endif; ?>
                <div class="post__title">
                    <h5>
                        <?php the_title(); ?>
                    </h5>                           
                </div>
                <div class="post__excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <div class="post__more ">
                    <p>
                        <strong class="btn small">
                            <?php esc_html_e( 'Skaityti daugiau', 'math'); ?>
                        </strong>
                    </p>
                </div>
            </div>
        </a>
    <?php endwhile; ?>
<?php endif; ?>