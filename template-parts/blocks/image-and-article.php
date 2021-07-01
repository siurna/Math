<?php
/**
 * Image with Article Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
?>

<?php $article = get_field('article_on_the_right'); ?>
<?php $article_title = $article['title']; ?>
<?php $article_text = $article['text']; ?>
<?php $article_link = $article['link']; ?>
<?php $article_btn = $article['show_button']['0']; ?>

<?php $bg_color = get_field('background_color'); ?>
<?php $section_width = get_field('content_width'); ?>

<section <?= $bg_color ? 'class="' . $bg_color . '"' : '' ;?>> 
    <div class="flex-container <?= ($section_width === 'container') ? '' : $section_width; ?>">
        <?php $article_image = get_field('image_on_the_left'); ?>
        <?php if ($article_image) : ?>
            <div class="content--half">
                <?php if ($article_link) : ?>
                    <a href="<?= $article_link['url']; ?>">
                <?php endif; ?>
                        <img src="<?= $article_image['url']; ?>" alt="<?= $article_image['alt']; ?>">
                <?php if ($article_link) : ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if ($article_title || $article_text) : ?>
            <div class="content--half center-center">
                <h2><?= $article_title ?></h2>
                <?= $article_text ?>
                <?php if ($article_link && $article_btn === 'show') : ?>
                    <a href="<?= $article_link['url']; ?>" class="btn">
                        <?= $article_link['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>