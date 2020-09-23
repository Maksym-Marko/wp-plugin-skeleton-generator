<?php

final class MxGeneratePluginStructure
{

	// directory with source code
	public $scan_dir;

	// plugin name
	public $plugin_name;

	// unique string (upper case)
	public $uniquestring_upc;

	// Unique string (upper case)
	public $uniquestring_lowc;

	// unique string (lowercase)
	public $unique_class_name;

	// main file name
	public $main_file_name;

	// brief description
	public $brief_description;

	// long description
	public $long_description;

	// contributors
	public $contributors;

	// plugin URL
	public $plugin_uri;

	// author's name
	public $author;

	// author URL
	public $author_uri;

	// constructor
	public function __construct( $array_vars, $dir )
	{
		
		$this->plugin_name 			= $array_vars['plugin_name'];
		$this->uniquestring_upc 	= $array_vars['uniquestring_upc'];
		$this->uniquestring_lowc 	= $array_vars['uniquestring_lowc'];
		$this->unique_class_name 	= $array_vars['unique_class_name'];
		$this->main_file_name 		= $array_vars['main_file_name'];
		$this->brief_description 	= $array_vars['brief_description'];
		$this->long_description 	= $array_vars['long_description'];
		$this->contributors 		= $array_vars['contributors'];
		$this->plugin_uri 			= $array_vars['plugin_uri'];
		$this->author 				= $array_vars['author'];
		$this->author_uri 			= $array_vars['author_uri'];
		$this->scan_dir 			= $dir;

	}

	/*
	* Generate a new Plugin
	*/
	public function generatePlugin()
	{

		// run mx_scan_dir function
		$this->mx_scan_dir( $this->scan_dir );

		echo $this->main_file_name;


	}

	/*
	* This function checks a particular directory
	*/
	public function mx_scan_dir( $dir )
	{

		$current_dirs = scandir( $dir );

		// create dir if is not exists
		// $this->mx_create_dir( $dir );
		
		// each of all folders and files
		foreach ( $current_dirs as $key => $value ) {

			// exclude '.', '..'
			if( ! in_array( $value, [ '.', '..' ] ) ) :

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

		$list_mime_type = [ 

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
			'.mo',
			'.po',
			'.pot',

		];

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
		/*rename  main file*/
		if( $input == 'generate/input/wp-plugin-skeleton.php' ) {

			$output = 'generate/output/' . $this->main_file_name . '/' . $this->main_file_name . '.php';
		}
		/*rename  controller*/
		elseif( $input == 'generate/input/includes/admin/controllers/MXXXXX_Main_Page_Controller.php' ) {

			$output = 'generate/output/' . $this->main_file_name . '/includes/admin/controllers/' . $this->uniquestring_upc . '_Main_Page_Controller.php';
		}
		/*rename  model*/
		elseif( $input == 'generate/input/includes/admin/models/MXXXXX_Main_Page_Model.php' ) {

			$output = 'generate/output/' . $this->main_file_name . '/includes/admin/models/' . $this->uniquestring_upc . '_Main_Page_Model.php';
		}
		/*miss*/
		else {

			$output = str_replace( 'input', 'output/' . $this->main_file_name, $input );

		}

		// Get data from the source
		$current_content = file_get_contents($input);

		// Replace the flags with a unique string (UPC)
		$current_modify_unique_str_upc = str_replace( '|UNIQUESTRING|', $this->uniquestring_upc, $current_content );

		// Replace the flags with a unique string (LOWC)
		$current_modify_unique_str_lowc = str_replace( '|uniquestring|', $this->uniquestring_lowc, $current_modify_unique_str_upc );

		// Create a unique class name
		$current_modify_unique_class_name = str_replace( '|UniqueClassName|', $this->unique_class_name, $current_modify_unique_str_lowc );

		// Write the name of the table in the uninstall.php file
		$current_create_unique_table_slug = str_replace( '|table_slug|', $this->uniquestring_lowc . '_table_slug', $current_modify_unique_class_name );

		// plugin name		
		$current_create_plugin_name = str_replace( '|Plugin Name|', $this->plugin_name, $current_create_unique_table_slug );

		// main file name
		$current_create_main_file_name = str_replace( 'wp-plugin-skeleton', $this->main_file_name, $current_create_plugin_name );

		// brief description
		$current_create_brief_description = str_replace( '|Brief description|', $this->brief_description, $current_create_main_file_name );

		// long description
		$current_create_long_description = str_replace( '|Long description|', $this->long_description, $current_create_brief_description );

		// contributors
		$current_create_contributors = str_replace( '|Contributors|', $this->contributors, $current_create_long_description );

		// plugin URL
		$current_create_plugin_uri = str_replace( '|Plugin URI|', $this->plugin_uri, $current_create_contributors );

		// author
		$current_create_author = str_replace( '|Author|', $this->author, $current_create_plugin_uri );

		// author URL
		$current_create_author_uri = str_replace( '|Author URI|', $this->author_uri, $current_create_author );

		// unique menu slug
		$current_create_menu_slug = str_replace( '|unique_menu_slug|', $this->uniquestring_lowc . '-' . $this->main_file_name . '-menu', $current_create_author_uri );

		// unique submenu slug
		$current_create_submenu_slug = str_replace( '|unique_submenu_slug|', $this->uniquestring_lowc . '-' . $this->main_file_name . '-submenu', $current_create_menu_slug );

		// final appearance
		$mx_final = $current_create_submenu_slug;

		// create file
		// file_put_contents( $output, $mx_final );

		$this->mx_create_zip( 'generate/output/' . $this->main_file_name . '.zip', $output, $mx_final );

	}

	/*
	* Create new folder
	*/ 
	public function mx_create_dir( $dir )
	{

		$dir_in_output = str_replace( 'input', 'output/' . $this->main_file_name, $dir );

		if( !file_exists( $dir_in_output ) ) :

			mkdir( $dir_in_output, 0777, true );

		endif;

	}

	/*
	* Create new folder
	*/ 
	public function mx_create_zip( $zip_arhive, $file, $input )
	{

		$file = str_replace( 'generate/output/', '', $file );

		$zip = new ZipArchive;

		if ( $zip->open( $zip_arhive ) !== TRUE ) {

			$res = $zip->open( $zip_arhive, ZipArchive::CREATE );

		}

		$zip->addFromString( $file, $input );

		$zip->close();

	}

}

// if $_POST is empty
if( empty( $_POST) ) :

	die( 'Nothing sent!' );

endif;

// Checking for empty value
foreach( $_POST as $key => $value ) :

	if( empty( $value) ) :

		die( 'All fields are required!' );

	endif;

endforeach;

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
$unique_class_name = $uniquestring_upc;

foreach( $arr_words as $key => $value ) :

	$unique_class_name .= ucfirst( $value );

endforeach;

// main file name
$main_file_name = strtolower( str_replace( ' ', '-', $plugin_name) );

$brief_description = htmlspecialchars( $_POST['brief_description'] );

$long_description = htmlspecialchars( $_POST['long_description'] );

$contributors = $_POST['contributors'];

$plugin_uri = $_POST['plugin_uri'];

$author = $_POST['author'];

$author_uri = $_POST['author_uri'];

// array vars
$array_vars = [

	'plugin_name' 		=> $plugin_name,
	'uniquestring_upc'	=> $uniquestring_upc,
	'uniquestring_lowc'	=> $uniquestring_lowc,
	'unique_class_name'	=> $unique_class_name,
	'main_file_name'	=> $main_file_name,
	'brief_description'	=> $brief_description,
	'long_description'	=> $long_description,
	'contributors'		=> $contributors,
	'plugin_uri'		=> $plugin_uri,
	'author'			=> $author,
	'author_uri'		=> $author_uri

];

// new instance
$new_instance = new MxGeneratePluginStructure( $array_vars, 'generate/input/' );

$new_instance->generatePlugin();