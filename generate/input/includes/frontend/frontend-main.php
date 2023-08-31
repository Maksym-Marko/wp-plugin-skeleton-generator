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

    }

}

// Initialize
$initializeFrontendClass = new |UNIQUESTRING|FrontEndMain();

// include classes
$initializeFrontendClass->additionalClasses();
