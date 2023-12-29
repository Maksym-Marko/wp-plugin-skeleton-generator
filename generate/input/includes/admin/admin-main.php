<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|AdminMain class.
 *
 * Here you can register you classes.
 */
class |UNIQUESTRING|AdminMain
{

    /*
    * List of model names used in the plugin.
    */
    public $modelsCollection = [
        '|UNIQUESTRING|MainAdminModel'
    ];

    /*
    * Additional classes.
    */
    public function additionalClasses()
    {

        // Enqueue scripts.
        |uniquestring|RequireClassFileAdmin( 'enqueue-scripts.php' );

        |UNIQUESTRING|EnqueueScripts::registerScripts();

        // Metaboxes engine.
        |uniquestring|RequireClassFileAdmin( 'metabox.php' );

        |uniquestring|RequireClassFileAdmin( 'metabox-image-upload.php' );

        |UNIQUESTRING|MetaboxesImageUpload::registerScripts();
        
        // CPT, Taxonomies and Metaboxes.
        |uniquestring|RequireClassFileAdmin( 'cpt.php' );

        |UNIQUESTRING|CPTGenerator::createCPT();

        // Custom table.
        |uniquestring|RequireClassFileAdmin( 'custom-table.php' );

        // Improve search (*must be prepared for a particular situation).
		// |uniquestring|RequireClassFileAdmin( 'improve-search.php' );
    }

    /*
    * Models Connection.
    */
    public function modelsCollection()
    {

        foreach ($this->modelsCollection as $model) {            
            |uniquestring|UseModel( $model );
        }
    }

    /**
    * AJAX actions registration.
    */
    public function registrationAjaxActions()
    {

        |UNIQUESTRING|MainAdminModel::wpAjax();
    }

    /*
    * Routes collection.
    */
    public function routesCollection()
    {

        // Main menu item.
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'index', '', [
            'page_title' => 'Main Menu title',
            'menu_title' => 'Main menu'
        ] );

            // Edit a single table item.
            |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'singleTableItem', 'NULL', [
                'page_title' => 'Single Table Item',
            ], |UNIQUESTRING|_SINGLE_TABLE_ITEM_MENU );

            // Create a single table item.
            |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'createTableItem', 'NULL', [
                'page_title' => 'Create Table Item',
            ], |UNIQUESTRING|_CREATE_TABLE_ITEM_MENU );

        // Sub menu item.
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'submenu', '', [
            'page_title' => 'Sub Menu title',
            'menu_title' => 'Sub menu'
        ], '|uniquestring|-sub-menu' );

        // Hide menu item.
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'hidemenu', 'NULL', [
            'page_title' => 'Hidden Menu title',
        ], '|uniquestring|-hide-menu' );

        // Sub settings menu item.
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'settingsMenuItemAction', 'NULL', [
            'menu_title' => 'Settings Item',
            'page_title' => 'Title of settings page'
        ], '|uniquestring|-settings-menu-item', true );
    }

}

/**
 * Initialization.
 */
$adminClassInstance = new |UNIQUESTRING|AdminMain();

/**
 * Include classes.
 */
$adminClassInstance->additionalClasses();

/**
 * Include models.
 */
$adminClassInstance->modelsCollection();

/**
 * AJAX requests registration.
 */
$adminClassInstance->registrationAjaxActions();

/**
 * Include controllers.
 */
$adminClassInstance->routesCollection();
