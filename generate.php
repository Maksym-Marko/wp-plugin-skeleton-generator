<?php

final class MxGeneratePluginStructure
{

	public $scan_dir;

	public function __construct( $dir )
	{

		$this->scan_dir = $dir;

	}

	/*
	* Generate a new Plugin
	*/
	public function generatePlugin()
	{

		// run mx_scan_dir function
		$this->mx_scan_dir( $this->scan_dir );

	}

	/*
	* This function checks a particular directory
	*/
	public function mx_scan_dir( $dir )
	{

		$current_dirs = scandir( $dir );

		// create dir if is not exists
		$this->mx_create_dir( $dir );
		
		// each of all folders and files
		foreach ( $current_dirs as $key => $value ) {

			// exclude '.', '..'
			if( ! in_array( $value, array( '.', '..' ) ) ) :

				// find fiels
				if( $this->mx_is_file( $value ) ) :					

					// create file
					$this->create_plugin_file( $dir . $value );

				// find directories
				else :

					$this->mx_scan_dir( $dir . $value . '/' );

				endif;

			endif;

		}

	}

	/*
	* This function checks the current item. Return true if an element is a file
	*/
	public function mx_is_file( $obj )
	{

		$list_mime_type = array( 

			'.php',
			'.js',
			'.css',
			'.txt',
			'.jpg',
			'.png',
			'.otf',
			'.eot',
			'.svg',
			'.ttf',
			'.woff',
			'.woff2',

		);

		foreach ( $list_mime_type as $item_mime_type ) {
			
			if( strpos( $obj, $item_mime_type ) ) :

				return true;

				break;

			endif;

		}

		return false;

	}

	/*
	* This function creates a file and writes into it special information
	*/
	public function create_plugin_file( $input_file )
	{

		$input = $input_file;

		// Prepare the file for creation
		$output = str_replace( 'input', 'output', $input );

		// Get data from the source
		$current_content = file_get_contents($input);

		// Replace the flags with a unique string (UPC)
		$current_modify_unique_str_uk = str_replace( '|UNIQUESTRING|', 'WWWWWW', $current_content );

		// Replace the flags with a unique string (LOWC)
		$current_modify_unique_str_lk = str_replace( '|uniquestring|', 'wwwwww', $current_modify_unique_str_uk );

		// Create a unique class name
		$current_modify_unique_class_name = str_replace( '|UniqueClassMame|', 'UniqueClassName', $current_modify_unique_str_lk );

		// Write the name of the table in the uninstall.php file |table_slug| wwwwww_table_slug
		$current_create_unique_table_slug = str_replace( '|table_slug|', 'wwwwww_table_slug', $current_modify_unique_str_lk );

		// create file
		file_put_contents( $output, $current_modify_unique_class_name );

	}

	/*
	* Create new folder
	*/ 
	public function mx_create_dir( $dir )
	{

		$dir_in_output = str_replace( 'input', 'output', $dir );

		if( !file_exists( $dir_in_output ) ) :

			mkdir( $dir_in_output, 0777, true );

		endif;

	}

}

// Checking for empty value
// foreach( $_POST as $key => $value ) :

// 	if( empty( $value) ) :

// 		die( 'All fields are required!' );

// 	endif;

// endforeach;

// create a list of vars
$plugin_name = preg_replace( '/[^A-Za-z0-9\-|\s]/', '', $_POST['plugin_name'] );

// create unique string
$arr_words = str_word_count($plugin_name, 1);

$uniquestring = 'mx';

foreach( $arr_words as $key => $value ) :

	$uniquestring .= substr( $value, 0, 1 );

endforeach;

$uniquestring_upc = strtoupper( $uniquestring );

$uniquestring_lowc = strtolower( $uniquestring );

// unique class name
$unique_class_name = '';

// main file name
$main_file_name = strtolower( str_replace( ' ', '-', $plugin_name) );

$brief_description = htmlspecialchars( $_POST['brief_description'] );

$long_description = htmlspecialchars( $_POST['long_description'] );

$contributors = $_POST['contributors'];

$plugin_uri = $_POST['plugin_uri'];

$author = $_POST['author'];

$author_uri = $_POST['author_uri'];

// new instance
$new_instance = new MxGeneratePluginStructure( 'generate/input/' );

// $new_instance->generatePlugin();

