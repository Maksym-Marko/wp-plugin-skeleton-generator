<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|Gutenberg class.
 *
 * Here you can register you own
 * Gutenberg blocks.
 */
class |UNIQUESTRING|Gutenberg
{

    public function registerBlocks()
    {

        // Blocks extending.
        add_action('enqueue_block_editor_assets', [$this, 'blocksExtendingScript']);
        add_filter('render_block', [$this, 'blocksExtendingRender'], 10, 2);

        // Full width section image.
        add_action('init', [$this, 'fullWidthSectionImage']);

        // Content slider.
        add_action('init', [$this, 'contentSlider']);
        add_action('wp_enqueue_scripts', [$this, 'contentSliderScripts']);

        // Full width section.
        add_action('init', [$this, 'fullWidthSection']);

        // Responsive spacer.
        add_action('init', [$this, 'responsiveSpacer']);

        // Counter section.
        add_action('init', [$this, 'counterSection']);

        // Nested blocks.
        add_action('init', [$this, 'nestedBlocks']);

        // Image section.
        add_action('init', [$this, 'imageSection']);

        // Simple image.
        add_action('init', [$this, 'simpleImage']);

        // Simple text.
        add_action('init', [$this, 'simpleText']);

        // Server side rendering.
        add_action('init', [$this, 'serverSideRendering']);
    }

    /**
     * Extending example.
     */
    public function  blocksExtendingScript()
    {

        $config = require_once __DIR__ . '/build/extending/index.asset.php';
        
        wp_enqueue_script(
            'extending-gutenberg-script',
            |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/build/extending/index.js',
            $config['dependencies'],
            $config['version']
        );
    }

    public function blocksExtendingRender(string $blockContent, array $block)
    {

        if (
            $block['blockName'] !== 'core/paragraph' && 
            $block['blockName'] !== 'core/heading' && 
            $block['blockName'] !== 'core/button' && 
            ! isset($block['attrs']['extendedSettings'])
        ) {
            return $blockContent;
        }

        if(!isset($block['attrs']['extendedSettings']['prompt'])) {
            return $blockContent;
        }

        if($block['attrs']['extendedSettings']['prompt'] == '') {
            return $blockContent;
        }

        $blockContent = preg_replace('#^<([^>]+)>#m', '<$1 data-oa-prompt="' . esc_html($block['attrs']['extendedSettings']['prompt']) . '">', $blockContent);
    
        return $blockContent;
    }

    /**
     * Blocks
     */

    // Full width section image.
    public function fullWidthSectionImage()
    {

        register_block_type(__DIR__ . '/build/full-width-section-image');
    }

    // Content slider.
    public function contentSlider()
    {

        register_block_type(__DIR__ . '/build/content-slider');
    }

    public function contentSliderScripts()
    {

        $asset_file = include('build/responsive-spacer/index.asset.php');

        // Owl css.
        wp_enqueue_style(
            'owl-carousel',
            |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/content-slider/css/owl.carousel.min.css',
            [],
            $asset_file['version']
        );

        // Owl js.
        wp_enqueue_script(
            'owl-carousel',
            |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/content-slider/js/owl.carousel.min.js',
            ['jquery'],
            $asset_file['version'],
            true
        );

        // Owl handler.js
        wp_enqueue_script(
            'mx-owl-carousel-handler',
            |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/content-slider/js/handler.js',
            ['owl-carousel'],
            $asset_file['version'],
            true
        );
    }

    // Full width section.
    public function fullWidthSection()
    {

        register_block_type(__DIR__ . '/build/full-width-section');
    }

    // Main banner.
    public function mainBanner()
    {

        register_block_type(__DIR__ . '/build/main-banner');
    }

    // Responsive spacer.
    public function responsiveSpacer()
    {

        register_block_type( __DIR__ . '/build/responsive-spacer' );
    }

    public function responsive_spacer_dynamic_render_callback($block_attributes)
    {

        ob_start();

        include  __DIR__ . '/src/responsive-spacer/callback.php';

        return ob_get_clean();
    }

    // Counter section.
    public function counterSection()
    {

        register_block_type(__DIR__ . '/build/counter-section');

        /**
         * Children blocks.
         */
        // Block one.
        register_block_type(__DIR__ . '/build/counter-section/child-blocks/block-one');

        // Let's add animation.
        wp_enqueue_style('|uniquestring|_animate_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/counter-section/css/animate.min.css');

        $asset_file = include('build/counter-section/index.asset.php');

        // WOW.
        wp_enqueue_script('|uniquestring|_counter_section_wow', |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/counter-section/js/wow.min.js', ['jquery', ...$asset_file['dependencies']], |UNIQUESTRING|_PLUGIN_VERSION, true);

        // WAYPOINTS.
        wp_enqueue_script('|uniquestring|_counter_section_waypoints', |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/counter-section/js/waypoints.min.js', ['|uniquestring|_counter_section_wow'], |UNIQUESTRING|_PLUGIN_VERSION, true);

        // COUNTERUP.
        wp_enqueue_script('|uniquestring|_counter_section_counterup', |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/counter-section/js/counterup.min.js', ['|uniquestring|_counter_section_waypoints'], |UNIQUESTRING|_PLUGIN_VERSION, true);

        // Main.
        wp_enqueue_script('|uniquestring|_counter_section_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/assets/counter-section/js/script.js', ['|uniquestring|_counter_section_counterup'], |UNIQUESTRING|_PLUGIN_VERSION, true);
    }

    // Nested blocks.
    public function nestedBlocks()
    {
        register_block_type(__DIR__ . '/build/nested-blocks');

        /**
         * Children blocks.
         */
        // Block one.
        register_block_type(__DIR__ . '/build/nested-blocks/child-blocks/block-one');
    }

    // Image section.
    public function imageSection()
    {

        register_block_type(__DIR__ . '/build/image-section');
    }

    // Simple image.
    public function simpleImage()
    {

        register_block_type(__DIR__ . '/build/simple-image');
    }

    // Simple text.
    public function simpleText()
    {

        register_block_type(__DIR__ . '/build/simple-text');
    }

    // Server side rendering.
    public function serverSideRendering()
    {

        $asset_file = include('build/server-side-rendering/index.asset.php');

        wp_register_script(
            'mx_server_side_rendering_script',
            |UNIQUESTRING|_PLUGIN_URL . 'includes/gutenberg/build/server-side-rendering/index.js',
            $asset_file['dependencies'],
            $asset_file['version'],
            true
        );

        register_block_type(
            __DIR__ . '/build/server-side-rendering',
            [
                'api_version'       => 2,
                'category'          => 'design',
                'attributes'        => [
                    'postsNumber'   => [
                        'type' => 'string',
                        'default' => 4
                    ]
                ],
                'editor_script' => 'mx_server_side_rendering_script',
                'render_callback'   => [$this, 'server_side_rendering_dynamic_render_callback'],
                'skip_inner_blocks' => true,
            ]
        );
    }

    public function server_side_rendering_dynamic_render_callback($block_attributes, $content)
    {

        global $wpdb;

        $tableName = $wpdb->prefix . 'posts';

        $displayPostsNumber = 4;
        if (isset($block_attributes['postsNumber'])) {
            $displayPostsNumber = $block_attributes['postsNumber'];
        }

        $numberOfPostsInDB = $wpdb->get_var("SELECT COUNT(ID) FROM $tableName");

        ob_start();

        var_dump($numberOfPostsInDB, $displayPostsNumber);

        return ob_get_clean();
    }
}

/**
 * Initialization.
 */
$gutenbergClassInstance = new |UNIQUESTRING|Gutenberg();

/**
 * Register custom Gutenberg blocks.
 */
$gutenbergClassInstance->registerBlocks();
