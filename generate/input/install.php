<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// create table class
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/create-table.php';

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

		$product_table = new |UNIQUESTRING|CreateTable( $table_name );

		// add some column
			// title
			$product_table->varchar( 'title', 200, true, 'text' );

			// longtext
			$product_table->longtext( 'description' );

			// statue
			$product_table->varchar( 'status', 20, true, 'publish' );

			// created
			$product_table->datetime( 'created_at' );			

		// create "id" column as AUTO_INCREMENT
		$product_table->create_columns();

		// create table
		$table_created = $product_table->create_table();

		// if table has created, insert data
		if( $table_created == 1 ) {

			// Insert dummy data
			// 1
			$wpdb->insert(

				$table_name,

				[
					'title' 		=> 'ASUS PCI-Ex GeForce RTX 4090',
					'description' 	=> 'Graphics chip: GeForce RTX 4090. Memory: 24 GB. Memory bus width: 384 bit. Memory type: GDDR6X. Type of cooling system: Active.',
					'status' 		=> 'publish',
				],

				[
					'%s',
					'%s',
					'%s',
				]

			);

			// 2
			$wpdb->insert(

				$table_name,

				[
					'title' 		=> 'MSI PCI-Ex GeForce RTX 3070',
					'description' 	=> 'Graphics chip: GeForce RTX 3070 Ti. Memory capacity: 8 GB. Memory bus capacity: 256 bits. Memory type: GDDR6X. Type of cooling system: Active.',
					'status' 		=> 'publish',
				],

				[
					'%s',
					'%s',
					'%s',
				]

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