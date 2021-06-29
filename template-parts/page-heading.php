<div class="page-heading">
    <div class="flex-container">

        <!-- Content Pages -->
        <?php if ( is_page()) : ?>
            <div class="content--half">
                <h1>         
                    <?php $page_title = get_field('page_heading'); ?>
                    <?php if ($page_title) : ?>
                        <?= $page_title; ?>
                    <?php else : ?>
                        <?php the_title(); ?>
                    <?php endif; ?>
                </h1>
            </div>
            <div class="content--half--no-padding">
                <?php $page_description_title = get_field('page_description_title'); ?>
                <?php $page_description = get_field('page_description_text'); ?>
                <?php if ( $page_description_title) : ?>
                    <h6><?= $page_description_title; ?></h6>
                <?php endif; ?>
                <?php if ($page_description) : ?>
                    <?= $page_description; ?>
                <?php endif;?>
            </div>

        <!-- Custom Post types -->
        <?php elseif ( is_post_type_archive( 'events' )) : ?>
            <div class="content--half">
                <h1>
                    <?php esc_html_e( 'Renginiai', 'math' ); ?>
                </h1>  
            </div>
        <?php elseif ( is_post_type_archive( 'experts' )) : ?>
            <div class="content--half">
                <h1>
                    <?php esc_html_e( 'Ekspertai', 'math' ); ?>
                </h1>  
            </div>
        <!-- Blog Archive Pages -->
        <?php elseif (is_home() || is_archive()) : ?>    
            <?php $archive_home_ID = intval(get_option('page_for_posts')); ?> 
            <div class="content--half">
                <h1>
                    <?php the_field('page_heading', $archive_home_ID); ?>
                </h1>
            </div> 
            <div class="content--half--no-padding">
                <?php $blog_description_title = get_field('page_description_title', $archive_home_ID); ?>
                <?php $blog_description = get_field('page_description_text', $archive_home_ID); ?>
                <?php if ( $blog_description_title) : ?>
                    <h6><?= $blog_description_title; ?></h6>
                <?php endif; ?>
                <?php if ($blog_description) : ?>
                    <?= $blog_description; ?>
                <?php endif;?>
            </div>
        <?php endif; ?>
    </div>
</div>