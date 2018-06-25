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

		$this->define_constants();
		
		$this->|uniquestring|_include();

	}

	/*
	* Define |UNIQUESTRING| constants
	*/
	public function define_constants()
	{

		$this->|uniquestring|_define( '|UNIQUESTRING|_TABLE_SLUG', '|uniquestring|_table_slug' );

		// include php files
		$this->|uniquestring|_define( '|UNIQUESTRING|_PLUGIN_ABS_PATH', dirname( |UNIQUESTRING|_PLUGIN_PATH ) . '\\' );

		// version
		$this->|uniquestring|_define( '|UNIQUESTRING|_PLUGIN_VERSION', time() ); // Must be replaced before production on for example '1.0'


	}

	/*
	* Incude required core files
	*/
	public function |uniquestring|_include()
	{

		// Basis functions
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\class-basis-plugin-class.php';

		// Helpers
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\core\helpers.php';

		// Part of the Frontend
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\frontend\class-frontend-main.php';

		// Part of the Administrator
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\admin\class-admin-main.php';

		/*
		* CPT class
		* If you do not need CPT, delete the line below
		*/
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\admin\class-cpt-talk.php';

	}

	// Define function
	private function |uniquestring|_define( $mame, $value )
	{

		if( ! defined( $mame ) )
		{

			define( $mame, $value );

		}

	}


}