<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// require Route-Registrar.php
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Route-Registrar.php';

/*
* Routes class
*/
class |UNIQUESTRING|_Route
{

	public function __construct()
	{
		// ...
	}
	
	public static function |uniquestring|_get( ...$args )
	{

		return new |UNIQUESTRING|_Route_Registrar( ...$args );

	}
	
}