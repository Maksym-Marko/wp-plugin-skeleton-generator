<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require class for admin panel
*/
function |uniquestring|RequireClassFileAdmin( $file ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/classes/' . $file;

}


/*
* Require class for frontend panel
*/
function |uniquestring|RequireClassFileFrontend( $file ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/classes/' . $file;

}

/*
* Require a Model
*/
function |uniquestring|UseModel( $model ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';

}

/*
* Debugging
*/
function |uniquestring|DebugToFile( $content ) {

	$content = |uniquestring|ContentToString( $content );

	$path = |UNIQUESTRING|_PLUGIN_ABS_PATH . 'mx-debug' ;

	if( ! file_exists( $path ) ) :

		mkdir( $path, 0777, true );

		file_put_contents( $path . '/mx-debug.txt', $content );

	else :

		file_put_contents( $path . '/mx-debug.txt', $content );

	endif;

}
	// pretty debug text to the file
	function |uniquestring|ContentToString( $content ) {

		ob_start();

		var_dump( $content );

		return ob_get_clean();

	}

/*
* Manage posts columns. Add column to position
*/
function |uniquestring|InsertNewColumnToPosition( array $columns, int $position, array $newColumn ) {

	$chunkedArray = array_chunk( $columns, $position, true );

	$result = array_merge( $chunkedArray[0], $newColumn, $chunkedArray[1] );

	return $result;

}

/*
* Redirect from admin panel
*/
function |uniquestring|AdminRedirect( $url ) {

	if( ! $url ) return;

	add_action( 'admin_footer', function() use ( $url ) {
		echo "<script>window.location.href = '$url';</script>";
	} );

}