<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<h1>Settings Page</h1>

<div class="mx-block_wrap">

	<form id="|uniquestring|_form_update" class="mx-settings" method="post" action="">

		<h2>Default script</h2>
		<textarea name="|uniquestring|_some_string" id="|uniquestring|_some_string"><?php echo |uniquestring|_select_script(); ?></textarea>

		<p class="mx-submit_button_wrap">
			<input type="hidden" id="|uniquestring|_wpnonce" name="|uniquestring|_wpnonce" value="<?php echo wp_create_nonce( '|uniquestring|_nonce_request' ) ;?>" />
			<input class="button-primary" type="submit" name="|uniquestring|-submit" value="Save" />
		</p>

	</form>

</div>