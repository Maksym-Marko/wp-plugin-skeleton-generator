<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Model class
*/
class |UNIQUESTRING|_Model
{

	private $wpdb;

	/**
	* Table name
	*/
	protected $table = |UNIQUESTRING|_TABLE_SLUG;

	/**
	* fields
	*/
	protected $fields = '*';

	/*
	* Model constructor
	*/
	public function __construct()
	{
		
		global $wpdb;

    	$this->wpdb = $wpdb;    	

	}	

	/**
	* select row from the database
	*/
	public function |uniquestring|_get_row( $table = NULL, $wher_name, $wher_value )
	{

		$table_name = $this->wpdb->prefix . $this->table;

		if( $table !== NULL ) {

			$table_name = $table;

		}

		$get_row = $this->wpdb->get_row( "SELECT $this->fields FROM $table_name WHERE $wher_name = $wher_value" );

		return $get_row;
		
	}

	/**
	* get results from the database
	*/
	public function |uniquestring|_get_results( $table = false, $wher_name = NULL, $wher_value = 1 )
	{

		$table_name = $this->wpdb->prefix . $this->table;

		if( $table !== false ) {

			$table_name = $table;

		}

		if( $wher_name !== NULL ) {

			$results = $this->wpdb->get_results( "SELECT $this->fields FROM $table_name WHERE $wher_name = $wher_value" );

		} else {

			$results = $this->wpdb->get_results( "SELECT $this->fields FROM $table_name" );

		}		

		return $results;
		
	}

}