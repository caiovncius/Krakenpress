<?php

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

if ( !function_exists( 'kpdebug' ) ) {
	function kpdebug() {
		$args = func_get_args();
		foreach ( $args as $arg ) {
            echo '<pre style="background: #0c0c0c; color: #fff; padding: 20px; overflow: scroll">';
			var_dump( $arg);
            echo '</pre>';
		}
		exit();
	}
}