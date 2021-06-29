<?php get_header(); ?>
    <section id="content">
        <div class="flex-container">
            <aside>
                <h1><?php the_title(); ?></h1>
                <?php $event_date = get_field('event_date'); ?>
                <?php if ( $event_date ) : ?>
                    <div class="post__date">
                        <h6><?= $event_date ?></h6>
                    </div>
                <?php endif; ?>
                <?php $past_event = get_field('the_content_of_the_previous_event'); ?>
                <?php if (!$past_event) : ?>
                    <div class="post__add-ics--left">
                        <a href="/wp-json/math/v1/events/?id=<?= get_the_ID(); ?>" class="btn"><?php esc_attr_e( 'Pridėti į kalendorių', 'math' ); ?></a>
                    </div>
                <?php else : ?>
                    <div class="post__add-ics--left">
                        <a href="<?= $past_event['url']; ?>" class="btn btn--invert small" target="<?= $past_event['target']; ?>">
                            <?= $past_event['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </aside>
            <main>
                <?php $cover_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'full');?>
                <?php if ($cover_img) : ?>
                    <div class="single-post__image">
                        <?= $cover_img; ?>
                    </div>
                <?php endif; ?>
                <?php the_content(); ?>
            </main>
        </div>
    </section>
<?php get_footer(); ?>