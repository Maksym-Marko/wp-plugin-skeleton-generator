<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class |UNIQUESTRING|_Custom_Table extends WP_List_Table
{

	/*
	* |UNIQUESTRING|_Custom_Table
	*/

    public function __construct( $args = array() ) {

		parent::__construct(
			array(
				'singular' => 'product',
				'plural' => 'products',
			)
		);

    }	

	public function get_columns() {
		return [
			'cb'            => '<input type="checkbox" />',
			'id'         	=> __( 'ID', '|uniquestring|-domain' ),
			'title'         => __( 'Title', '|uniquestring|-domain' ),
			'description' 	=> __( 'Description', '|uniquestring|-domain' ),
			'status' 		=> __( 'Status', '|uniquestring|-domain' ),
		];
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
			$search = "AND title LIKE '%" . esc_sql( $wpdb->esc_like( wc_clean( wp_unslash( $_REQUEST['s'] ) ) ) ) . "%' ";
		}
		
		// get data
		$table = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

		$items = $wpdb->get_results(
			"SELECT * FROM {$table} WHERE 1 = 1 {$search}" .
			$wpdb->prepare( "ORDER BY {$orderby} {$order} LIMIT %d OFFSET %d;", $per_page, $offset ),
			ARRAY_A
		);

		$count = $wpdb->get_var( "SELECT COUNT(id) FROM {$table} WHERE 1 = 1 {$search};" );

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
			array(
				'total_items' => $count,
				'per_page'    => $per_page,
				'total_pages' => ceil( $count / $per_page ),
			)
		);
	}

	public function get_hidden_columns() {

		return [
			'status'
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

		do_action( "manage_{$this->screen->id}_custom_column", $column_name, $item );

	}

	public function column_cb( $item ) {
		echo sprintf( '<input type="checkbox" name="$item[]" value="%1$s" />', $item['id'] );
	}

	public function column_id( $item ) {

		echo $item['id'];

	}

	public function column_title( $item ) {

		$url     = admin_url( 'admin.php?page=single_table_item' );

		$user_id = get_current_user_id();

		$can_edit = current_user_can( 'edit_user', $user_id );

		$output = '<strong>';

		if ( $can_edit ) {

			$output .= '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . $item['title'] . '</a>';

			$actions['edit']  = '<a href="' . esc_url( $url ) . '&edit-item=' . $item['id'] . '">' . __( 'Edit', '|uniquestring|-domain' ) . '</a>';
			$actions['trash'] = '<a class="submitdelete" aria-label="' . esc_attr__( 'Trash', '|uniquestring|-domain' ) . '" href="' . esc_url(
				wp_nonce_url(
					add_query_arg(
						array(
							'trash' => $item['id'],
						),
						$url
					),
					'trash',
					'|uniquestring|_nonce'
				)
			) . '">' . esc_html__( 'Trash', '|uniquestring|-domain' ) . '</a>';
	
			$row_actions = array();
	
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

    public function ajax_user_can() {
		return current_user_can( 'edit_posts' );
	}

	protected function get_bulk_actions() {
		// if ( ! current_user_can( 'remove_users' ) ) {
		// 	return array();
		// }

		return [
			'delete' => __( 'Move to trash', '|uniquestring|-domain' ),
		];

	}

	public function search_box( $text, $input_id ) {
		if ( empty( $_REQUEST['s'] ) && ! $this->has_items() ) {
			return;
		}

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
		}
		if ( ! empty( $_REQUEST['order'] ) ) {
			echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
		}
		if ( ! empty( $_REQUEST['post_mime_type'] ) ) {
			echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
		}
		if ( ! empty( $_REQUEST['detached'] ) ) {
			echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
		}

		?>
			<p class="search-box">
				<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo $text; ?>:</label>
				<input type="search" id="<?php echo esc_attr( $input_id ); ?>" name="s" value="<?php _admin_search_query(); ?>" />
					<?php submit_button( $text, '', '', false, array( 'id' => '|uniquestring|-search-submit' ) ); ?>
			</p>
		<?php
	}

}

function  |uniquestring|_table_layout() {

	$table_instance = new |UNIQUESTRING|_Custom_Table();
	
	$table_instance->prepare_items();

	// $table_instance->views();

	echo '<form id="|uniquestring|_custom_talbe_search_form" method="post">';
		$table_instance->search_box( 'Search Items', '|uniquestring|_custom_talbe_search_input' );
	echo '</form>';

	$table_instance->display();

}