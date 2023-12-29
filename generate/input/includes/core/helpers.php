<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/*
* Require class for admin panel
*/
function |uniquestring|RequireClassFileAdmin( $file ) {

    require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/classes/' . $file;

}


/*
* Require class for frontend panel
*/
function |uniquestring|RequireClassFileFrontend( $file ) {

    require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/frontend/classes/' . $file;

}

/*
* Require a Model
*/
function |uniquestring|UseModel( $model ) {

    require_once |UNIQUESTRING|_PLUGIN_ABS_PATH . 'includes/admin/models/' . $model . '.php';

}

/*
* Debugging
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
    // pretty debug text to the file
    function |uniquestring|ContentToString( ...$content ) {

        ob_start();

        var_dump( ...$content );

        return ob_get_clean();

    }

/*
* Manage posts columns. Add column to position
*/
function |uniquestring|InsertNewColumnToPosition( array $columns, int $position, array $newColumn ) {

    $chunkedArray = array_chunk( $columns, $position, true );

    $result = array_merge( $chunkedArray[0], $newColumn, $chunkedArray[1] );

    return $result;

}

/*
* Redirect from admin panel
*/
function |uniquestring|AdminRedirect( $url ) {

    if (!$url) return;

    add_action( 'admin_footer', function() use ( $url ) {
        printf("<script>window.location.href = '%s';</script>", esc_url_raw($url));
    } );

}
