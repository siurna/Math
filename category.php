<?php get_header(); ?>
<?php get_template_part( 'template-parts/page-heading' ); ?>

<section id="content">
    <div class="flex-container">
        <aside>
            <?php get_template_part( 'template-parts/list-categories' ); ?>
        </aside>
        <main>
            <?php get_template_part( 'loop', 'blog' ); ?>
        </main>
    </div>
</section>

<?php get_footer(); ?>