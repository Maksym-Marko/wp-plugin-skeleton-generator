<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|_Route_Registrar
{
	
	/**
	* set controller
	*/
	public $controller = '';

	/**
	* set action
	*/
	public $action = '';

	/**
	* set slug or parent menu slug
	*/
	public $slug = |UNIQUESTRING|_MAIN_MENU_SLUG;

	/**
	* catch class error
	*/
	public $class_attributes_error = NULL;

	/**
	* set properties
	*/
	public $properties = [
		'page_title' 	=> 'Title of the page',
		'menu_title' 	=> 'Link Name',
		'capability' 	=> 'manage_options',
		'menu_slug' 	=> |UNIQUESTRING|_MAIN_MENU_SLUG,
		'dashicons' 	=> 'dashicons-image-filter',
		'position' 		=> 111
	];

	/**
	* set slug of sub menu
	*/
	public $sub_menu_slug = false;

	/**
	* set plugin name
	*/
	public $plugin_name;

	/**
	* |UNIQUESTRING|_Route_Registrar constructor
	*/
	public function __construct( ...$args )
	{

		$this->plugin_name = |UNIQUESTRING|_PLUGN_BASE_NAME;

		// set data
		$this->|uniquestring|_set_data( ...$args );

	}

	/**
	* require class
	*/
	public function |uniquestring|_require_controller( $controller )
	{

		if( file_exists( |UNIQUESTRING|_PLUGIN_ABS_PATH . "includes/admin/controllers/{$controller}.php" ) ) {

			require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . "includes/admin/controllers/{$controller}.php";

		}

	}

	/**
	* $controller 		- Controller
	*
	* $action 			- Action
	*
	* $slug 			- if NULL - menu item will investment into
	*						|UNIQUESTRING|_MAIN_MENU_SLUG menu item
	*
	* $menu_properties 	- menu properties
	*
	* $sub_menu_slug 	- slug of sub menu
	*
	* $settings_area 	- place item to settings area (core WP Settings menu item)
	*
	*/
	public function |uniquestring|_set_data( $controller, $action, $slug = |UNIQUESTRING|_MAIN_MENU_SLUG, array $menu_properties, $sub_menu_slug = false, $settings_area = false )
	{

		// set controller
		$this->controller = $controller;

		// set action
		$this->action = $action;

		// set slug
		if( $slug == NULL ) {

			$this->slug = |UNIQUESTRING|_MAIN_MENU_SLUG;

		} else {

			$this->slug = $slug;

		}

		// set properties
		foreach ( $menu_properties as $key => $value ) {
			
			$this->properties[$key] = $value;

		}

		// callback function
		$|uniquestring|_callback_function_menu = '|uniquestring|_create_admin_main_menu';

		/*
		* check if it's submenu
		* set sub_menu_slug
		*/
		if( $sub_menu_slug !== false ) {

			$this->sub_menu_slug = $sub_menu_slug;

			$|uniquestring|_callback_function_menu = '|uniquestring|_create_admin_sub_menu';
			
		}

		/*
		* check if it's settings menu item
		*/
		if( $settings_area !== false ) {

			$|uniquestring|_callback_function_menu = '|uniquestring|_settings_area_menu_item';

			// add link Settings under the name of the plugin
			add_filter( "plugin_action_links_$this->plugin_name", array( $this, '|uniquestring|_create_settings_link' ) );
			
		}

		/**
		* require controller
		*/
		$this->|uniquestring|_require_controller( $this->controller );

		/**
		* catching errors of class attrs
		*/
		$is_error_class_atr = |UNIQUESTRING|_Catching_Errors::|uniquestring|_catch_class_attributes_error( $this->controller, $this->action );
		
		// catch error class attr
		if( $is_error_class_atr !== NULL ) {

			$this->class_attributes_error = $is_error_class_atr;

		}

		// register admin menu
		add_action( 'admin_menu', array( $this, $|uniquestring|_callback_function_menu ) );

	}

	/**
	* Create Main menu
	*/
	public function |uniquestring|_create_admin_main_menu()
	{

		add_menu_page( __( $this->properties['page_title'], '|uniquestring|-domain' ),
			 __( $this->properties['menu_title'], '|uniquestring|-domain' ),
			 $this->properties['capability'],
			 $this->slug,
			 array( $this, '|uniquestring|_view_connector' ),
			 $this->properties['dashicons'], // icons https://developer.wordpress.org/resource/dashicons/#id
			 $this->properties['position'] );

	}

	/**
	* Create Sub menu
	*/
	public function |uniquestring|_create_admin_sub_menu()
	{
		
		// create a sub menu
		add_submenu_page( $this->slug,
			 __( $this->properties['page_title'], '|uniquestring|-domain' ),
			 __( $this->properties['menu_title'], '|uniquestring|-domain' ),
			 $this->properties['capability'],
			 $this->sub_menu_slug,
			 array( $this, '|uniquestring|_view_connector' )
		);

	}

	/**
	* Create Settings area menu item
	*/
	public function |uniquestring|_settings_area_menu_item()
	{
		
		// create a settings menu
		add_options_page(
			__( $this->properties['page_title'], '|uniquestring|-domain' ),
			__( $this->properties['menu_title'], '|uniquestring|-domain' ),
			$this->properties['capability'],
			$this->sub_menu_slug,
			array( $this, '|uniquestring|_view_connector' )
		);

	}
		public function |uniquestring|_create_settings_link( $links )
		{

			$settings_link = '<a href="' . get_admin_url() . 'admin.php?page=' . $this->sub_menu_slug . '">' . __( $this->properties['menu_title'], '|uniquestring|-domain' ) . '</a>'; // options-general.php

			array_push( $links, $settings_link );

			return $links;

		}

		// connect view
		public function |uniquestring|_view_connector()
		{

			if( $this->class_attributes_error == NULL ) {

				$class_inst = new $this->controller();

				call_user_func( array( $class_inst, $this->action ) );

			}
			
		}

}