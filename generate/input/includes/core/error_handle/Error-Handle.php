<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class |UNIQUESTRING|_Error_Handle
{

	/**
	* Error name
	*/
	// public $|uniquestring|_error_name = '';	

	/**
	* has error
	*/
	public $|uniquestring|_isnt_error = true;

	public function __construct()
	{

	}
	
	public function |uniquestring|_class_attributes_error( $class_name, $method )
	{

		// if class not exists display an error
		if( class_exists( $class_name ) ) {

			// check if method exists
			$class_inst = new $class_name();

			// if method not exists display an error
			if( !method_exists( $class_inst, $method ) ) {

				// notice of error
				$|uniquestring|_error_notice = "The <b>\"{$class_name}\"</b> class doesn't contain the <b>\"{$method}\"</b> method.";

				// show an error
				$error_method_inst = new |UNIQUESTRING|_Display_Error( $|uniquestring|_error_notice );

				$error_method_inst->|uniquestring|_show_error();

				$this->|uniquestring|_isnt_error = $|uniquestring|_error_notice;

			}

		} else {

			// notice of error
			$|uniquestring|_error_notice = "The <b>\"{$class_name}\"</b> class not exists.";

			// show an error
			$error_class_inst = new |UNIQUESTRING|_Display_Error( $|uniquestring|_error_notice );

			$error_class_inst->|uniquestring|_show_error();

			$this->|uniquestring|_isnt_error = $|uniquestring|_error_notice;

		}
	
		// 
		return $this->|uniquestring|_isnt_error;

	}
	
}