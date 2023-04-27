<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class |UNIQUESTRING|Gutenberg
{

    public function registerBlocks()
    {

        // simple text
        add_action( 'init', [$this, 'simpleText'] );

    }

    /**
     * Blocks
     */
    // simple text
    public function simpleText()
    {
        register_block_type( __DIR__ . '/build/simple-text' );
    }

}

$gutenbergClassInstance = new |UNIQUESTRING|Gutenberg();

$gutenbergClassInstance->registerBlocks();
