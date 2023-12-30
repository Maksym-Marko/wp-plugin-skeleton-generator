<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|FrontEndMain class.
 *
 * Here you can register you classes.
 */
class |UNIQUESTRING|FrontEndMain
{

    /*
    * Additional classes
    */
    public function additionalClasses()
    {

        // enqueue_scripts class.
        |uniquestring|RequireClassFileFrontend( 'enqueue-scripts.php' );

        |UNIQUESTRING|EnqueueScriptsFrontend::registerScripts();

        // Add shortcode.
        |uniquestring|RequireClassFileFrontend( 'add-shortcode.php' );
        
        (new |UNIQUESTRING|AddShortcode)->shortcodeDisplayApp();
    }

}

/**
 * Initialization.
 */
$frontendClassInstance = new |UNIQUESTRING|FrontEndMain();

/**
 * Include classes to the global space.
 */
$frontendClassInstance->additionalClasses();
