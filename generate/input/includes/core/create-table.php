<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|CreateTable
{

	// table name
	private $table 		= NULL;

	// columns
	private $columns 	= [];
 
	// SQL query
	private $_sql 		= NULL;

	// global $wpdb
	private $wpdb 		= NULL;

	// datetime
	private $datetime 	= NULL;

	function __construct( $table_name = 'mx_table' )
	{

		global $wpdb;

		$this->datetime = current_time('mysql');

		$this->wpdb = $wpdb; 

		$this->table = $table_name;

	}

	// add varchar
	public function varchar( $column_name = 'name', $length = 10, $not_null = false, $default = NULL )
	{

		// not null
		$not_null = $not_null ? 'NOT NULL' : 'NULL';

		// default
		$default = $default !== NULL ? 'default \'' . $default .'\'' : '';

		$sql = "$column_name varchar($length) $not_null $default";

		array_push( $this->columns, $sql );

	}

	// add longtext
	public function longtext( $column_name = 'text', $not_null = false )
	{

		// not null
		$not_null = $not_null ? 'NOT NULL' : 'NULL';

		$sql = "$column_name longtext $not_null";

		array_push( $this->columns, $sql );

	}

	// add int
	public function int( $column_name = 'integer' )
	{

		$sql = "$column_name int(11) NOT NULL";

		array_push( $this->columns, $sql );

	}

	// add datetime
	public function datetime( $column_name = 'created', $default = NULL )
	{

		// default
		$default = $default == NULL ? current_time('mysql') : $default;

		$sql = "$column_name datetime NOT NULL default '$default'";

		array_push( $this->columns, $sql );

	}

	// we should to add some coluns to the table
	public function create_columns( $id = 'id' )
	{

		global $wpdb;

		$collate = '';

		if ( $wpdb->has_cap( 'collation' ) ) {

			$collate = $wpdb->get_charset_collate();

		}

		// get all columns
		$columns = implode( ',', $this->columns );

		// create a table
		if( count( $this->columns ) == 0 ) {

			$this->_sql = "CREATE TABLE IF NOT EXISTS `$this->table`
				(
					`$id` int(11) NOT NULL AUTO_INCREMENT,
					PRIMARY KEY (`$id`)
				) $collate;";

		} else {

			$this->_sql = "CREATE TABLE IF NOT EXISTS `$this->table`
				(
					`$id` int(11) NOT NULL AUTO_INCREMENT,
					$columns,
					PRIMARY KEY (`$id`)
				) $collate;";

		}
		

	}

	public function create_table()
	{

		if( $this->_sql == NULL ) return 0;

		// lets check if the table exists
		if ( $this->wpdb->get_var( "SHOW TABLES LIKE '" . $this->table . "'" ) !=  $this->table ) {

			// create a table
			$this->wpdb->query( $this->_sql );

			return 1;

		} else {

			return 0;

		}

	}
}