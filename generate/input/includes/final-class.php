<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UniqueClassName|WPPGenerator class.
 *
 * This is a final class of the plugin.
 * Here you can find/add/remove components
 * of the plugin.
 */
final class |UniqueClassName|WPPGenerator
{

    /**
     * Require necessary files.
     * 
     * @return void
     */
    public function includeCore()
    {        

        // Helpers.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/helpers.php';

        // Catching errors.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Catching-Errors.php';

        // Route.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Route.php';

        // Models.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Model.php';

        // Views.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/View.php';

        // Controllers.
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Controller.php';
    }

    /**
     * Include Global Features.
     * 
     * @return void
     */
    public function includeGlobalFeatures()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/global/index.php';
    }

    /**
     * Include Admin Panel Features.
     * 
     * @return void
     */
    public function includeAdminPanel()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/admin-main.php';
    }

    /**
     * Include Frontend Features.
     * 
     * @return void
     */
    public function includeFrontendPath()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/frontend-main.php';
    }

    /**
     * Include Gutenberg Features.
     * 
     * @return void
     */
    public function includeGutenbergPath()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/gutenberg/gutenberg-main.php';
    }

    /**
     * REST API.
     * 
     * @return void
     */
    public function includeRestApi()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'rest-api/index.php';
    }

    /**
     * Vue SPA Feature.
     * 
     * @return void
     */
    public function includeVueSPAFeature()
    {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'vue-spa/wp/index.php';
    }

}

/**
 * The Final class instance.
 */
$wppGenerator = new |UniqueClassName|WPPGenerator();

/**
 * The core files (helpers, models, controllers ...).
 */
$wppGenerator->includeCore();

/**
 * Include global features.
 */
$wppGenerator->includeGlobalFeatures();

/**
 * Turn on the admin panel features.
 */
$wppGenerator->includeAdminPanel();

/**
 * Turn on the frontend features.
 */
$wppGenerator->includeFrontendPath();

/**
 * Turn on the gutenberg features.
 */
$wppGenerator->includeGutenbergPath();

/**
 * Turn on REST API.
 */
$wppGenerator->includeRestApi();

/**
 * Turn on the Vue SPA feature.
 * Please turn on JS in this file 
 * \includes\frontend\classes\enqueue-scripts.php
 */
// $wppGenerator->includeVueSPAFeature();
