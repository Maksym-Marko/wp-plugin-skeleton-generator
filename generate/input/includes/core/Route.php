<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// require Route-Registrar.php
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Route-Registrar.php';

/*
* Routes class
*/
class |UNIQUESTRING|Route
{
	
	public static function get( ...$args )
	{

		return new |UNIQUESTRING|RouteRegistrar( ...$args );

	}
	
}
