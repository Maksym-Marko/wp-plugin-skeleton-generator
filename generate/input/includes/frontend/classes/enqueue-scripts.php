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

        wp_enqueue_style( '|uniquestring|_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/css/style.css', [ '|uniquestring|_font_awesome' ], |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

        // include Vue.js
        // dev version
        // wp_enqueue_script('|uniquestring|_vue_js', |UNIQUESTRING|_PLUGIN_URL . 'assets/vue/vue.dev.js', [], UNIQUESTRING|_PLUGIN_VERSION, true);

        // production version
        wp_enqueue_script( '|uniquestring|_vue_js', |UNIQUESTRING|_PLUGIN_URL . 'assets/vue/vue.production.js', [], |UNIQUESTRING|_PLUGIN_VERSION, true );

        wp_enqueue_script( '|uniquestring|_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/js/build/script.min.js', [ 'jquery', '|uniquestring|_vue_js' ], |UNIQUESTRING|_PLUGIN_VERSION, true );
    }

}
