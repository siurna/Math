<?php get_header(); ?>

<?php get_template_part( 'template-parts/page-heading' ); ?>

<section id="content">

    <?php
    $events_query = new WP_Query ($args);
    $args = array(
        'post_type' => 'experts',
        'post_status' => 'publish',
        'orderby'   => 'title',
        'order'     => 'ASC',
    ); ?>

    <?php if (have_posts($events_query)) : ?>
        <?php while (have_posts($events_query)) : the_post( $events_query ) ; ?>
        <div class="flex-container expert">
            <div class="content--half">
                <?php $cover_img = wp_get_attachment_image(get_post_thumbnail_id($post->ID), 'large');?>
                <?php if ($cover_img) : ?>
                    <div class="expert__image">
                        <?= $cover_img; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="content--half center-left">
                <div class="expert__title">
                    <h3>
                        <?php the_title(); ?>
                    </h3>                           
                </div>
                <div class="expert__description">
                    <?php the_content(); ?>
                </div>
                <?php $expert_cta = get_field('expert_cta'); ?>
                <?php if ($expert_cta) : ?>
                    <div class="expert__cta">
                        <a href="<?= $expert_cta['url']; ?>" class="btn"><?= $expert_cta['title']; ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif;?>
    <?php wp_reset_postdata(); ?>
</section>
<?php get_footer(); ?>
