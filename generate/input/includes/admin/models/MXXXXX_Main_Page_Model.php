<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

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

		add_action('wp_ajax_|uniquestring|_update', ['|UNIQUESTRING|_Main_Page_Model', 'prepare_update_database_column'], 10, 1);
	}

	/*
	* Prepare for data updates
	*/
	public static function prepare_update_database_column()
	{

		// Checked POST nonce is not empty
		if ( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if ( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ) {

			// Update data
			$name = sanitize_text_field( $_POST['name'] );
			$desc = esc_html( $_POST['description'] );

			$data = [
				"name" => $name,
				"desc" => $desc,
			];

			self::update_database_column( $data );
		}

		wp_die();
	}

	// Update data
	public static function update_database_column( $data )
	{

		global $wpdb;

		$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$wpdb->update(

			$table_name,
			[
				'mx_name' => $data['name'],
				'mx_desc' => $data['desc'],
			],
			['product_id' => 1],
			[
				'%s',
				'%s',
			]

		);
	}
}
