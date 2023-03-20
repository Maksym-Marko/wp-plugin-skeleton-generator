<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|AdminMain
{

    // list of model names used in the plugin
    public $modelsCollection = [
        '|UNIQUESTRING|MainAdminModel'
    ];

    /*
    * Additional classes
    */
    public function additionalClasses()
    {

        // enqueue_scripts class
        |uniquestring|RequireClassFileAdmin( 'enqueue-scripts.php' );

        |UNIQUESTRING|EnqueueScripts::registerScripts();

        // mx metaboxes class
        |uniquestring|RequireClassFileAdmin( 'metabox.php' );

        |uniquestring|RequireClassFileAdmin( 'metabox-image-upload.php' );

        |UNIQUESTRING|MetaboxesImageUpload::registerScripts();
        
        // CPT class
        |uniquestring|RequireClassFileAdmin( 'cpt.php' );

        |UNIQUESTRING|CPTGenerator::createCPT();

        // custom table
        |uniquestring|RequireClassFileAdmin( 'custom-table.php' );

    }

    /*
    * Models Connection
    */
    public function modelsCollection()
    {

        // require model file
        foreach ( $this->modelsCollection as $model ) {
            
            |uniquestring|UseModel( $model );

        }        

    }

    /**
    * registration ajax actions
    */
    public function registrationAjaxActions()
    {

        // ajax requests to main page
        |UNIQUESTRING|MainAdminModel::wpAjax();

    }

    /*
    * Routes collection
    */
    public function routesCollection()
    {

        // main menu item
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'index', '', [
            'page_title' => 'Main Menu title',
            'menu_title' => 'Main menu'
        ] );

            // single table item
            |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'singleTableItem', 'NULL', [
                'page_title' => 'Single Table Item',
            ], |UNIQUESTRING|_SINGLE_TABLE_ITEM_MENU );

            // single table item
            |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'createTableItem', 'NULL', [
                'page_title' => 'Create Table Item',
            ], |UNIQUESTRING|_CREATE_TABLE_ITEM_MENU );

        // sub menu item
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'submenu', '', [
            'page_title' => 'Sub Menu title',
            'menu_title' => 'Sub menu'
        ], 'sub_menu' );

        // hide menu item
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'hidemenu', 'NULL', [
            'page_title' => 'Hidden Menu title',
        ], 'hide_menu' );

        // sub settings menu item
        |UNIQUESTRING|Route::get( '|UNIQUESTRING|MainAdminController', 'settingsMenuItemAction', 'NULL', [
            'menu_title' => 'Settings Item',
            'page_title' => 'Title of settings page'
        ], 'settings_menu_item', true );

    }

}

// Initialize
$adminClassInstance = new |UNIQUESTRING|AdminMain();

// include classes
$adminClassInstance->additionalClasses();

// include models
$adminClassInstance->modelsCollection();

// ajax requests
$adminClassInstance->registrationAjaxActions();

// include controllers
$adminClassInstance->routesCollection();