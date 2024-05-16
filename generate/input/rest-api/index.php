<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The REST API main file.
 *
 * Here you can register your REST API endpoints.
 */

if (!function_exists('|uniquestring|_wpp_generator_get_endpoint_pages')) {
    /**
     * Return all the pages with status publish.
     * 
     * @return void
     */
    function |uniquestring|_wpp_generator_get_endpoint_pages()
    {

        $pages = get_pages([
            'post_status' => 'publish'
        ]);

        if (is_array($pages)) {

            foreach ($pages as $key => $value) {

                $content = apply_filters('the_content', $value->post_content);

                $pages[$key]->post_content = $content;
            }
        }

        return rest_ensure_response($pages);
    }
}

if (!function_exists('|uniquestring|_wpp_generator_get_endpoint_navigation')) {
    /**
     * Return navigation.
     * 
     * @return void
     */
    function |uniquestring|_wpp_generator_get_endpoint_navigation()
    {

        $navigation = get_posts([
            'post_type' => 'wp_navigation'
        ]);

        if (is_array($navigation)) {

            foreach ($navigation as $key => $value) {

                $content = apply_filters('the_content', $value->post_content);

                $navigation[$key]->post_content = $content;
            }
        }

        return rest_ensure_response($navigation);
    }
}

if (!function_exists('|uniquestring|_wpp_generator_register_example_routes')) {
    /**
     * Here you can register your routes
     * And example: http://example.local/wp-json/wpp-generator/v1/pages
     * @return void
     */
    function |uniquestring|_wpp_generator_register_example_routes()
    {

        /**
         * Get navigation.
         */
        register_rest_route('wpp-generator/v1', '/navigation', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => '|uniquestring|_wpp_generator_get_endpoint_navigation',
            'permission_callback' => '__return_true',
        ));

        /**
         * Get pages.
         */
        register_rest_route('wpp-generator/v1', '/pages', array(
            'methods'  => WP_REST_Server::READABLE,
            'callback' => '|uniquestring|_wpp_generator_get_endpoint_pages',
            'permission_callback' => '__return_true',
        ));
    }
}
add_action('rest_api_init', '|uniquestring|_wpp_generator_register_example_routes');
