<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_Main_Page_Controller extends |UNIQUESTRING|_Controller
{
	
	public function index()
	{

		return new |UNIQUESTRING|_View( 'main-page' );

	}

	public function submenu()
	{

		return new |UNIQUESTRING|_View( 'sub-page' );

	}

	public function hidemenu()
	{

		return new |UNIQUESTRING|_View( 'hidemenu-page' );

	}

	public function settings_menu_item_action()
	{

		return new |UNIQUESTRING|_View( 'settings-page' );

	}

	public function single_table_item()
	{

		// trash action
		$trash_id = isset( $_GET['trash'] ) ? trim( sanitize_text_field( $_GET['trash'] ) ) : false;

		if( $trash_id ) {

			if ( isset( $_GET['|uniquestring|_nonce'] ) || wp_verify_nonce( $_GET['|uniquestring|_nonce'], 'trash' ) ) {

				global $wpdb;

				$table = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

				$wpdb->delete( 
					$table, 
					[
						'id' => $trash_id
					], 
					[ 
						'%d'
					] 
				);

			}

			wp_redirect( admin_url( 'admin.php?page=single_table_item' ) );

			return;

		}

		// edit action
		$item_id = isset( $_GET['edit-item'] ) ? trim( sanitize_text_field( $_GET['edit-item'] ) ) : 0;
		
		$model_inst = new |UNIQUESTRING|_Main_Page_Model();

		$data = $model_inst->|uniquestring|_get_row( NULL, 'id', intval( $item_id ) );

		if( $data == NULL ) {
			if( $_SERVER['HTTP_REFERER'] == NULL ) {
				wp_redirect( admin_url( 'admin.php?page=single_table_item' ) );
			} else {
				wp_redirect( $_SERVER['HTTP_REFERER'] );
			}
			return;
		}
		
		return new |UNIQUESTRING|_View( 'single-table-item', $data );

	}

}