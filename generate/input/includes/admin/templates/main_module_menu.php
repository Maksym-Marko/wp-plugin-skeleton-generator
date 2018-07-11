<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<ul>
	<li>
		<a href="admin.php?page=|unique_submenu_slug|&p=main"><h1><?php echo __( 'Main page', '|uniquestring|-domain' ); ?></h1></a>
	</li>
	<li>
		<a href="admin.php?page=|unique_submenu_slug|&p=page1"><h1><?php echo __( 'Page 1', '|uniquestring|-domain' ); ?></h1></a>
	</li>
	<li>
		<a href="admin.php?page=|unique_submenu_slug|&p=page2"><h1><?php echo __( 'Page 2', '|uniquestring|-domain' ); ?></h1></a>
	</li>
</ul>