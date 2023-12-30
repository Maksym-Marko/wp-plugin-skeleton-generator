<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|CreateTable class.
 *
 * Custom table creation. 
 */
class |UNIQUESTRING|CreateTable
{

    // Table name.
    private $table         = NULL;

    // Columns.
    private $columns       = [];

    // SQL query.
    private $sqlContainer = NULL;

    // Global $wpdb.
    private $wpdb          = NULL;

    // Datetime.
    private $datetime      = NULL;

    function __construct($tableName = 'mx_table')
    {

        global $wpdb;

        $this->datetime = '0000-00-00 00:00:00';

        $this->wpdb     = $wpdb;

        $this->table    = $tableName;
    }

    // Add varchar.
    public function varchar($columnName = 'name', $length = 10, $notNull = false, $default = NULL)
    {

        $notNull = $notNull ? 'NOT NULL' : 'NULL';

        $default = $default !== NULL ? 'default \'' . $default . '\'' : '';

        $sql     = "$columnName varchar($length) $notNull $default";

        array_push($this->columns, $sql);
    }

    // Add longtext.
    public function longtext($columnName = 'text', $notNull = false)
    {

        $notNull = $notNull ? 'NOT NULL' : 'NULL';

        /**
         * "default" doesn't work for old MySQL versions.
         * */
        // $default = $default !== NULL ? 'default \'' . $default . '\'' : '';

        $sql     = "$columnName longtext $notNull";

        array_push($this->columns, $sql);
    }

    // Add int.
    public function int($columnName = 'integer')
    {

        $sql = "$columnName int(11) NOT NULL";

        array_push($this->columns, $sql);
    }

    // Add datetime.
    public function datetime($columnName = 'created', $default = NULL)
    {

        $default = $default == NULL ? $this->datetime : $default;

        $sql     = "$columnName datetime NOT NULL default '$default'";

        array_push($this->columns, $sql);
    }

    // We should add some columns to the table.
    public function create_columns($id = 'id')
    {

        global $wpdb;

        $collate = '';

        if ($wpdb->has_cap('collation')) {

            $collate = $wpdb->get_charset_collate();
        }

        // Get all columns.
        $columns = implode(',', $this->columns);

        // Create a table.
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

        // Lets check if the table exists.
        if ($this->wpdb->get_var("SHOW TABLES LIKE '" . $this->table . "'") != $this->table) {

            // Create a table.
            $this->wpdb->query($this->sqlContainer);

            return 1;
        } else {

            return 0;
        }
    }
}
