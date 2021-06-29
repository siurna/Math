<?php get_header(); ?>
    <section id="content">
        <div class="flex-container">
            <aside>
                <h1><?php the_title(); ?></h1>

                <?php if ( !is_singular( 'experts' ) ) :
                    global $post;
                    $author_id = $post->post_author; 
                    $author_name = get_the_author_meta( 'display_name', $author_id ); ?>
                    <h6><?= get_the_date( 'Y-F-d' ); ?></h6>
                    <h6><?= _e( 'Autorius: ', 'math' );?><?= $author_name; ?></h6>
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