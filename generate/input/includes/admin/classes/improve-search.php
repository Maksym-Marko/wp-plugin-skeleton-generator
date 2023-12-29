<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!function_exists('|uniquestring|_books_search_join')) {
   /**
    * Prepare join for search request.
    * 
    * @param string $join   Custom join.
    *
    * @return string        Modified "LEFT FOIN".
    */
    function |uniquestring|_books_search_join($join)
    {

        if (!is_admin() || empty($_GET['post_type']) || empty($_GET['s'])) return $join;

        global $wpdb;

        if ('|uniquestring|_books' == $_GET['post_type']) {
            $join = "
                LEFT JOIN {$wpdb->postmeta} AS mx_booksmeta ON {$wpdb->posts}.ID = mx_booksmeta.post_id
            ";
        }

        return $join;
    }
}
add_filter('posts_join', '|uniquestring|_books_search_join');

if (!function_exists('|uniquestring|_books_search_where')) {
    /**
     * Prepare where for search request.
     * 
     * @param string $where  Custom where.
     *
     * @return string        Modified "WHERE".
     */
    function |uniquestring|_books_search_where($where)
    {

        if (!is_admin() || empty($_GET['post_type']) || empty($_GET['s'])) return $where;

        global $wpdb;

        if ('|uniquestring|_books' == $_GET['post_type']) {

            $query = sanitize_text_field($_GET['s']);
            $where = "
                AND mx_booksmeta.meta_value LIKE '%$query%'
            ";
        }

        return $where;
    }
}
add_filter('posts_where', '|uniquestring|_books_search_where');
