<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!function_exists('|uniquestring|RequireClassFileAdmin')) {
    /**
     * Require class for admin panel.
     * 
     * @param string $file   File name in /includes/admin/classes/ folder.
     *
     * @return void
     */
    function |uniquestring|RequireClassFileAdmin( $file ) {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/classes/' . $file;
    }
}

if (!function_exists('|uniquestring|RequireClassFileFrontend')) {
    /**
     * Require class for frontend part.
     * 
     * @param string $file   File name in /includes/frontend/classes/ folder.
     *
     * @return void
     */
    function |uniquestring|RequireClassFileFrontend( $file ) {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/classes/' . $file;
    }
}

if (!function_exists('|uniquestring|UseModel')) {
    /**
     * Require a Model.
     * 
     * @param string $model   File name in /includes/admin/models/ folder without ".php".
     *
     * @return void
     */
    function |uniquestring|UseModel( $model ) {

        require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';
    }
}

/*
* Debugging
*/
if (!function_exists('|uniquestring|DebugToFile')) {
    /**
     * Debug anything. The result will be collected 
     * in /mx-debug/mx-debug.txt file in the root of
     * the plugin.
     * 
     * @param string $content   List of parameters (coma separated).
     *
     * @return void
     */
    function |uniquestring|DebugToFile( ...$content ) {

        $content = |uniquestring|ContentToString( ...$content );

        $dir = |UNIQUESTRING|_PLUGIN_ABS_PATH . 'mx-debug';

        $file = $dir . '/mx-debug.txt';

        if (!file_exists($dir)) {

            mkdir($dir, 0777, true);

            $current = '>>>' . date('Y/m/d H:i:s', time()) . ':' . "\n";

            $current .= $content . "\n";

            $current .= '_____________________________________' . "\n";

            file_put_contents($file, $current);
        } else {

            $current = '>>>' . date('Y/m/d H:i:s', time()) . ':' . "\n";

            $current .= $content . "\n";
            
            $current .= '_____________________________________' . "\n";          

            $current .= file_get_contents($file) . "\n";

            file_put_contents($file, $current);
        }
    }
}

if (!function_exists('|uniquestring|ContentToString')) {
    /**
     * This function is helpers for the
     * |uniquestring|DebugToFile function.
     * 
     * @param string $content   List of parameters (coma separated).
     *
     * @return string
     */
    function |uniquestring|ContentToString( ...$content ) {

        ob_start();

        var_dump( ...$content );

        return ob_get_clean();
    }
}

if (!function_exists('|uniquestring|InsertNewColumnToPosition')) {
    /**
     * Manage posts columns. Add column to a position.
     * 
     * @param array $columns     Existing columns returned by 
     * "manage_{$post_type}_posts_columns" filter.
     * 
     * @param int $position      Position of new columns.
     * @param array $newColumn   List of new columns.
     * Eg. [
     *  'book_id'     => 'Book ID',
     *  'book_author' => 'Book Author'
     * ]
     *
     * @return string
     */
    function |uniquestring|InsertNewColumnToPosition( array $columns, int $position, array $newColumn ) {

        $chunkedArray = array_chunk( $columns, $position, true );

        $result = array_merge( $chunkedArray[0], $newColumn, $chunkedArray[1] );

        return $result;
    }
}

if (!function_exists('|uniquestring|AdminRedirect')) {
    /**
     * Redirect from admin panel.
     * 
     * @param string $url   An url where you want to redirect to.
     *
     * @return void
     */
    function |uniquestring|AdminRedirect( $url ) {

        if (!$url) return;

        add_action( 'admin_footer', function() use ( $url ) {
            printf("<script>window.location.href = '%s';</script>", esc_url_raw($url));
        } );
    }
}
