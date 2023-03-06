<div class="mx-main-page-text-wrap">
	
	<h1><?php echo __( 'Create Table Item', '|uniquestring|-domain' ); ?></h1>

	<a href="<?php echo admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ); ?>">Go Back</a>

    <div class="mx-block_wrap">

		<form id="|uniquestring|_form_create_table_item" class="mx-settings" method="post" action="">

			<div>
                <label for="|uniquestring|_title">Title</label>
                <br>
                <input type="text" name="|uniquestring|_title" id="|uniquestring|_title" value="" />
            </div>
            <br>
            <div>
                <label for="|uniquestring|_mx_description">Description</label>
                <br>
                <textarea name="|uniquestring|_mx_description" id="|uniquestring|_mx_description"></textarea>
            </div>

            <p class="mx-submit_button_wrap">
                <input type="hidden" id="|uniquestring|_wpnonce" name="|uniquestring|_wpnonce" value="<?php echo wp_create_nonce('|uniquestring|_nonce_request'); ?>" />
                <input class="button-primary" type="submit" name="|uniquestring|_submit" value="Create" />
            </p>

		</form>

	</div>

</div>