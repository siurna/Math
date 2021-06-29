<?php

// Function for fetching Instagram Latest posts from API

function math_instagram_api_curl_connect( $api_url ){
	$connection_c = curl_init(); // initializing
	curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
	curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
	curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
	$json_return = curl_exec( $connection_c ); // connect and get json data
	curl_close( $connection_c ); // close connection
	return json_decode( $json_return ); // decode and return
}

// Create database table for instagram posts from API

function insta_posts_create_db() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE `{$wpdb->base_prefix}insta_latest_posts` (

		post_id INT,
		post_permalink varchar(500),
		post_media_url varchar(500),
		thumbnail_url varchar(500),
		PRIMARY KEY  (post_id, post_permalink, post_media_url, thumbnail_url)

	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
}
register_activation_hook( __FILE__, 'insta_posts_create_db' );

// WP Custom REST API registration

add_action('rest_api_init', function () {
	register_rest_route( 'math/v1', 'events',array(
		'methods'  => 'GET',
		'callback' => 'add_to_calendar'
	));
	register_rest_route( 'math/v1', 'instagram',array(
		'methods'  => 'GET',
		'callback' => 'insta_posts_to_db'
	));
});

function insta_posts_to_db() {
	
	$access_token = 'IGQVJWZAERUaFN1TG1ZAaFBaZAFVpNXBuakZATcHJTalNmVk82dVZAjWWdaUUI0NUNhLUtHYmxMTU9DZAjFRelV4ZATBpNy1pQmphZA3R3ZAkdIaWZAQbTlNNkVRUTQyZAnI0QlJrZAWdILXVpMl9B';
	$posts_limit = 4;

	$posts = math_instagram_api_curl_connect("https://graph.instagram.com/me/media?fields=id,media_url,permalink,thumbnail_url&limit=" . $posts_limit . "&access_token=" . $access_token);
	
	global $wpdb; 

	$table_name = $wpdb->prefix . 'insta_latest_posts';

	// DROP
	$delete = $wpdb->query("TRUNCATE TABLE $table_name");

	foreach ($posts->data as $key => $post) : 

		dump($post);

		$wpdb->insert($table_name, array(
			'ID' => null,
			'post_id' => $post->id,
			'post_permalink' => $post->permalink, 
			'post_media_url' => $post->media_url, 
			'thumbnail_url' => $post->thumbnail_url,
		)); 

	endforeach;
}

function add_to_calendar($request) {

	$event_ID = $_GET['id'];
	$event_date_string = get_field('event_date', $event_ID);
	$event_date_end_string = get_field('event_date_end', $event_ID);

    $args = array(
		'post_type' => 'events',
		'include' => $event_ID
    );
    $posts = get_posts($args);

    if (empty($posts)) {
    return new WP_Error( 'no_event', 'there is no event at this date', array('status' => 404) );

    }

	header('Content-Type: text/calendar; charset=utf-8');
	header('Content-Disposition: attachment; filename=invite.ics');

	$ics = new ICS(array(
		'description' => $posts[0]->post_excerpt,
		'dtstart' => $event_date_string,
		'dtend' => $event_date_end_string,
		'summary' => $posts[0]->post_title,
	));

	echo $ics->to_string();
}