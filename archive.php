<?php get_header(); ?>
    <section id="content">
        <?php
        $post_type  = get_query_var('post_type');       
        $archive_query = new WP_Query ($args);
        $args = array(
            'post_type' => $post_type,
            'post_status' => 'publish',
            'orderby' => 'title',
            'order'   => 'DESC',
        ); ?>
        <div class="container">
            <?php if (have_posts($archive_query)) : ?>
                <?php while (have_posts($archive_query)) : the_post( $archive_query ) ; ?>
                <?php the_title(); ?>
                <?php endwhile; ?>
            <?php endif;?>
        </div>
            </section>
<?php get_footer(); ?>