<?php
/*
Plugin Name: Example plugin
Plugin URI: https://zero62.com
Description: Example pluigin made by Krakenpress
Version: 1.0.0
Author: Zero62
Author URI: https://zero62.com
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

define( "KRAKENPRESS_APP_NAME", 'example' );
define( "KRAKENPRESS_BASE_PATH", dirname( __FILE__ ) );

require_once( KRAKENPRESS_BASE_PATH . '/core/krakenpress_loader.php' );
