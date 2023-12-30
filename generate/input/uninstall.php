<?php

/**
 * Uninstall.
 * 
 * This file runs when somebody uninstalls
 * the plugin. Here you can remove options
 * or posts if you want.
 * 
 */
if (!defined('WP_UNINSTALL_PLUGIN')) die();

global $wpdb;

// Table name.
$table_names   = [];

$table_names[] = $wpdb->prefix . '|uniquestring|_table_slug';

// Drop table(s).
foreach ($table_names as $table_name) {

    $sql = 'DROP TABLE IF EXISTS ' . $table_name . ';';

    $wpdb->query($sql);
}

// Delete CPTs.
$posts = get_posts(['post_type' => '|uniquestring|_book', 'numberposts' => -1]);

foreach ($posts as $post) {
    wp_delete_post($post->ID, true);
}

//delete_option( 'some_option' );
