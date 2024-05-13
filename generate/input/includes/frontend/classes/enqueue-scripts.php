<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|EnqueueScriptsFrontend class.
 *
 * Here you can enqueue CSS and JS files 
 * on the frontend part.
 */
class |UNIQUESTRING|EnqueueScriptsFrontend
{

    /*
    * Registration of styles and scripts.
    */
    public static function registerScripts()
    {

        add_action( 'wp_enqueue_scripts', ['|UNIQUESTRING|EnqueueScriptsFrontend', 'enqueue'] );
    }

    public static function enqueue()
    {

        wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

        wp_enqueue_style( '|uniquestring|_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/build/index.css', [ '|uniquestring|_font_awesome' ], |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

        /*
        * Please uncomment this code if you're going
        * to use any Vue.js features or would like to
        * organize your JS code.
        */
        // wp_enqueue_script( '|uniquestring|_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/build/index.js', [ 'jquery', '|uniquestring|-vue-script' ], |UNIQUESTRING|_PLUGIN_VERSION, true );
    }

}
