<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|RouteRegistrar class.
 *
 * This class works together with 
 * |UNIQUESTRING|Route class and helps
 * create a menu pate in the admin panel.
 */
class |UNIQUESTRING|RouteRegistrar
{

    /**
    * Set controller.
    */
    public $controller = '';

    /**
    * Set action.
    */
    public $action     = '';

    /**
    * Set slug or parent menu slug.
    */
    public $slug = |UNIQUESTRING|_MAIN_MENU_SLUG;

    /**
    * Catch class error.
    */
    public $classAttributesError = NULL;

    /**
    * Set properties.
    */
    public $properties = [
        'page_title' => 'Title of the page',
        'menu_title' => 'Link Name', 'wp-plugin-skeleton',
        'capability' => 'manage_options',
        'menu_slug'  => |UNIQUESTRING|_MAIN_MENU_SLUG,
        'dashicons'  => 'dashicons-image-filter',
        'position'   => 111
    ];

    /**
    * Set slug of sub menu.
    */
    public $subMenuSlug = false;

    /**
    * Set plugin name.
    */
    public $pluginName;
   
    /**
     * |UNIQUESTRING|RouteRegistrar constructor
     * 
     * @param string $args  List of data needed for 
     * admin menu creation.
     *
     * @return void
     */
    public function __construct( ...$args )
    {

        $this->pluginName = |UNIQUESTRING|_PLUGN_BASE_NAME;

        // Set data.
        $this->|uniquestring|SetData( ...$args );
    }

    /**
     * Require class.
     * 
     * @param string $controller  Name of controller's file.
     *
     * @return void
     */
    public function requireController( $controller )
    {

        if (file_exists(|UNIQUESTRING|_PLUGIN_ABS_PATH . "includes/admin/controllers/{$controller}.php")) {
            require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . "includes/admin/controllers/{$controller}.php";
        }
    }

    /**
     * Create an admin menu.
     * 
     * @param string $controller           Controller name.
     * @param string $action               Action name.
     * @param string $slug                 if NULL - menu item
     * will be investment into.
     * |UNIQUESTRING|_MAIN_MENU_SLUG menu item.
     * @param array $menuProperties        Menu properties.
     * @param string|boolean $subMenuSlug  Slug of sub menu.
     * @param boolean $settingsArea        Place item to settings area
     * (core WP Settings menu item).
     *
     * @return void
     */
    public function |uniquestring|SetData( $controller, $action, $slug = |UNIQUESTRING|_MAIN_MENU_SLUG, array $menuProperties = [], $subMenuSlug = false, $settingsArea = false )
    {

        // Set controller.
        $this->controller = $controller;

        // Set action.
        $this->action     = $action;

        // Set slug.
        if ($slug == NULL) {

            $this->slug = |UNIQUESTRING|_MAIN_MENU_SLUG;
        } else {

            $this->slug = $slug;
        }

        // Set properties.
        foreach ($menuProperties as $key => $value) {
            $this->properties[$key] = $value;
        }

        // Callback function.
        $|uniquestring|CallbackFunctionMenu = 'createAdminMainMenu';

        // Check if it's submenu.
        if ($subMenuSlug !== false) {

            $this->subMenuSlug = $subMenuSlug;

            $|uniquestring|CallbackFunctionMenu = 'createAdminSubMenu';            
        }

        // Check if it's settings menu item.
        if ($settingsArea !== false) {

            $|uniquestring|CallbackFunctionMenu = 'settingsAreaMenuItem';

            // Sdd link "Settings" under the name of the plugin.
            add_filter( "plugin_action_links_$this->pluginName", [$this, 'createSettingsLink'] );
        }

        // Require controller.
        $this->requireController( $this->controller );

        // Catching errors of class attrs.
        $isErrorClassAtr = |UNIQUESTRING|CatchingErrors::catchClassAttributesError( $this->controller, $this->action );
        
        if ($isErrorClassAtr !== NULL) {
            $this->classAttributesError = $isErrorClassAtr;
        }

        // Register admin menu.
        add_action( 'admin_menu', [$this, $|uniquestring|CallbackFunctionMenu] );
    }

    /**
    * Create Main menu.
    */
    public function createAdminMainMenu()
    {

        add_menu_page( 
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['page_title']),
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['menu_title']),
            $this->properties['capability'],
            $this->slug,
            [ $this, 'viewConnector' ],
            $this->properties['dashicons'], // icons https://developer.wordpress.org/resource/dashicons/#id
            $this->properties['position'] );
    }

    /**
    * Create Sub menu.
    */
    public function createAdminSubMenu()
    {
        
        add_submenu_page( $this->slug,
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['page_title']),
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['menu_title']),
            $this->properties['capability'],
            $this->subMenuSlug,
            [ $this, 'viewConnector' ]
        );
    }

    /**
    * Create Settings area menu item.
    */
    public function settingsAreaMenuItem()
    {
        
        add_options_page(
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['page_title']),
            sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['menu_title']),
            $this->properties['capability'],
            $this->subMenuSlug,
            [ $this, 'viewConnector' ]
        );
    }

    /**
    * Create Settings link.
    */
    public function createSettingsLink( $links )
    {

        $settingsLink = '<a href="' . get_admin_url() . 'admin.php?page=' . $this->subMenuSlug . '">' . sprintf( esc_html__( '%s', 'wp-plugin-skeleton' ), $this->properties['menu_title']) . '</a>'; // options-general.php

        array_push( $links, $settingsLink );

        return $links;
    }

    // Connect a view.
    public function viewConnector()
    {

        if ($this->classAttributesError == NULL) {

            $classInstance = new $this->controller();

            call_user_func( [$classInstance, $this->action] );
        }
    }

}
