<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!class_exists('WP_List_Table')) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class |UNIQUESTRING|CustomTable extends WP_List_Table
{

    /*
    * |UNIQUESTRING|CustomTable
    */

    public function __construct( $args = [] )
    {

        parent::__construct(
            [
                'singular' => '|uniquestring|_singular',
                'plural'   => '|uniquestring|_plural',
            ]
        );

    }

    public function prepare_items()
    {

        global $wpdb;

        // pagination
        $perPage     = 20;
        $currentPage = $this->get_pagenum();

        if (1 < $currentPage) {
            $offset = $perPage * ( $currentPage - 1 );
        } else {
            $offset = 0;
        }

        // sortable
        $order = isset( $_GET['order'] ) ? trim( sanitize_text_field( $_GET['order'] ) ) : 'desc';
        $orderBy = isset( $_GET['orderby'] ) ? trim( sanitize_text_field( $_GET['orderby'] ) ) : 'id';

        // search
        $search = '';

        if (!empty($_REQUEST['s'])) {
            $search = "AND title LIKE '%" . esc_sql( $wpdb->esc_like( sanitize_text_field( wp_unslash( $_REQUEST['s'] ) ) ) ) . "%' ";
        }

        // status
        $itemStatus = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
        $status = "AND status = '$itemStatus'";
        
        // get data
        $tableName = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

        $items = $wpdb->get_results(
            "SELECT * FROM {$tableName} WHERE 1 = 1 {$status} {$search}" .
            $wpdb->prepare( "ORDER BY {$orderBy} {$order} LIMIT %d OFFSET %d;", $perPage, $offset ),
            ARRAY_A
        );

        $count = $wpdb->get_var( "SELECT COUNT(id) FROM {$tableName} WHERE 1 = 1 {$status} {$search};" );

        // set data
        $this->items = $items;

        // set comumn headers
        $columns  = $this->get_columns();
        $hidden   = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [
            $columns,
            $hidden,
            $sortable,
        ];

        // Set the pagination.
        $this->set_pagination_args(
            [
                'total_items' => $count,
                'per_page'    => $perPage,
                'total_pages' => ceil( $count / $perPage ),
            ]
        );

    }

    public function get_columns()
    {

        return [
            'cb'          => '<input type="checkbox" />',
            'id'          => __( 'ID', 'mx-|uniquestring|' ),
            'title'       => __( 'Title', 'mx-|uniquestring|' ),
            'description' => __( 'Description', 'mx-|uniquestring|' ),
            'status'      => __( 'Status', 'mx-|uniquestring|' ),
            'created_at'  => __( 'Created', 'mx-|uniquestring|' ),
        ];
        
    }    

    public function get_hidden_columns()
    {

        return [
            'id',
            'status',
        ];

    }

    public function get_sortable_columns()
    {

        return [
            'title' => [
                'title',
                false
            ]
        ];
        
    }

    public function column_default( $item, $columnName )
    {

        do_action( "manage_|uniquestring|_items_custom_column", $columnName, $item );

    }

    public function column_cb( $item )
    {
        
        echo sprintf( '<input type="checkbox" class="|uniquestring|_bulk_input" name="|uniquestring|-action-%1$s" value="%1$s" />', $item['id'] );
    
    }

    public function column_id( $item )
    {

        echo $item['id'];

    }

    public function column_title( $item )
    {

        $url      = admin_url( 'admin.php?page=' . |UNIQUESTRING|_SINGLE_TABLE_ITEM_MENU );

        $user_id  = get_current_user_id();

        $can_edit = current_user_can( 'edit_user', $user_id );

        $output   = '<strong>';

        if ($can_edit) {

            $output .= '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . $item['title'] . '</a>';

            $actions['edit']  = '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . __( 'Edit', 'mx-|uniquestring|' ) . '</a>';
            $actions['trash'] = '<a class="submitdelete" aria-label="' . esc_attr__( 'Trash', 'mx-|uniquestring|' ) . '" href="' . esc_url(
                wp_nonce_url(
                    add_query_arg(
                        [
                            'trash' => $item['id'],
                        ],
                        $url
                    ),
                    'trash',
                    '|uniquestring|_nonce'
                )
            ) . '">' . esc_html__( 'Trash', 'mx-|uniquestring|' ) . '</a>';

            $itemStatus = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';

            if ($itemStatus == 'trash') {

                unset( $actions['edit'] );
                unset( $actions['trash'] );

                $actions['restore'] = '<a aria-label="' . esc_attr__( 'Restore', 'mx-|uniquestring|' ) . '" href="' . esc_url(
                    wp_nonce_url(
                        add_query_arg(
                            [
                                'restore' => $item['id'],
                            ],
                            $url
                        ),
                        'restore',
                        '|uniquestring|_nonce'
                    )
                ) . '">' . esc_html__( 'Restore', 'mx-|uniquestring|' ) . '</a>';

                $actions['delete'] = '<a class="submitdelete" aria-label="' . esc_attr__( 'Delete Permanently', 'mx-|uniquestring|' ) . '" href="' . esc_url(
                    wp_nonce_url(
                        add_query_arg(
                            [
                                'delete' => $item['id'],
                            ],
                            $url
                        ),
                        'delete',
                        '|uniquestring|_nonce'
                    )
                ) . '">' . esc_html__( 'Delete Permanently', 'mx-|uniquestring|' ) . '</a>';

            }
    
            $rowActions = [];
    
            foreach ($actions as $action => $link) {
                $rowActions[] = '<span class="' . esc_attr( $action ) . '">' . $link . '</span>';
            }
    
            $output .= '<div class="row-actions">' . implode( ' | ', $rowActions ) . '</div>';
                
        } else {

            $output .= $item['title'];

        }

        $output .= '</strong>';

        echo $output;

    }

    public function column_description( $item )
    {

        $length = 30;

        echo strlen( $item['description'] ) <= $length ? $item['description'] : substr( $item['description'], 0, $length ) . '...';

    }

    public function column_created_at( $item )
    {

        echo $item['created_at'];

    }

    protected function get_bulk_actions()
    {

        if (!current_user_can('edit_posts')) {
            return [];
        }

        $itemStatus = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';

        $action = [
            'trash' => __( 'Move to trash', 'mx-|uniquestring|' ),
        ];

        if ($itemStatus == 'trash') {

            unset( $action['trash'] );

            $action['restore'] = __( 'Restore Item', 'mx-|uniquestring|' );
            $action['delete']  = __( 'Delete Permanently', 'mx-|uniquestring|' );

        }

        return $action;

    }

    public function search_box( $text, $inputId )
    {

        if (empty($_REQUEST['s']) && ! $this->has_items()) {
            return;
        }

        ?>
            <p class="search-box">
                <label class="screen-reader-text" for="<?php echo esc_attr( $inputId ); ?>"><?php echo $text; ?>:</label>
                <input type="search" id="<?php echo esc_attr( $inputId ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
                    <?php submit_button( $text, '', '', false, ['id' => '|uniquestring|-search-submit'] ); ?>
            </p>
        <?php

    }

    protected function get_views()
    {

        global $wpdb;

        $tableName     = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;
        $itemStatus    = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
        $publishNumber = $wpdb->get_var( "SELECT COUNT(id) FROM {$tableName} WHERE status='publish';" );
        $trashNumber   = $wpdb->get_var( "SELECT COUNT(id) FROM {$tableName} WHERE status='trash';" );
        $url           = admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG );

        $statusLinks   = [];

        // publish
        $statusLinks['publish'] = [
            'url'     => add_query_arg( 'item_status', 'publish', $url ),
            'label'   => sprintf(
                _nx(
                    'Publish <span class="count">(%s)</span>',
                    'Publish <span class="count">(%s)</span>',
                    $publishNumber,
                    'publish'
                ),
                number_format_i18n( $publishNumber )
            ),
            'current' => 'publish' == $itemStatus,
        ];

        if ($publishNumber == 0) {
            unset( $statusLinks['publish'] );
        }

        // trash
        $statusLinks['trash'] = [
            'url'     => add_query_arg( 'item_status', 'trash', $url ),
            'label'   => sprintf(
                _nx(
                    'Trash <span class="count">(%s)</span>',
                    'Trash <span class="count">(%s)</span>',
                    $trashNumber,
                    'trash'
                ),
                number_format_i18n( $trashNumber )
            ),
            'current' => 'trash' == $itemStatus,
        ];

        if ($trashNumber == 0) {
            unset( $statusLinks['trash'] );
        }

        return $this->get_views_links( $statusLinks );

    }

    public function no_items()
    {

        $itemStatus = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
        
        if ($itemStatus == 'trash') {

            _e( 'No items found in trash.' );

        } else {

            _e( 'No items found.' );

        }

    }

}

if (!function_exists('|uniquestring|TableLayout')) {

    function |uniquestring|TableLayout() {

        global $wpdb;
    
        $tableName = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;
    
        $isTable = $wpdb->get_var(
    
            $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $tableName ) )
    
        );
    
        if (!$isTable) return;
    
        ?>
            <h1 class="wp-heading-inline"><?php _e( 'Custom Table Items', 'mx-|uniquestring|' ); ?></h1>
            <a href="<?php echo admin_url( 'admin.php?page=' . |UNIQUESTRING|_CREATE_TABLE_ITEM_MENU ); ?>" class="page-title-action">Add New</a>
            <hr class="wp-header-end">
        <?php
    
        $tableInstance = new |UNIQUESTRING|CustomTable();
        
        $tableInstance->prepare_items();
    
        $tableInstance->views();
    
        echo '<form id="|uniquestring|_custom_talbe_search_form" method="post">';
            $tableInstance->search_box( 'Search Items', '|uniquestring|_custom_talbe_search_input' );
        echo '</form>';
    
        echo '<form id="|uniquestring|_custom_talbe_form" method="post">';
            $tableInstance->display();
        echo '</form>';
    
    }

}
