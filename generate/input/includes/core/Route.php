<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

// Require Route Registrar class.
require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Route-Registrar.php';

/**
 * The |UNIQUESTRING|Route class.
 *
 * This class works together with 
 * |UNIQUESTRING|RouteRegistrar class and helps
 * create a menu pate in the admin panel.
 */
class |UNIQUESTRING|Route
{
    
    public static function get( ...$args )
    {

        return new |UNIQUESTRING|RouteRegistrar( ...$args );
    }
    
}
