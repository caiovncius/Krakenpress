<?php

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

function krakenpress_get_base_url() {
	$full_path = KRAKENPRESS_BASE_PATH;
	$folder = substr( $full_path, strrpos( $full_path, '/' ) + 1 );
	$is_plugin_app = strpos( $full_path, 'plugins' );

	if (  !$is_plugin_app ) {
		return get_stylesheet_directory_uri();
	}

	return plugin_dir_url( '/' )  . $folder;
}

function krakenpress_load_path_files( $path ) {
	$files = scandir( $path );
	$files_to_load = [];

	foreach ( $files as $file ) {
		$is_loaded_file = strpos( $file, '.php' );

		if ( !$is_loaded_file ) {
			continue;
		}

		$files_to_load[] = KRAKENPRESS_ADMIN_PATH . '/' . $file;
	}
	return $files_to_load;
}

function krakenpress_load_admin_files() {
    $files = krakenpress_load_path_files( KRAKENPRESS_ADMIN_PATH );

    foreach ( $files as $file ) {
        require_once ( $file );
    }
}

function krakenpress_load_public_files() {
    if ( is_admin() ) {
        return;
    }

    $files = krakenpress_load_path_files( KRAKENPRESS_PUBLIC_PATH );

    foreach ( $files as $file ) {
        require_once ( $file );
    }
}

function krakenpress_load_lib( $name ) {

    $loader_file = KRAKENPRESS_LIB_PATH . '/' . $name . '/loader.php';

    if ( !file_exists( $loader_file) ) {
        throw new \Exception( 'Lib ' . $name . ' not found' );
    }

    require_once ( $loader_file );
}

function krakenpress_config_loader() {
    $config = KRAKENPRESS_BASE_PATH . '/config.php';

    if ( file_exists( $config ) ) {
        $config = include_once( $config );

        foreach ( $config['libs'] as $lib ) {
            krakenpress_load_lib( $lib );
        }
    }
}

function krakenpress_custom_post_types_loader() {
    $custom_post_types_folder = KRAKENPRESS_BASE_PATH . '/custom-post-types';

    if ( $custom_post_types_folder ) {
        $custom_post_type_files = scandir( KRAKENPRESS_BASE_PATH . '/custom-post-types' );

        foreach ( $custom_post_type_files as $index => $custom_post_type_file ) {

            if ( $index < 2 || $custom_post_type_file === '.gitkeep' ) {
                continue;
            }

            $custom_post_type_file_full_path = $custom_post_types_folder  . '/' . $custom_post_type_file;
            $custom_post_type_name = str_replace( '.php', '', $custom_post_type_file );
            $custom_post_type_data = include_once ( $custom_post_type_file_full_path );

            register_post_type( $custom_post_type_name, $custom_post_type_data );
        }
    }

}