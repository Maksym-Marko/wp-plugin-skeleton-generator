<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * This file contains global features for 
 * Admin and Frontend parts.
 */

 if (!function_exists('|uniquestring|_register_scripts')) {
    /**
     * Register scripts globally.
     * 
     * @return void
     */
    function |uniquestring|_register_scripts()
    {

        /**
         *  Enqueue Vue 2.
         * */
        wp_enqueue_script(
            '|uniquestring|-vue-script',
            |UNIQUESTRING|_PLUGIN_URL . 'assets/vue/vue.dev.js',
            // |UNIQUESTRING|_PLUGIN_URL . 'assets/vue/vue.production.js',
            [],
            |UNIQUESTRING|_PLUGIN_VERSION
        );

    }
}
add_action('wp_enqueue_scripts', '|uniquestring|_register_scripts');
add_action('admin_enqueue_scripts', '|uniquestring|_register_scripts');
