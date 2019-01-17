<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Main page Model
*/
class |UNIQUESTRING|_Main_Page_Model extends |UNIQUESTRING|_Model
{

	/*
	* Observe function
	*/
	public static function |uniquestring|_wp_ajax()
	{

		add_action( 'wp_ajax_|uniquestring|_update', array( '|UNIQUESTRING|_Main_Page_Model', 'prepare_update_database_column' ), 10, 1 );

	}

	/*
	* Prepare for data updates
	*/
	public static function prepare_update_database_column()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ){

			// Update data
			self::update_database_column( $_POST['|uniquestring|_some_string'] );		

		}

		wp_die();

	}

		// Update data
		public static function update_database_column( $string )
		{

			global $wpdb;

			$clean_string = esc_html( $string );

			$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

			$wpdb->update(

				$table_name, 
				array(
					'some_field' => $clean_string,
				), 
				array( 'id' => 1 ), 
				array( 
					'%s'
				)

			);

		}
	
}