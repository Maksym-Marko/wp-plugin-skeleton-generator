<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/*
* Model class
*/
class |UNIQUESTRING|Model
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
    public function getRow( $table = NULL, $wherName = NULL, $wherValue = NULL )
    {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $table;

        }

        $where = '';

        if ($wherName !== NULL && $wherValue !== NULL) {

            $where = "WHERE $wherName = $wherValue";

        }

        $getRow = $this->wpdb->get_row( "SELECT $this->fields FROM $tableName {$where}" );

        return $getRow;
        
    }

    /**
    * get results from the database
    */
    public function getResults( $table = false, $wherName = NULL, $wherValue = 1 )
    {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== false) {

            $tableName = $table;

        }

        if ($wherName !== NULL) {

            $results = $this->wpdb->get_results( "SELECT $this->fields FROM $tableName WHERE $wherName = $wherValue" );

        } else {

            $results = $this->wpdb->get_results( "SELECT $this->fields FROM $tableName" );

        }        

        return $results;
        
    }

}
