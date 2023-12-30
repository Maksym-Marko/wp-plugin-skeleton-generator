# WPP-generator - boilerplate for your best WordPress plugin

You can create a WordPress Plugin Boilerplate here - https://markomaksym.com.ua/wp-plugin-skeleton-generator/

## About WPP generator
**Stable version: 6.0.0**  
**Tested up to WordPress: 6.4**  

When I want to create a new WordPress plugin I always use a WPP generator (wordpress empty plugin) to start with. This saves a lot of time and allows me to avoid a large part of the routine work.

To quickly get a starter set for any WordPress plugin, I created a WPP generator - Wordpress plugin skeleton generator.

This framework gives a much wider starter functionality and a set of necessary files to start working then most of existing starter kits.

## How to use the WPP generator
1. Generate plugin skeleton
WPP generator will generate the skeleton files needed for any WordPress plugin. The full functionality of the plugin can be accessed either via a web interface.
To generate a plugin skeleton for WordPress go to https://markomaksym.com.ua/wp-plugin-skeleton-generator/. Fill in all the fields and click the "Create Plugin Boilerplate" button.

2. Installation
This starter plugin has been tested to work with WordPress 5.0 and newer.
General installation procedures are those common for all WordPress plugins:
- download the plugin template zip archive;
- upload the archive to the "Plugins" section of your website;
- click the "Activate" button.

## Features
- Basic install and uninstall, activate and deactivate plugin hooks;
- During the generation of a new WordPress Plugin boilerplate, all the PHP classes and functions will be rewritten with a unique string created using your plugin name;
- Ability to separate your code to admin and frontend folders;
- Admin menu items and ability to create unlimited number of admin pages;
- Custom Post Type (ability to create a new post type and add new posts);
- Metaboxes:
    * text
    * number
    * checkboxes
    * radio buttons
    * textarea
    * image upload
    * select
- Custom database table creation;
- AJAX request examples;
- admin_enqueue_scripts, wp_enqueue_scripts and wp_localize_script examples;
- Custom table with search box, bulk actions, sorting, editing, remove, restore features (example how to extend WP_List_Table basic WordPress table framework);
- A set of examples of banners, icons, screenshots, readme.txt and license.txt files needed for uploading your plugin to the WordPress.org directory;
- The plugin boilerplate template has been designed to be easily expanded by adding new features;
- Gutenberg blocks:
    * Server Side Rendering
    * Simple Text
    * Simple Image
    * Image Section
    * Nested blocks
    * Counter Section
- Added sortable column to CPT admin table;
- Improved admin table search for CPT (search by metabox values) - Must be improved.
- Improved metaboxes.

Here you can find a list of plugins created using the WPP generator and hosted in the WordPress.org plugin directory: https://profiles.wordpress.org/markomaksym/#content-plugins


== WPP Generator ==

WPP Generator Version:        6.0.0  
WPP Generator Author:         Maksym Marko  
WPP Generator Author Website: https://markomaksym.com.ua/  
WPP Generator Video Guide:    https://www.youtube.com/watch?v=6PZbXBhxtN0&list=PLqb2a5jr0z4XRwroV3nA9nAe4596lPjxr

===
This script is designed to create a basic skeleton for your future WordPress plugin.
Contains a wide set of files and functions.

== Changelog ==

= 6.0.0 (12/30/2023) =
\* Refactoring. Added more escape/translate functions. Debugging mode improved.

= 5.4.1 (12/2/2023) =
\* Added an example of block extending. Now you can add metadata to paragraph, title and button.

= 5.4.0 (11/23/2023) =
\* Added JS minifier. Added more escape functions. Fixed Routers by WordPress requirements. Added Vue.js v2.7.14 and example. Added shortcode example. Made admin menu links unique.

= 5.3.6 =

\* Added "select" metabox. Added sortable column to CPT admin table. Improved admin table search for CPT (search by metabox values). Improved metaboxes.

= 5.3.5 =

\* Small bug fixed.

= 5.3.4 =

\* Gutenberg blocks: Content Slider, Full width section, Responsive spacer.

= 5.3.3 =

\* Gutenberg blocks: Counter Section.

= 5.3.2 =

\* Gutenberg blocks: Nested Blocks.

= 5.3.1 =

\* Gutenberg blocks: Simple Text, Simple Image, Image Section.

= 5.3 =

\* Gutenberg blocks support.

= 5.2 =

\* PSR implemented.

= 5.1 =

\* Custom table. WP_List_Table.

= 5.0 =

\* PHP 8.0 support.

= 4.0 =

\* manage_{$post->post_type}_posts_columns and manage_{$post->post_type}_posts_custom_column.

= 3.9 =

\* esc_attr()

= 3.8 =

\* Sanitize the data.

= 3.7 =

\* Create table functionality implementation. Installation changes.

= 3.6 =

\* Debug mode.

= 3.5 =

\* Mx Metaboxes. Some updates.