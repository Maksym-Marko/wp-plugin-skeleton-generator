<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|AdminMain
{

	public $plugin_name;

	/*
	* |UNIQUESTRING|AdminMain constructor
	*/
	public function __construct()
	{

		$this->plugin_name = |UNIQUESTRING|_PLUGN_BASE_NAME;

		$this->|uniquestring|_include();

	}

	/*
	* Include the necessary basic files for the admin panel
	*/
	public function |uniquestring|_include()
	{

		// require database-talk class
		require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes\admin\class-database-talk.php';

	}

	/*
	* Registration of styles and scripts
	*/
	public function |uniquestring|_register()
	{

		// register scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, '|uniquestring|_enqueue' ) );

		// register admin menu
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

		// add link Settings under the name of the plugin
		add_filter( "plugin_action_links_$this->plugin_name", array( $this, 'settings_link' ) );

	}

		public function |uniquestring|_enqueue()
		{

			wp_enqueue_style( '|uniquestring|_font_awesome', |UNIQUESTRING|_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( '|uniquestring|_admin_style', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/css/style.css', array( '|uniquestring|_font_awesome' ), |UNIQUESTRING|_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( '|uniquestring|_admin_script', |UNIQUESTRING|_PLUGIN_URL . 'includes/admin/assets/js/script.js', array( 'jquery' ), |UNIQUESTRING|_PLUGIN_VERSION, false );

		}

		// register admin menu
		public function add_admin_pages()
		{

			add_menu_page( __( 'Title of the page', '|uniquestring|-domain' ), __( 'Link Name', '|uniquestring|-domain' ), 'manage_options', '|unique_menu_slug|', array( $this, 'admin_index' ), 'dashicons-image-filter', 111 ); // icons https://developer.wordpress.org/resource/dashicons/#id

			// add submenu
			add_submenu_page( '|unique_menu_slug|', __( 'Submenu title', '|uniquestring|-domain' ), __( 'Submenu item', '|uniquestring|-domain' ), 'manage_options', '|unique_submenu_slug|', array( $this, 'page_distributor' ) );

		}

			public function admin_index()
			{
				
				// require index page
				|uniquestring|_require_template_admin( 'index.php' );

			}

			public function page_distributor()
			{

				// require main menu
				|uniquestring|_require_template_admin( 'main_module_menu.php' );

				switch( $_GET['p'] ){

					case 'page1' :
						$action = 'page1.php';
						break;

					case 'page2' :
						$action = 'page2.php';
						break;

					default :
						$action = 'index.php';
						break;

				}

				// require pages
				|uniquestring|_require_template_admin( $action );

			}

		// add settings link
		public function settings_link( $links )
		{

			$settings_link = '<a href="admin.php?page=|unique_menu_slug|">Settings</a>'; // options-general.php

			array_push( $links, $settings_link );

			return $links;

		}

}

// Initialize
$initialize_class = new |UNIQUESTRING|AdminMain();

// Apply scripts and styles
$initialize_class->|uniquestring|_register();