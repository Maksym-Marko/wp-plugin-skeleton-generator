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
*
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\wp-plugin-skeleton\wp-plugin-skeleton.php
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_PATH' ) ) {

	define( '|UNIQUESTRING|_PLUGIN_PATH', __FILE__ );

}

/*
* Define |UNIQUESTRING|_PLUGIN_URL
*
* Return http://my-domain.com/wp-content/plugins/wp-plugin-skeleton/
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_URL' ) ) {

	define( '|UNIQUESTRING|_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

}

/*
* Define |UNIQUESTRING|_PLUGN_BASE_NAME
*
* 	Return wp-plugin-skeleton/wp-plugin-skeleton.php
*/
if ( ! defined( '|UNIQUESTRING|_PLUGN_BASE_NAME' ) ) {

	define( '|UNIQUESTRING|_PLUGN_BASE_NAME', plugin_basename( __FILE__ ) );

}

/*
* Define |UNIQUESTRING|_TABLE_SLUG
*/
if ( ! defined( '|UNIQUESTRING|_TABLE_SLUG' ) ) {

	define( '|UNIQUESTRING|_TABLE_SLUG', '|uniquestring|_table_slug' );

}

/*
* Define |UNIQUESTRING|_PLUGIN_ABS_PATH
* 
* E:\OpenServer\domains\my-domain.com\wp-content\plugins\wp-plugin-skeleton/
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_ABS_PATH' ) ) {

	define( '|UNIQUESTRING|_PLUGIN_ABS_PATH', dirname( |UNIQUESTRING|_PLUGIN_PATH ) . '/' );

}

/*
* Define |UNIQUESTRING|_PLUGIN_VERSION
*/
if ( ! defined( '|UNIQUESTRING|_PLUGIN_VERSION' ) ) {

	// version
	define( '|UNIQUESTRING|_PLUGIN_VERSION', time() ); // Must be replaced before production on for example '1.0'

}

/*
* Define |UNIQUESTRING|_MAIN_MENU_SLUG
*/
if ( ! defined( '|UNIQUESTRING|_MAIN_MENU_SLUG' ) ) {

	// version
	define( '|UNIQUESTRING|_MAIN_MENU_SLUG', '|uniquestring|-wp-plugin-skeleton-menu' );

}

/**
 * activation|deactivation
 */
require_once plugin_dir_path( __FILE__ ) . 'install.php';

/*
* Registration hooks
*/
// Activation
register_activation_hook( __FILE__, array( '|UNIQUESTRING|_Basis_Plugin_Class', 'activate' ) );

// Deactivation
register_deactivation_hook( __FILE__, array( '|UNIQUESTRING|_Basis_Plugin_Class', 'deactivate' ) );


/*
* Include the main |UniqueClassName| class
*/
if ( ! class_exists( '|UniqueClassName|' ) ) {

	require_once plugin_dir_path( __FILE__ ) . 'includes/final-class.php';

	/*
	* Translate plugin
	*/
	add_action( 'plugins_loaded', '|uniquestring|_translate' );

	function |uniquestring|_translate()
	{

		load_plugin_textdomain( '|uniquestring|-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

}