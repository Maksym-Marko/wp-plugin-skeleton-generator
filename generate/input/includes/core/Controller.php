<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|Controller abstract class.
 *
 * Basic settings of Controller.
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
