<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|MainAdminController class.
 *
 * Here you can connect your model with a view.
 */
class |UNIQUESTRING|MainAdminController extends |UNIQUESTRING|Controller
{

    protected $modelInstance;

    public function __construct()
    {

        $this->modelInstance = new |UNIQUESTRING|MainAdminModel();
    }
    
    public function index()
    {

        return new |UNIQUESTRING|MxView( 'main-page' );
    }

    public function submenu()
    {

        return new |UNIQUESTRING|MxView( 'sub-page' );
    }

    public function hidemenu()
    {

        return new |UNIQUESTRING|MxView( 'hidemenu-page' );
    }

    public function settingsMenuItemAction()
    {

        return new |UNIQUESTRING|MxView( 'settings-page' );
    }

    public function singleTableItem()
    {

        // Delete action.
        $deleteId = isset( $_GET['delete'] ) ? trim( sanitize_text_field( $_GET['delete'] ) ) : false;
        
        if ($deleteId) {

            if (isset($_GET['|uniquestring|_nonce']) || wp_verify_nonce($_GET['|uniquestring|_nonce'], 'delete')) {

                $this->modelInstance->deletePermanently( $deleteId );
            }

            |uniquestring|AdminRedirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG . '&item_status=trash' ) );

            return;
        }

        // Restore action.
        $restore_id = isset( $_GET['restore'] ) ? trim( sanitize_text_field( $_GET['restore'] ) ) : false;
        
        if ($restore_id) {

            if (isset( $_GET['|uniquestring|_nonce']) || wp_verify_nonce($_GET['|uniquestring|_nonce'], 'restore')) {

                $this->modelInstance->restoreItem( $restore_id );

            }

            |uniquestring|AdminRedirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG . '&item_status=trash' ) );

            return;
        }

        // Trash action.
        $trash_id = isset( $_GET['trash'] ) ? trim( sanitize_text_field( $_GET['trash'] ) ) : false;

        if ($trash_id) {

            if (isset($_GET['|uniquestring|_nonce']) || wp_verify_nonce($_GET['|uniquestring|_nonce'], 'trash')) {

                $this->modelInstance->moveToTrash( $trash_id );

            }

            |uniquestring|AdminRedirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ) );

            return;

        }

        // Edit action.
        $item_id = isset( $_GET['edit-item'] ) ? trim( sanitize_text_field( $_GET['edit-item'] ) ) : 0;
        
        $data = $this->modelInstance->getRow( NULL, 'id', intval( $item_id ) );

        if ($data == NULL) {
            if (!isset( $_SERVER['HTTP_REFERER'] ) || $_SERVER['HTTP_REFERER'] == NULL) {
                |uniquestring|AdminRedirect( admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ) );
            } else {
                |uniquestring|AdminRedirect( $_SERVER['HTTP_REFERER'] );
            }
            
            return;
        }
        
        return new |UNIQUESTRING|MxView( 'single-table-item', $data );
    }        

    // Create a table item.
    public function createTableItem() {

        return new |UNIQUESTRING|MxView( 'create-table-item' );
    }

}
