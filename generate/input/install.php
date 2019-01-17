<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


class |UNIQUESTRING|_Basis_Plugin_Class
{

	private static $table_slug = |UNIQUESTRING|_TABLE_SLUG;

	public static function activate()
	{

		// set option for rewrite rules CPT
		self::create_option_for_activation();

		// Create table
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . self::$table_slug;

		if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $table_name . "'" ) !=  $table_name ) {

			$sql = "CREATE TABLE IF NOT EXISTS `$table_name`
			(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`some_field` varchar(40) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$wpdb->charset AUTO_INCREMENT=1;";

			$wpdb->query( $sql );

			// Insert dummy data
			$wpdb->insert(

				$table_name,

				array(
					'some_field' => 'Some string.',
				)

			);
		}

	}

	public static function deactivate()
	{

		// Rewrite rules
		flush_rewrite_rules();

	}

	/*
	* This function sets the option in the table for CPT rewrite rules
	*/
	public static function create_option_for_activation()
	{

		add_option( '|uniquestring|_flush_rewrite_rules', 'go_flush_rewrite_rules' );

	}

}