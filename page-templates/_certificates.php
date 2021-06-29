<?php
/*
 * Template Name: Certificates Template  
*/
?>
<?php get_header(); ?>

<?php get_template_part('template-parts/page-heading'); ?>

<section id="content">
    <div class="container">
        <div class="container--sm">
            <?php if ( have_rows ('certificates') ) : ?>
                <?php while ( have_rows('certificates') ) : the_row(); ?>
                <div class="certificate">
                    <?php $cert_logo = get_sub_field('certificate_logo'); ?>
                    <?php if ( $cert_logo ) : ?>
                    <div class="certificate__logo">
                        <img src="<?= $cert_logo['url']; ?>" alt="<?= $cert_logo['alt']; ?>">
                    </div>
                    <?php endif; ?>
                    <?php the_sub_field('certificate_text'); ?>
                </div>            
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>
