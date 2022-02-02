<?php

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

add_action( 'wp_enqueue_scripts', 'krakenpress_enqueue_public_assets' );
function krakenpress_enqueue_public_assets() {

	if ( is_admin() ) {
		return;
	}

	wp_enqueue_style(
		KRAKENPRESS_APP_NAME . '-styles',
		krakenpress_get_base_url() . '/dist/css/styles.css',
		[],
		true
	);

	wp_enqueue_script(
		KRAKENPRESS_APP_NAME . '-scripts',
		krakenpress_get_base_url() . '/dist/js/scripts.js',
		[ 'jquery' ],
		true,
		true
	);
}

add_action( 'admin_enqueue_scripts', 'krakenpress_enqueue_admin_assets' );
function krakenpress_enqueue_admin_assets() {
	wp_enqueue_style(
		KRAKENPRESS_APP_NAME . '-admin-styles',
		krakenpress_get_base_url() . '/dist/css/admin-styles.css',
		[],
		'1.0.0'
	);

	wp_enqueue_script(
		KRAKENPRESS_APP_NAME . '-admin-scripts',
		krakenpress_get_base_url() . '/dist/js/admin-scripts.js',
        [ 'jquery' ],
		'1.0.0',
		true
	);
}