<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class |UNIQUESTRING|AddShortcode
{

    public function shortcodeDisplayApp()
    {
        add_shortcode('|uniquestring|_display_app', [$this, 'displayApp']);
    }

    public function displayApp()
    {
        ob_start(); ?>

            <div id="|uniquestring|_app">

                <|uniquestring|_block
                    :open="open"
                ></|uniquestring|_block>

                <|uniquestring|_button
                    @toggle="toggle"
                    :open="open"
                ></|uniquestring|_button>

            </div>

        <?php return ob_get_clean();
    }

}