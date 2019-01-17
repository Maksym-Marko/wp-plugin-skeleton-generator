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

}