<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class |UNIQUESTRING|Gutenberg
{

    public function registerBlocks()
    {

        // nested blocks
        add_action( 'init', [$this, 'nestedBlocks'] );
        
        // image section
        add_action( 'init', [$this, 'imageSection'] );
        
        // simple image
        add_action( 'init', [$this, 'simpleImage'] );
        
        // simple text
        add_action( 'init', [$this, 'simpleText'] );

        // server side rendering
        add_action('init', [$this, 'serverSideRendering']);

    }

    /**
     * Blocks
     */

    // nested blocks
    public function nestedBlocks()
    {
        register_block_type( __DIR__ . '/build/nested-blocks' );

        // children blocks
        // block one
        register_block_type( __DIR__ . '/build/nested-blocks/child-blocks/block-one' );
    }
    
    // image section
    public function imageSection()
    {
        register_block_type( __DIR__ . '/build/image-section' );
    }

    // simple image
    public function simpleImage()
    {
        register_block_type( __DIR__ . '/build/simple-image' );
    }

    // simple text
    public function simpleText()
    {
        register_block_type( __DIR__ . '/build/simple-text' );
    }

    // server side rendering
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

$gutenbergClassInstance = new |UNIQUESTRING|Gutenberg();

$gutenbergClassInstance->registerBlocks();
