<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// uninstall
if ( __FILE__ != WP_UNINSTALL_PLUGIN ) return;
           
global $wpdb;

// table name
$table_names = array();

$table_names[] = $wpdb->prefix . '|table_slug|';

// drop table(s);
foreach( $table_names as $table_name ){

    $sql = 'DROP TABLE IF EXISTS ' . $table_name . ';';

    $wpdb->query($sql);

}

//delete_option( 'some_option' );