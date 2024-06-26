<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * The |UNIQUESTRING|CPTGenerator class.
 *
 * Here you can generate CPT, Taxonomies and Metaboxes
 */
class |UNIQUESTRING|CPTGenerator
{

    static $post_type = '|uniquestring|_books';
    static $taxonomy  = '|uniquestring|_book_type';

    public static function createCPT()
    {

        $post_type = self::$post_type;

        // Add CPT.
        add_action('init', ['|UNIQUESTRING|CPTGenerator', 'addCTPs']);

        // Add taxonomy.
        add_action('init', ['|UNIQUESTRING|CPTGenerator', 'addTaxonomies']);

        // Add metaboxes.
        add_action('init', ['|UNIQUESTRING|CPTGenerator', 'addMetaboxes']);

        /**
         * Manage columns.
         * 
         * Add ID column to the table.
         * */
        add_filter("manage_{$post_type}_posts_columns", ['|UNIQUESTRING|CPTGenerator', 'addIdColumn'], 20, 1);

        // Manage ID column.
        add_action("manage_{$post_type}_posts_custom_column", ['|UNIQUESTRING|CPTGenerator', 'booksColumnRow'], 20, 2);

        // Sortable columns.
        add_filter("manage_edit-{$post_type}_sortable_columns", ['|UNIQUESTRING|CPTGenerator', 'sortableColumns'], 20, 1);

        // View columns order.
        add_filter('pre_get_posts', ['|UNIQUESTRING|CPTGenerator', 'viewColumnsOrder']);
    }

    /*
    * Manage new column.
    */
    public static function booksColumnRow($column, $post_id)
    {

        $post_type = self::$post_type;

        if ($column === 'book_id') {
            echo 'Book ID = ' . $post_id;
        }

        if ($column === 'book_author') {
            echo get_post_meta($post_id, "_mx_text-metabox_{$post_type}_id", true);
        }
    }

    /*
    * Add new column to the Custom Post Type.
    */
    public static function addIdColumn($columns)
    {

        $newColumns  = [
            'book_id'     => 'Book ID',
            'book_author' => 'Book Author'
        ];

        $newColumns = |uniquestring|InsertNewColumnToPosition($columns, 3, $newColumns);

        return $newColumns;
    }

    /*
    * Create a Custom Post Type.
    */
    public static function addCTPs()
    {

        register_post_type(self::$post_type, [

            'labels' => [
                'name'               => __('Books', 'wp-plugin-skeleton'),
                'singular_name'      => __('Book', 'wp-plugin-skeleton'),
                'add_new'            => __('Add a new one', 'wp-plugin-skeleton'),
                'add_new_item'       => __('Add a new book', 'wp-plugin-skeleton'),
                'edit_item'          => __('Edit the book', 'wp-plugin-skeleton'),
                'new_item'           => __('New book', 'wp-plugin-skeleton'),
                'view_item'          => __('See the book', 'wp-plugin-skeleton'),
                'search_items'       => __('Find a book', 'wp-plugin-skeleton'),
                'not_found'          => __('Books not found', 'wp-plugin-skeleton'),
                'not_found_in_trash' => __('No books found in the trash', 'wp-plugin-skeleton'),
                'parent_item_colon'  => __('Parent Pages:', 'wp-plugin-skeleton'),
                'menu_name'          => __('Books', 'wp-plugin-skeleton')

            ],
            'menu_icon'          => 'dashicons-admin-site',
            'show_in_rest'       => true,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'world-books'],
            'capability_type'    => 'page', // 'post'
            'capability'         => 'manage_options',
            'has_archive'        => true,
            'hierarchical'       => true, // false
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes']

        ]);

        // Rewrite rules.
        if (is_admin() && get_option('|uniquestring|_flush_rewrite_rules') == 'go_flush_rewrite_rules') {

            delete_option('|uniquestring|_flush_rewrite_rules');

            flush_rewrite_rules();
        }
    }

    /*
    * Create a Custom taxonomy.
    */
    public static function addTaxonomies()
    {
        $type_labels = [
            'name' => __('Book Type', 'wp-plugin-skeleton')
        ];

        $type_args = [
            'hierarchical'      => true,
            'labels'            => $type_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_rest'      => true
        ];

        register_taxonomy(self::$taxonomy, [self::$post_type], $type_args);
    }

    /*
    * Add metaboxes.
    */
    public static function addMetaboxes()
    {

        // Add text input.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'         => 'text-metabox',
                'post_types' => self::$post_type,
                'name'       => esc_html__('Book Author', 'wp-plugin-skeleton')
            ]
        );

        // Add email input.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'email-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('E-mail field', 'wp-plugin-skeleton'),
                'metabox_type' => 'email'
            ]
        );

        // Add url input.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'url-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('URL field', 'wp-plugin-skeleton'),
                'metabox_type' => 'url'
            ]
        );

        // Add number int input.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'number-int-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Number Int field', 'wp-plugin-skeleton'),
                'metabox_type' => 'number-int'
            ]
        );

        // Add number float input.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'number-float-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Number Float field', 'wp-plugin-skeleton'),
                'metabox_type' => 'number-float'
            ]
        );

        // Add textarea.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'desc-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Some Description', 'wp-plugin-skeleton'),
                'metabox_type' => 'textarea'
            ]
        );

        // Add checkbox inputs.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'checkboxes-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Checkbox Buttons', 'wp-plugin-skeleton'),
                'metabox_type' => 'checkbox',
                'options' => [
                    [
                        'label'   => 'Dog',
                        'value'   => 'dog',
                        'checked' => true
                    ],
                    [
                        'label'   => 'Cat',
                        'value'   => 'cat'
                    ],
                    [
                        'label'   => 'Fish',
                        'value'   => 'fish'
                    ]
                ]
            ]
        );

        // Add radio inputs.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'radio-buttons-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Radio Buttons', 'wp-plugin-skeleton'),
                'metabox_type' => 'radio',
                'options' => [
                    [
                        'label'   => 'Red',
                        'value'   => 'red'
                    ],
                    [
                        'label'   => 'Green',
                        'value'   => 'green'
                    ],
                    [
                        'label'   => 'Yellow',
                        'value'   => 'yellow',
                        'checked' => true
                    ]
                ]
            ]
        );

        // Add image upload field.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'           => 'featured-image-metabox',
                'post_types'   => self::$post_type,
                'name'         => esc_html__('Featured image', 'wp-plugin-skeleton'),
                'metabox_type' => 'image'
            ]
        );

        // Add select.
        new |UNIQUESTRING|MetaboxesGenerator(
            [
                'id'            => 'select-metabox',
                'post_types'    => self::$post_type,
                'metabox_type'  => 'select',
                'name'          => esc_html__('Select Pet', 'wp-plugin-skeleton'),
                'options' => [
                    [
                        'value'   => 'dog',
                        'label'   => 'Dog',
                        'selected' => true
                    ],
                    [
                        'value'   => 'cat',
                        'label'   => 'Cat'
                    ],
                    [
                        'value'   => 'fish',
                        'label'   => 'Fish'
                    ]
                ]
            ]
        );
    }

    /*
    * Sortable columns.
    */
    public static function sortableColumns($columns)
    {

        if (!empty($_GET['s'])) return $columns;

        $columns['book_author'] = 'book_author';

        return $columns;
    }

    /*
    * View columns order.
    */
    public static function viewColumnsOrder($query)
    {

        if (!is_admin() || empty($_GET['post_type']) || $_GET['post_type'] !== self::$post_type || empty($_GET['orderby'])) return;

        $post_type = self::$post_type;

        // sort by id
        if ($_GET['orderby'] == 'book_id') {
            $query->set('orderby', 'meta_value');
            $query->set('meta_key', "_mx_text-metabox_{$post_type}_id");
            $query->set('meta_type', 'numeric');
        }
    }
}
