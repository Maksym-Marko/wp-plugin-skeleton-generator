<div class="mx-main-page-text-wrap">

	<h1><?php echo __('Main Admin Page', '|uniquestring|-domain'); ?></h1>

	<div class="mx-block_wrap">

		<form id="|uniquestring|_form_update" class="mx-settings" method="post" action="">

			<h2>This form is connected to this plugin's DB table</h2>

			<div>
				<label for="|uniquestring|_mx_name">Title</label>
				<br>
				<input type="text" name="|uniquestring|_mx_name" id="|uniquestring|_mx_name" value="<?php echo $data->mx_name; ?>" />
			</div>
			<br>
			<div>
				<label for="|uniquestring|_mx_description">Description</label>
				<br>
				<textarea name="|uniquestring|_mx_description" id="|uniquestring|_mx_description"><?php echo $data->mx_desc; ?></textarea>
			</div>

			<p class="mx-submit_button_wrap">
				<input type="hidden" id="|uniquestring|_wpnonce" name="|uniquestring|_wpnonce" value="<?php echo wp_create_nonce('|uniquestring|_nonce_request'); ?>" />
				<input class="button-primary" type="submit" name="|uniquestring|_submit" value="Save" />
			</p>

		</form>

	</div>

</div>