<?php get_header(); ?>

<?php get_template_part( 'template-parts/page-heading' ); ?>

<section id="content">

    <?php
    $events_query = new WP_Query ($args);
    $args = array(
        'post_type' => 'events',
        'post_status' => 'publish',
        'meta_key'  => 'date',
        'orderby'   => 'meta_value_num',
        'order'     => 'DESC',
    ); ?>

    <div class="flex-container">
        <?php if (have_posts($events_query)) : ?>
            <?php while (have_posts($events_query)) : the_post( $events_query ) ; ?>
                <div class="post">    
                    <div>
                        <?php $cover_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'large');?>
                        <?php if ($cover_img) : ?>
                            <div class="post__image">
                                <a href="<?php the_permalink(); ?>">
                                    <?= $cover_img; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post__title">
                            <a href="<?php the_permalink(); ?>">
                                <h5>
                                    <?php the_title(); ?>
                                </h5>   
                            </a>                        
                        </div>
                        <div class="post__date">
                            <h6><?php the_field('event_date'); ?></h6>
                        </div>
                        <div class="post__excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        <div>
                            <a href="<?php the_permalink(); ?>" class="btn small">
                                <?php esc_html_e( 'Skaityti daugiau', 'math'); ?>
                            </a>
                        </div>
                        <?php $past_event = get_field('the_content_of_the_previous_event'); ?>
                        <?php if (!$past_event) : ?>
                            <div class="post__add-ics">
                                <a href="/wp-json/math/v1/events/?id=<?= get_the_ID(); ?>" class="btn btn--invert small"><?php esc_html_e( 'Pridėti į kalendorių', 'math' ); ?></a>
                            </div>
                        <?php else : ?>
                            <div class="post__add-ics">
                                <a href="<?= $past_event['url']; ?>" class="btn btn--invert small" target="<?= $past_event['target']; ?>">
                                    <?= $past_event['title']; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif;?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
<?php get_footer(); ?>
