<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|DataBaseTalk
{

	/*
	* |UNIQUESTRING|DataBaseTalk constructor
	*/
	public function __construct()
	{

		$this->|uniquestring|_observe_update_data();

	}

	/*
	* Observe function
	*/
	public function |uniquestring|_observe_update_data()
	{

		add_action( 'wp_ajax_|uniquestring|_update', array( $this, 'prepare_update_script' ) );

	}

	/*
	* Prepare for data updates
	*/
	public function prepare_update_script()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ){

			// Update data
			$this->update_script( $_POST['|uniquestring|_some_string'] );		

		}

		wp_die();

	}

		// Update data
		public function update_script( $string )
		{

			$clean_string = str_replace( '\\', '', esc_html( $string ) );

			global $wpdb;

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

// New instance
new |UNIQUESTRING|DataBaseTalk();