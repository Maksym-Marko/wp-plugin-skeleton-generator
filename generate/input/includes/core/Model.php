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
    public function getRow( $table = NULL, $wherName = NULL, $wherValue = NULL, $and = '' )
    {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $this->wpdb->prefix . $table;

        }

        $where = '';

        if ($wherName !== NULL && $wherValue !== NULL) {

            $where = "WHERE $wherName = $wherValue";

        }

        $getRow = $this->wpdb->get_row( "SELECT $this->fields FROM $tableName {$where} {$and}" );

        return $getRow;
        
    }

    /**
    * get results from the database
    */
    public function getResults( $table = NULL, $wherName = NULL, $wherValue = 1, $and = '', $order = 'ORDER BY id DESC', $mask = '%d' )
    {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $table;

        }

        if ($wherName !== NULL) {

            $results = $this->wpdb->get_results( 

                $this->wpdb->prepare(

                    "SELECT $this->fields
                        FROM $tableName
                        WHERE $wherName=$mask {$and}
                        {$order}",
                    $wherValue

                )

            );

        } else {

            $results = $this->wpdb->get_results( "SELECT $this->fields FROM $tableName" );

        }        

        return $results;
        
    }

    /**
    * update row
    */
    public function updateRow( $table = NULL, $wherName = NULL, $wherValue = NULL, $columns = [], $masks = [] ){

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $this->wpdb->prefix . $table;

        }

        if($wherName == NULL || $wherValue == NULL) return false;

        $update = $this->wpdb->update(

            $tableName,
            $columns,
            [
                $wherName => $wherValue
            ],
            $masks

        );

        return $update;

    }

    /**
    * insert row
    */
    public function insertRow( $table = NULL, $columns = [], $masks = [] ) {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $this->wpdb->prefix . $table;

        }

        $insert = $this->wpdb->insert(

            $tableName,

            $columns,

            $masks

        );

        return $insert;

    }

    /**
     * get var
     */
    public function getVar($table = NULL, $countBy = 'id', $and = null)
    {

        $tableName = $this->wpdb->prefix . $this->table;

        if ($table !== NULL) {

            $tableName = $this->wpdb->prefix . $table;
        }

        $count = $this->wpdb->get_var( "SELECT COUNT($countBy) FROM {$tableName} WHERE 1=1 {$and}");

        return $count;

    }

}
