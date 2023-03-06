<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_Main_Page_Controller extends |UNIQUESTRING|_Controller
{

	protected $model_inst;

	public function __construct()
	{

		$this->model_inst = new |UNIQUESTRING|_Main_Page_Model();
		
	}
	
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

		// restore action
		$delete_id = isset( $_GET['delete'] ) ? trim( sanitize_text_field( $_GET['delete'] ) ) : false;
		
		if( $delete_id ) {

			if ( isset( $_GET['|uniquestring|_nonce'] ) || wp_verify_nonce( $_GET['|uniquestring|_nonce'], 'delete' ) ) {

				$this->model_inst->delete_permanently( $delete_id );

			}

			wp_redirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG . '&item_status=trash' ) );

			return;

		}

		// restore action
		$restore_id = isset( $_GET['restore'] ) ? trim( sanitize_text_field( $_GET['restore'] ) ) : false;
		
		if( $restore_id ) {

			if ( isset( $_GET['|uniquestring|_nonce'] ) || wp_verify_nonce( $_GET['|uniquestring|_nonce'], 'restore' ) ) {

				$this->model_inst->restore_item( $restore_id );

			}

			wp_redirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG . '&item_status=trash' ) );

			return;

		}

		// trash action
		$trash_id = isset( $_GET['trash'] ) ? trim( sanitize_text_field( $_GET['trash'] ) ) : false;

		if( $trash_id ) {

			if ( isset( $_GET['|uniquestring|_nonce'] ) || wp_verify_nonce( $_GET['|uniquestring|_nonce'], 'trash' ) ) {

				$this->model_inst->move_to_trash( $trash_id );

			}

			wp_redirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ) );

			return;

		}

		// edit action
		$item_id = isset( $_GET['edit-item'] ) ? trim( sanitize_text_field( $_GET['edit-item'] ) ) : 0;
		
		$data = $this->model_inst->|uniquestring|_get_row( NULL, 'id', intval( $item_id ) );

		if( $data == NULL ) {
			if( ! isset( $_SERVER['HTTP_REFERER'] ) || $_SERVER['HTTP_REFERER'] == NULL ) {
				wp_redirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ) );
			} else {
				wp_redirect( $_SERVER['HTTP_REFERER'] );
			}
			return;
		}
		
		return new |UNIQUESTRING|_View( 'single-table-item', $data );

	}		

	// create table item
	public function create_table_item() {

		return new |UNIQUESTRING|_View( 'create-table-item' );

	}

}