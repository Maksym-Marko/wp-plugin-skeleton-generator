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
* Require a Model
*/
function |uniquestring|_use_model( $model ) {

	require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';

}