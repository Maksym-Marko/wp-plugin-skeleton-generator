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
			// varchar
			$product_table->varchar( 'mx_name', 200, true, 'text' );

			// longtext
			$product_table->longtext( 'mx_desc' );

			// created
			$product_table->datetime( 'mx_created' );			

		// create columns with "product_id" as AUTO_INCREMENT
		$product_table->create_columns( 'product_id' );

		// create table
		$table_created = $product_table->create_table();

		// if table has created, insert data
		if( $table_created == 1 ) {

			// Insert dummy data
			$wpdb->insert(

				$table_name,

				[
					'mx_name' => 'Cool product',
					'mx_desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua.'
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