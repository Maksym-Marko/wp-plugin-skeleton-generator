<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Controllers class
*/
abstract class |UNIQUESTRING|Controller
{

	/**
	* Catch missing methods on the controller
	*/
	public function __call( $name, $arguments ) {

		echo esc_attr( 'Missing method "' . $name . '"!' );

	}
	
}
