<div class="mx-main-page-text-wrap">

	<div class="wrap">

		<h1 class="wp-heading-inline"><?php _e( 'Custom Table Items', '|uniquestring|-domain' ); ?></h1>
		<a href="<?php echo admin_url( 'admin.php?page=' . |UNIQUESTRING|_CREATE_TABLE_ITEM_MENU ); ?>" class="page-title-action">Add New</a>
		<hr class="wp-header-end">

		<?php
			|uniquestring|_table_layout();
		?>

	</div>

</div>