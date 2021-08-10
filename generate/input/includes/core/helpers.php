<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require class for admin panel
*/
function |uniquestring|_require_class_file_admin( $file ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/classes/' . $file;

}


/*
* Require class for frontend panel
*/
function |uniquestring|_require_class_file_frontend( $file ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/classes/' . $file;

}

/*
* Require a Model
*/
function |uniquestring|_use_model( $model ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';

}

/*
* Debugging
*/
function |uniquestring|_debug_to_file( $content ) {

	$content = |uniquestring|_content_to_string( $content );

	$path = |UNIQUESTRING|_PLUGIN_ABS_PATH . 'mx-debug' ;

	if( ! file_exists( $path ) ) :

		mkdir( $path, 0777, true );

		file_put_contents( $path . '/mx-debug.txt', $content );

	else :

		file_put_contents( $path . '/mx-debug.txt', $content );

	endif;

}
	// pretty debug text to the file
	function |uniquestring|_content_to_string( $content ) {

		ob_start();

		var_dump( $content );

		return ob_get_clean();

	}

/*
* Manage posts columns. Add column to position
*/
function |uniquestring|_insert_new_column_to_position( array $columns, int $position, array $new_column ) {

	$chunked_array = array_chunk( $columns, $position, true );

	$result = array_merge( $chunked_array[0], $new_column, $chunked_array[1] );

	return $result;

}