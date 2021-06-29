<?php
/**
 * Article with Heading Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>

<?php 
$article_only = get_field('article_only_block');
$article_only_title = $article_only['title'];
$article_only_text = $article_only['text'];
?>
<section class="article__block" <?= $bg_color ? 'style="background-color:' . $bg_color . ';"' : '' ;?>> 
    <div class="flex-container <?= ($section_width === 'container') ? '' : $section_width; ?> <?= ($section_order != 'usual') ? $section_order : '';  ?>">
        <div class="content--half center-center article__block__text">
            <?= $article_only_text; ?>
        </div>    
        <article class="content--half">
            <h2><?= $article_only_title; ?></h2>
        </article>
    </div>
</section>