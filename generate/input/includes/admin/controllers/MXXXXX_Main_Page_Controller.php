<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_Main_Page_Controller extends |UNIQUESTRING|_Controller
{
	
	public function index()
	{

		$model_inst = new |UNIQUESTRING|_Main_Page_Model();

		$data = $model_inst->|uniquestring|_get_row( NULL, 'id', 1 );

		return new |UNIQUESTRING|_View( 'main-page', $data );

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

}