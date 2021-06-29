<?php
/*
 * Template Name: Text Content Template  
*/
?>
<?php get_header(); ?>

<section id="content">
    <div class="flex-container">
        <div class="content--third">
            <h1>
                <?php the_title(); ?>
            </h1>
        </div>
        <div class="content--two-thirds">
            <?= the_content(); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>