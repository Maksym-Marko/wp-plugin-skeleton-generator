<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_FrontEnd_Main
{

	/*
	* |UNIQUESTRING|_FrontEnd_Main constructor
	*/
	public function __construct()
	{

	}

	/*
	* Additional classes
	*/
	public function |uniquestring|_additional_classes()
	{

		// enqueue_scripts class
		|uniquestring|_require_class_file_frontend( 'enqueue-scripts.php' );

		|UNIQUESTRING|_Enqueue_Scripts_Frontend::|uniquestring|_register();

	}

}

// Initialize
$initialize_admin_class = new |UNIQUESTRING|_FrontEnd_Main();

// include classes
$initialize_admin_class->|uniquestring|_additional_classes();