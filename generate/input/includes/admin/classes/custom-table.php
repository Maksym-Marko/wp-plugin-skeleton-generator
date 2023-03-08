<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class |UNIQUESTRING|_Custom_Table extends WP_List_Table
{

	/*
	* |UNIQUESTRING|_Custom_Table
	*/

    public function __construct( $args = [] ) {

		parent::__construct(
			[
				'singular' => '|uniquestring|_singular',
				'plural' => '|uniquestring|_plural',
			]
		);

	}

	public function prepare_items() {

		global $wpdb;

		// pagination
		$per_page     = 20;
		$current_page = $this->get_pagenum();

		if ( 1 < $current_page ) {
			$offset = $per_page * ( $current_page - 1 );
		} else {
			$offset = 0;
		}

		// sortable
		$order 		= isset( $_GET['order'] ) ? trim( sanitize_text_field( $_GET['order'] ) ) : 'desc';
		$orderby  	= isset( $_GET['orderby'] ) ? trim( sanitize_text_field( $_GET['orderby'] ) ) : 'id';

		// search
		$search = '';

		if ( ! empty( $_REQUEST['s'] ) ) {
			$search = "AND title LIKE '%" . esc_sql( $wpdb->esc_like( sanitize_text_field( wp_unslash( $_REQUEST['s'] ) ) ) ) . "%' ";
		}

		// status
		$item_status = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
		$status = "AND status = '$item_status'";
		
		// get data
		$table = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$items = $wpdb->get_results(
			"SELECT * FROM {$table} WHERE 1 = 1 {$status} {$search}" .
			$wpdb->prepare( "ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d;", $per_page, $offset ),
			ARRAY_A
		);

		$count = $wpdb->get_var( "SELECT COUNT(id) FROM {$table} WHERE 1 = 1 {$status} {$search};" );

		// set data
		$this->items = $items;

		// set comumn headers
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
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
				'per_page'    => $per_page,
				'total_pages' => ceil( $count / $per_page ),
			]
		);

	}

	public function get_columns() {

		return [
			'cb'            => '<input type="checkbox" />',
			'id'         	=> __( 'ID', '|uniquestring|-domain' ),
			'title'         => __( 'Title', '|uniquestring|-domain' ),
			'description' 	=> __( 'Description', '|uniquestring|-domain' ),
			'status' 		=> __( 'Status', '|uniquestring|-domain' ),
			'created_at' 	=> __( 'Created', '|uniquestring|-domain' ),
		];
		
	}	

	public function get_hidden_columns() {

		return [
			'id',
			'status',
		];

	}

	public function get_sortable_columns() {

		return [
			'title' => [
				'title',
				false
			]
		];
		
	}

	public function column_default( $item, $column_name ) {

		do_action( "manage_|uniquestring|_items_custom_column", $column_name, $item );

	}

	public function column_cb( $item ) {
		
		echo sprintf( '<input type="checkbox" class="|uniquestring|_bulk_input" name="|uniquestring|-action-%1$s" value="%1$s" />', $item['id'] );
	
	}

	public function column_id( $item ) {

		echo $item['id'];

	}

	public function column_title( $item ) {

		$url     = admin_url( 'admin.php?page=' . |UNIQUESTRING|_SINGLE_TABLE_ITEM_MENU );

		$user_id = get_current_user_id();

		$can_edit = current_user_can( 'edit_user', $user_id );

		$output = '<strong>';

		if ( $can_edit ) {

			$output .= '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . $item['title'] . '</a>';

			$actions['edit']  = '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . __( 'Edit', '|uniquestring|-domain' ) . '</a>';
			$actions['trash'] = '<a class="submitdelete" aria-label="' . esc_attr__( 'Trash', '|uniquestring|-domain' ) . '" href="' . esc_url(
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
			) . '">' . esc_html__( 'Trash', '|uniquestring|-domain' ) . '</a>';

			$item_status = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';

			if( $item_status == 'trash' ) {

				unset( $actions['edit'] );
				unset( $actions['trash'] );

				$actions['restore'] = '<a aria-label="' . esc_attr__( 'Restore', '|uniquestring|-domain' ) . '" href="' . esc_url(
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
				) . '">' . esc_html__( 'Restore', '|uniquestring|-domain' ) . '</a>';

				$actions['delete'] = '<a class="submitdelete" aria-label="' . esc_attr__( 'Delete Permanently', '|uniquestring|-domain' ) . '" href="' . esc_url(
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
				) . '">' . esc_html__( 'Delete Permanently', '|uniquestring|-domain' ) . '</a>';

			}
	
			$row_actions = [];
	
			foreach ( $actions as $action => $link ) {

				$row_actions[] = '<span class="' . esc_attr( $action ) . '">' . $link . '</span>';
			
			}
	
			$output .= '<div class="row-actions">' . implode( ' | ', $row_actions ) . '</div>';
				
		} else {

			$output .= $item['title'];

		}

		$output .= '</strong>';

		echo $output;

	}

	public function column_description( $item ) {

		$length = 30;

		echo strlen( $item['description'] ) <= $length ? $item['description'] : substr( $item['description'], 0, $length ) . '...';

	}

	public function column_created_at( $item ) {

		echo $item['created_at'];

	}

	protected function get_bulk_actions() {

		if ( ! current_user_can( 'edit_posts' ) ) {
			return [];
		}

		$item_status = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';

		$action = [
			'trash' => __( 'Move to trash', '|uniquestring|-domain' ),
		];

		if( $item_status == 'trash' ) {

			unset( $action['trash'] );

			$action['restore'] 	= __( 'Restore Item', '|uniquestring|-domain' );
			$action['delete'] 	= __( 'Delete Permanently', '|uniquestring|-domain' );

		}

		return $action;

	}

	public function search_box( $text, $input_id ) {

		if ( empty( $_REQUEST['s'] ) && ! $this->has_items() ) {
			return;
		}

		?>
			<p class="search-box">
				<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo $text; ?>:</label>
				<input type="search" id="<?php echo esc_attr( $input_id ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
					<?php submit_button( $text, '', '', false, ['id' => '|uniquestring|-search-submit'] ); ?>
			</p>
		<?php

	}

	protected function get_views() {

		global $wpdb;
		$table = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$item_status = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
		$publish_number = $wpdb->get_var( "SELECT COUNT(id) FROM {$table} WHERE status='publish';" );
		$trash_number = $wpdb->get_var( "SELECT COUNT(id) FROM {$table} WHERE status='trash';" );
		$url = admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG );

		$status_links = [];

		// publish
		$status_links['publish'] = [
			'url'     => add_query_arg( 'item_status', 'publish', $url ),
			'label'   => sprintf(
				_nx(
					'Publish <span class="count">(%s)</span>',
					'Publish <span class="count">(%s)</span>',
					$publish_number,
					'publish'
				),
				number_format_i18n( $publish_number )
			),
			'current' => 'publish' == $item_status,
		];

		if ( $publish_number == 0 ) {
			unset( $status_links['publish'] );
		}

		// trash
		$status_links['trash'] = [
			'url'     => add_query_arg( 'item_status', 'trash', $url ),
			'label'   => sprintf(
				_nx(
					'Trash <span class="count">(%s)</span>',
					'Trash <span class="count">(%s)</span>',
					$trash_number,
					'trash'
				),
				number_format_i18n( $trash_number )
			),
			'current' => 'trash' == $item_status,
		];

		if ( $trash_number == 0 ) {
			unset( $status_links['trash'] );
		}

		return $this->get_views_links( $status_links );

	}

	public function no_items() {

		$item_status = isset( $_GET['item_status'] ) ? trim( $_GET['item_status'] ) : 'publish';
		
		if( $item_status == 'trash' ) {

			_e( 'No items found in trash.' );

		} else {

			_e( 'No items found.' );

		}		

	}

}

function  |uniquestring|_table_layout() {

	global $wpdb;

	$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

	$is_table = $wpdb->get_var(

		$wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table_name ) )

	);

	if( ! $is_table ) return;

	?>
		<h1 class="wp-heading-inline"><?php _e( 'Custom Table Items', '|uniquestring|-domain' ); ?></h1>
		<a href="<?php echo admin_url( 'admin.php?page=' . |UNIQUESTRING|_CREATE_TABLE_ITEM_MENU ); ?>" class="page-title-action">Add New</a>
		<hr class="wp-header-end">
	<?php

	$table_instance = new |UNIQUESTRING|_Custom_Table();
	
	$table_instance->prepare_items();

	$table_instance->views();

	echo '<form id="|uniquestring|_custom_talbe_search_form" method="post">';
		$table_instance->search_box( 'Search Items', '|uniquestring|_custom_talbe_search_input' );
	echo '</form>';

	echo '<form id="|uniquestring|_custom_talbe_form" method="post">';
		$table_instance->display();
	echo '</form>';

}