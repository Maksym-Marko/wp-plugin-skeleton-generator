<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

final class |UniqueClassName|
{

	/*
	* |UniqueClassName| constructor
	*/
	public function __construct()
	{

		// ...

	}

	/*
	* Include required core files
	*/
	public function |uniquestring|_include()
	{		

		// helpers
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/helpers.php';

		// cathing errors
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Catching-Errors.php';

		// Route
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Route.php';

		// Models
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Model.php';

		// Views
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/View.php';

		// Controllers
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Controller.php';

	}

	/*
	* Include Admin Path
	*/
	public function |uniquestring|_include_admin_path()
	{

		// Part of the Administrator
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/admin-class.php';
	
	}

	/*
	* Include Frontend Path
	*/
	public function |uniquestring|_include_frontend_path()
	{

		// Part of the Frontend
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/frontend-main.php';
	
	}

}

// create a new instance of final class
$final_class_instance = new |UniqueClassName|();

// run core files
$final_class_instance->|uniquestring|_include();

// include admin parth
$final_class_instance->|uniquestring|_include_admin_path();

// include frontend parth
$final_class_instance->|uniquestring|_include_frontend_path();
