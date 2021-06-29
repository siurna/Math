<?php
/**
 * Article with Image Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>

<?php $article_block = get_field('article_block'); ?>
<?php $article_title = $article_block['title']; ?>
<?php $article_text = $article_block['text']; ?>
<?php $article_link = $article_block['link']; ?>
<?php $article_btn = $article_block['show_button']['0']; ?>

<?php $bg_color = get_field('background_color'); ?>
<?php $section_width = get_field('content_width'); ?>
<?php $section_order = get_field('section_order'); ?>

<section class="article__block" <?= $bg_color ? 'style="background-color:' . $bg_color . ';"' : '' ;?>> 
    <div class="flex-container <?= ($section_width == 'container') ? '' : $section_width; ?> <?= ($section_order != 'usual') ? $section_order : '';  ?>">
        <?php if ($article_title || $article_text) : ?>
            <article class="content--half center-center anim__fade-in-up">
                <h2><?= $article_title ?></h2>
                <?= $article_text ?>
                <?php if ($article_link && $article_btn === 'show' ) : ?>
                    <div class="btn__wrapper--left">
                        <a href="<?= $article_link['url']; ?>" class="btn">
                            <?= $article_link['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </article>
        <?php endif; ?>
        <?php $article_image = get_field('image_for_article'); ?>
        <?php if ($article_image) : ?>
            <div class="content--half center-center anim__fade-in-up--fast">
                <?php if ($article_link) : ?>
                    <a href="<?= $article_link['url']; ?>">
                <?php endif; ?>
                        <img src="<?= $article_image['url']; ?>" alt="<?= $article_image['title']; ?>">
                <?php if ($article_link) : ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>