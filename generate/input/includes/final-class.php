<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

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
        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/core/Helpers.php';

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
