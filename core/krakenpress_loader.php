<?php

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

const KRAKENPRESS_CORE_PATH = KRAKENPRESS_BASE_PATH . '/core';
const KRAKENPRESS_ADMIN_PATH = KRAKENPRESS_BASE_PATH . '/admin';
const KRAKENPRESS_PUBLIC_PATH = KRAKENPRESS_BASE_PATH . '/public';
const KRAKENPRESS_LIB_PATH = KRAKENPRESS_BASE_PATH . '/libs';

require_once ( 'krakenpress_debug.php' );
require_once ( 'krakenpress_helpers.php' );
require_once ( 'krakenpress_assets.php' );

add_action( 'plugins_loaded', 'krakenpress_run_app' );

function krakenpress_run_app() {
    krakenpress_load_admin_files();
    krakenpress_load_public_files();
}
