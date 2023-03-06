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

		add_action( 'wp_ajax_|uniquestring|_update', ['|UNIQUESTRING|_Main_Page_Model', 'prepare_update_database_column'], 10, 1 );
		add_action( 'wp_ajax_|uniquestring|_create_item', ['|UNIQUESTRING|_Main_Page_Model', 'prepare_item_creation'], 10, 1 );
		add_action( 'wp_ajax_|uniquestring|_bulk_actions', ['|UNIQUESTRING|_Main_Page_Model', 'prepare_bulk_actions'], 10, 1 );		
		
	}

	/*
	* Prepare to bulk actions
	*/
	public static function prepare_bulk_actions()
	{		
		
		// Checked POST nonce is not empty
		if ( empty( $_POST['nonce'] ) ) wp_die( '0' );		

		// Checked or nonce match
		if ( wp_verify_nonce( $_POST['nonce'], 'bulk-|uniquestring|_plural' ) ) {

			// delete
			if( $_POST['bulk_action']  == 'delete' ) {

				if ( ! current_user_can( 'edit_posts' ) ) return;

				self::action_delete( $_POST['ids'] );	
				
				return;

			}
			
			// restore
			if( $_POST['bulk_action']  == 'restore' ) {

				if ( ! current_user_can( 'edit_posts' ) ) return;

				self::action_restore( $_POST['ids'] );	
				
				return;

			}

			// move to trash
			if( $_POST['bulk_action']  == 'trash' ) {

				if ( ! current_user_can( 'edit_posts' ) ) return;

				self::action_trash( $_POST['ids'] );	
				
				return;

			}

		}

		wp_die();

	}

	// handle bulk actions
	// Delete permanently
	public static function action_delete( $ids )
	{

		foreach ( $ids as $id ) {

			( new self )->delete_permanently( $id );

		}

		return;

	}

	// Restore
	public static function action_restore( $ids )
	{

		foreach ( $ids as $id ) {

			( new self )->restore_item( $id );

		}

		return;

	}

	// Move to Trash
	public static function action_trash( $ids )
	{

		foreach ( $ids as $id ) {

			( new self )->move_to_trash( $id );

		}

		return;

	}

	/*
	* Prepare item creation
	*/
	public static function prepare_item_creation()
	{

		// Checked POST nonce is not empty
		if ( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if ( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ) {

			// Create item
			$title = sanitize_text_field( $_POST['title'] );
			$description = esc_html( $_POST['description'] );

			$data = [
				'title' => $title,
				'description' => $description,
			];

			self::create_item( $data );
		}

		wp_die();

	}

	// Create item
	public static function create_item( $data )
	{

		global $wpdb;
		
		$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;
		
		$created = $wpdb->insert(
			
			$table_name, 
			[
				'title' => $data['title'],
				'description' => $data['description'],
			],
			[
				'%s',
				'%s',
			]

		);

		echo $created;

	}

	/*
	* Prepare item updating
	*/
	public static function prepare_update_database_column()
	{

		// Checked POST nonce is not empty
		if ( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if ( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ) {

			// Update data
			$id = sanitize_text_field( $_POST['id'] );
			$title = sanitize_text_field( $_POST['title'] );
			$description = esc_html( $_POST['description'] );

			$data = [
				'id' 			=> $id,
				'title' 		=> $title,
				'description' 	=> $description,
			];

			self::update_database_column( $data );
		}

		wp_die();

	}

	// Update item
	public static function update_database_column( $data )
	{

		global $wpdb;
		
		$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$wpdb->update(

			$table_name,
			[
				'title' 		=> $data['title'],
				'description' 	=> $data['description'],
			],
			['id' => $data['id']],
			[
				'%s',
				'%s',
			]

		);

	}

	/*
	* Actions
	*/
	// restore item
	public function restore_item( $id )
	{

		global $wpdb;
		
		$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$wpdb->update(

			$table_name,
			[
				'status' 		=> 'publish',
			],
			['id' => $id],
			[
				'%s',
			]

		);

	}
	// move to trash
	public function move_to_trash( $id )
	{

		global $wpdb;
		
		$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$wpdb->update(

			$table_name,
			[
				'status' 		=> 'trash',
			],
			['id' => $id],
			[
				'%s',
			]

		);

	}

	// delete permanently
	public function delete_permanently( $id )
	{

		global $wpdb;

		$table = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$wpdb->delete( 
			$table, 
			[
				'id' => $id
			], 
			[ 
				'%d'
			] 
		);

	}

}