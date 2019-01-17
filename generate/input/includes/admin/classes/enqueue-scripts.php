<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_Enqueue_Scripts
{

	/*
	* |UNIQUESTRING|_Enqueue_Scripts
	*/
	public function __construct()
	{

	}

	/*
	* Registration of styles and scripts
	*/
	public static function |uniquestring|_register()
	{

		// register scripts and styles
		add_action( 'admin_enqueue_scripts', array( '|UNIQUESTRING|_Enqueue_Scripts', '|uniquestring|_enqueue' ) );

	}

		public static function |uniquestring|_enqueue()
		{

			wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( '|uniquestring|_admin_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/css/style.css', array( '|uniquestring|_font_awesome' ), |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( '|uniquestring|_admin_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/js/script.js', array( 'jquery' ), |UNIQUESTRING|_PLUGIN_VERSION, false );

		}

}