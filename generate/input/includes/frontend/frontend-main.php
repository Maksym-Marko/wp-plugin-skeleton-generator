<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class |UNIQUESTRING|FrontEndMain
{

    /*
    * Additional classes
    */
    public function additionalClasses()
    {

        // enqueue_scripts class
        |uniquestring|RequireClassFileFrontend( 'enqueue-scripts.php' );

        |UNIQUESTRING|EnqueueScriptsFrontend::registerScripts();

        // add shortcode
        |uniquestring|RequireClassFileFrontend( 'add-shortcode.php' );
        
        (new |UNIQUESTRING|AddShortcode)->shortcodeDisplayApp();

    }

}

// Initialize
$initializeFrontendClass = new |UNIQUESTRING|FrontEndMain();

// include classes
$initializeFrontendClass->additionalClasses();
