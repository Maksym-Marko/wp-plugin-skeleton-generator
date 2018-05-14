<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|FrontEndMain
{

	/*
	* Registration of styles and scripts
	*/
	public function register()
	{

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	}

		public function enqueue()
		{

			wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( '|uniquestring|_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/css/style.css', array( '|UNIQUESTRING|_font_awesome' ), |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( '|uniquestring|_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/frontend/assets/js/script.js', array( 'jquery' ), |UNIQUESTRING|_PLUGIN_VERSION, false );

		}

}

// Initialize
$initialize_class = new |UNIQUESTRING|FrontEndMain();

// Apply scripts and styles
$initialize_class->register();