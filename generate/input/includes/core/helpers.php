<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require template for admin panel
*/
function |uniquestring|_require_template_admin( $file ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\admin\templates\\' . $file;

}

/*
* Select data
*/
function |uniquestring|_select_script() {

	global $wpdb;

	$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

	$get_scripts_string = $wpdb->get_row( "SELECT script FROM $table_name WHERE id = 1" );

	return $get_scripts_string->script; // The 'script' string is variable

}