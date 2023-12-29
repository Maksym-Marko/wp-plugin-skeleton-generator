<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

?>

<div class="mx-single-table-item-wrap">

    <h1><?php echo __( 'Edit Table Item', 'wp-plugin-skeleton' ); ?></h1>

    <a href="<?php echo admin_url( 'admin.php?page=' . |UNIQUESTRING|_MAIN_MENU_SLUG ); ?>">Go Back</a>

    <div class="|uniquestring|mx_block_wrap">

        <form id="|uniquestring|_form_update" class="mx-settings" method="post" action="">

            <input type="hidden" id="|uniquestring|_id" name="|uniquestring|_id" value="<?php echo $data->id; ?>" />

            <h2>This form is connected to this plugin's DB table</h2>

            <div>
                <label for="|uniquestring|_title">Title</label>
                <br>
                <input type="text" name="|uniquestring|_title" id="|uniquestring|_title" value="<?php echo $data->title; ?>" />
            </div>
            <br>
            <div>
                <label for="|uniquestring|_mx_description">Description</label>
                <br>
                <textarea name="|uniquestring|_mx_description" id="|uniquestring|_mx_description"><?php echo $data->description; ?></textarea>
            </div>

            <p class="mx-submit_button_wrap">
                <input type="hidden" id="|uniquestring|_wpnonce" name="|uniquestring|_wpnonce" value="<?php echo wp_create_nonce('|uniquestring|_nonce_request'); ?>" />
                <input class="button-primary" type="submit" name="|uniquestring|_submit" value="Save" />
            </p>

        </form>

    </div>

</div>