<?php 

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|MetaboxesImageUpload class.
 *
 * This Class helps upload images via Metaboxes.
 */
class |UNIQUESTRING|MetaboxesImageUpload
{

    public static function registerScripts()
    {

        add_action( 'admin_enqueue_scripts', ['|UNIQUESTRING|MetaboxesImageUpload', 'upload_image_scrips'] );
    }

    public static function upload_image_scrips()
    {

        wp_enqueue_script( '|uniquestring|_image-upload', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/js/image-upload.js', ['jquery'], |UNIQUESTRING|_PLUGIN_VERSION, false );
    }

}
