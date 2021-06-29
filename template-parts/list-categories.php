<ul class="categories">
    <li class="cat-item">
        <a href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>">
            <?php esc_html_e( 'All', 'math' ); ?>
        </a>
    </li>
    <?php $args = array(
        'title_li' => '',
    ); ?>
    <?php $categories = wp_list_categories( $args ); ?>
</ul>