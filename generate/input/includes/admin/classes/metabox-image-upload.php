<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Metaboxes. Upload images
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
