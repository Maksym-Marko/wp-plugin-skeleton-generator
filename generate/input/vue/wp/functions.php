<?php

add_filter('script_loader_tag', 'wpp_generator_add_type_attribute', 10, 3);

function wpp_generator_add_type_attribute($tag, $handle, $src)
{
    if ('wpp_generator_app_script' !== $handle) {
        return $tag;
    }
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    return $tag;
}

// Enqueue frontend assets.
function wpp_generator_scripts()
{

    wp_enqueue_script('wpp_generator_app_script', '/wp-content/plugins/plugin-for-wordpress-rest-api/vue/dist/assets/index.js', [], MXPFWRA_PLUGIN_VERSION, false);

    wp_enqueue_style('wpp_generator_app_script_style', MXPFWRA_PLUGIN_URL . 'vue/dist/assets/index.css', [], MXPFWRA_PLUGIN_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'wpp_generator_scripts');

add_shortcode('wpp_generator_wrapper', function () {

    ob_start();

    echo '<div id="app"></div>';

    return ob_get_clean();
});
