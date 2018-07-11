<?php
/*
Plugin Name: |Plugin Name|
Plugin URI: |Plugin URI|
Description: |Brief description|
Author: |Author|
Version: 1.0
Author URI: |Author URI|
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Unique string - |UNIQUESTRING|
*/

/*
* Define |UNIQUESTRING|_PLUGIN_PATH
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_PATH' ) ) {

	define( '|UNIQUESTRING|_PLUGIN_PATH', __FILE__ );

}

/*
* Define |UNIQUESTRING|_PLUGIN_URL
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_URL' ) ) {

	// Return http://my-domain.com/wp-content/plugins/wp-plugin-skeleton/
	define( '|UNIQUESTRING|_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

}

/*
* Define |UNIQUESTRING|_PLUGN_BASE_NAME
*/
if ( ! defined( '|UNIQUESTRING|_PLUGN_BASE_NAME' ) ) {

	// Return wp-plugin-skeleton/wp-plugin-skeleton.php
	define( '|UNIQUESTRING|_PLUGN_BASE_NAME', plugin_basename( __FILE__ ) );

}

/*
* Include the main |UniqueClassName| class
*/
if ( ! class_exists( '|UniqueClassName|' ) ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-final-main-class.php';

	// Create new instance
	new |UniqueClassName|();

	/*
	* Registration hooks
	*/
	// Activation
	register_activation_hook( __FILE__, array( '|UNIQUESTRING|BasisPluginClass', 'activate' ) );

	// Deactivation
	register_deactivation_hook( __FILE__, array( '|UNIQUESTRING|BasisPluginClass', 'deactivate' ) );

	/*
	* Translate plugin
	*/
	add_action( 'plugins_loaded', '|uniquestring|_translate' );

	function |uniquestring|_translate()
	{

		load_plugin_textdomain( '|uniquestring|-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

}