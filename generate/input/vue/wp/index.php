<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Some hooks and actions that help SPA be alive.
 *
 */

if (!function_exists('mxpfwra_wpp_generator_add_type_attribute')) {
    /**
     * Add type="module" for SPA main js file
     * 
     * @return void
     */
    function mxpfwra_wpp_generator_add_type_attribute($tag, $handle, $src)
    {
        if ('mxpfwra_wpp_generator_app_script' !== $handle) {
            return $tag;
        }
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        return $tag;
    }
}
add_filter('script_loader_tag', 'mxpfwra_wpp_generator_add_type_attribute', 10, 3);

if (!function_exists('mxpfwra_wpp_generator_scripts')) {
    /**
     * Enqueue SPA assets.
     * 
     * @return void
     */
    function mxpfwra_wpp_generator_scripts()
    {

        wp_enqueue_script('mxpfwra_wpp_generator_app_script', '/wp-content/plugins/plugin-for-wordpress-rest-api/vue/dist/assets/index.js', [], MXPFWRA_PLUGIN_VERSION, false);

        wp_enqueue_style('mxpfwra_wpp_generator_app_script_style', MXPFWRA_PLUGIN_URL . 'vue/dist/assets/index.css', [], MXPFWRA_PLUGIN_VERSION, 'all');
    }
}
add_action('wp_enqueue_scripts', 'mxpfwra_wpp_generator_scripts');
