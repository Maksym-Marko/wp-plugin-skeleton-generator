<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_FrontEnd_Main
{

	/*
	* Registration of styles and scripts
	*/
	public function |uniquestring|_register()
	{

		add_action( 'wp_enqueue_scripts', array( $this, '|uniquestring|_enqueue' ) );

	}

		public function |uniquestring|_enqueue()
		{

			wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( '|uniquestring|_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/css/style.css', array( '|uniquestring|_font_awesome' ), |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( '|uniquestring|_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/js/script.js', array( 'jquery' ), |UNIQUESTRING|_PLUGIN_VERSION, false );

		}

}

// Initialize
$initialize_class = new |UNIQUESTRING|_FrontEnd_Main();

// Apply scripts and styles
$initialize_class->|uniquestring|_register();