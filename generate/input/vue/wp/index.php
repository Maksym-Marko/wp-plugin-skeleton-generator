<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Some hooks and actions that help SPA be alive.
 *
 */

if (!function_exists('|uniquestring|_wpp_generator_add_type_attribute')) {
    /**
     * Add type="module" for SPA main js file
     * 
     * @return void
     */
    function |uniquestring|_wpp_generator_add_type_attribute($tag, $handle, $src)
    {

        if ('|uniquestring|_wpp_generator_app_script' !== $handle) {

            return $tag;
        }

        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
}
add_filter('script_loader_tag', '|uniquestring|_wpp_generator_add_type_attribute', 10, 3);

if (!function_exists('|uniquestring|_wpp_generator_scripts')) {
    /**
     * Enqueue SPA assets.
     * 
     * @return void
     */
    function |uniquestring|_wpp_generator_scripts()
    {

        wp_enqueue_script('|uniquestring|_wpp_generator_app_script', |UNIQUESTRING|_PLUGIN_URL .'vue/dist/assets/index.js', [], |UNIQUESTRING|_PLUGIN_VERSION, false);

        wp_enqueue_style('|uniquestring|_wpp_generator_app_script_style', |UNIQUESTRING|_PLUGIN_URL . 'vue/dist/assets/index.css', [], |UNIQUESTRING|_PLUGIN_VERSION, 'all');
    }
}
add_action('wp_enqueue_scripts', '|uniquestring|_wpp_generator_scripts');
