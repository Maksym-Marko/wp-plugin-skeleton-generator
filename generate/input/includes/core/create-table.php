<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

class |UNIQUESTRING|CreateTable
{

    // table name
    private $table         = NULL;

    // columns
    private $columns       = [];

    // SQL query
    private $sqlContainer = NULL;

    // global $wpdb
    private $wpdb          = NULL;

    // datetime
    private $datetime      = NULL;

    function __construct($tableName = 'mx_table')
    {

        global $wpdb;

        $this->datetime = current_time('mysql');

        $this->wpdb     = $wpdb;

        $this->table    = $tableName;
    }

    // add varchar
    public function varchar($columnName = 'name', $length = 10, $notNull = false, $default = NULL)
    {

        // not null
        $notNull = $notNull ? 'NOT NULL' : 'NULL';

        // default
        $default = $default !== NULL ? 'default \'' . $default . '\'' : '';

        $sql     = "$columnName varchar($length) $notNull $default";

        array_push($this->columns, $sql);
    }

    // add longtext
    public function longtext($columnName = 'text', $notNull = false)
    {

        // not null
        $notNull = $notNull ? 'NOT NULL' : 'NULL';

        /**
         *  "default" doesn't work for old MySQL versions
         * */
        // $default = $default !== NULL ? 'default \'' . $default . '\'' : '';

        $sql     = "$columnName longtext $notNull";

        array_push($this->columns, $sql);
    }

    // add int
    public function int($columnName = 'integer')
    {

        $sql = "$columnName int(11) NOT NULL";

        array_push($this->columns, $sql);
    }

    // add datetime
    public function datetime($columnName = 'created', $default = NULL)
    {

        // default
        $default = $default == NULL ? '0000-00-00 00:00:00' : $default;

        $sql     = "$columnName datetime NOT NULL default '$default'";

        array_push($this->columns, $sql);
    }

    // we should to add some coluns to the table
    public function create_columns($id = 'id')
    {

        global $wpdb;

        $collate = '';

        if ($wpdb->has_cap('collation')) {

            $collate = $wpdb->get_charset_collate();
        }

        // get all columns
        $columns = implode(',', $this->columns);

        // create a table
        if (count($this->columns) == 0) {

            $this->sqlContainer = "CREATE TABLE IF NOT EXISTS `$this->table`
                (
                    `$id` int(11) NOT NULL AUTO_INCREMENT,
                    PRIMARY KEY (`$id`)
                ) $collate;";
        } else {

            $this->sqlContainer = "CREATE TABLE IF NOT EXISTS `$this->table`
                (
                    `$id` int(11) NOT NULL AUTO_INCREMENT,
                    $columns,
                    PRIMARY KEY (`$id`)
                ) $collate;";
        }
    }

    public function createTable()
    {

        if ($this->sqlContainer == NULL) return 0;

        // lets check if the table exists
        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . $this->table . "'") != $this->table) {

            // create a table
            $this->wpdb->query($this->sqlContainer);

            return 1;
        } else {

            return 0;
        }
    }
}
