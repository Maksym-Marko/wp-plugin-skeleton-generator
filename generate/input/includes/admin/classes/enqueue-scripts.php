<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|EnqueueScripts
{

    /*
    * Registration of styles and scripts
    */
    public static function registerScripts()
    {

        // register scripts and styles
        add_action( 'admin_enqueue_scripts', ['|UNIQUESTRING|EnqueueScripts', 'enqueue'] );

    }

        public static function enqueue()
        {

            wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

            wp_enqueue_style( '|uniquestring|_admin_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/css/style.css', [ '|uniquestring|_font_awesome' ], |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

            wp_enqueue_script( '|uniquestring|_admin_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/js/script.js', [ 'jquery' ], |UNIQUESTRING|_PLUGIN_VERSION, false );

            wp_localize_script( '|uniquestring|_admin_script', '|uniquestring|_admin_localize', [

                'ajaxurl'   => admin_url( 'admin-ajax.php' ),
                'main_page' => admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ),

            ] );

        }

}
