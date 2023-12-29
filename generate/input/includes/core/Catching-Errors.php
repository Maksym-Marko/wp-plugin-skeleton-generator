<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Require Display Error feature.
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/error_handle/Display-Error.php';

// Require Handle Error feature.
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/error_handle/Error-Handle.php';

/**
 * The |UNIQUESTRING|CatchingErrors class.
 *
 * Catching errors.
 */
class |UNIQUESTRING|CatchingErrors
{

	/**
	* Show notification missing class or methods.
	*/
	public static function catchClassAttributesError( $className, $method )
	{

		$errorClassInstance = new |UNIQUESTRING|ErrorHandle();

		$errorDisplay = $errorClassInstance->classAttributesError( $className, $method );

		$error = NULL;

		if ($errorDisplay !== true) {
			$error = $errorDisplay;
		}		

		return $error;
	}

}
