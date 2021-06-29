<section class="insta">
    <div class="container">
        <h4>@mathscientific</h4>
    </div>
    <div class="container">
        <div class="insta__container">

            <?php
            global $wpdb;
            // this adds the prefix which is set by the user upon instillation of wordpress
            $table_name = $wpdb->prefix . "insta_latest_posts";
            // this will get the data from your table
            $retrieve_data = $wpdb->get_results( "SELECT * FROM $table_name" );
            // dump($retrieve_data); 

            foreach ($retrieve_data as $post) : ?>
                <a href="<?= $post->post_permalink ?>" target="_blank" class="insta__item" style="background-image: url('<?= $post->thumbnail_url ? $post->thumbnail_url : $post->post_media_url; ?>');">
                    <div class="insta__item__overlay">
                        <img src="<?= get_template_directory_uri(); ?>/dist/assets/images/insta-white.svg" alt="">
                    </div>
                </a>

            <?php endforeach; ?>
        </div>
    </div>
</section>