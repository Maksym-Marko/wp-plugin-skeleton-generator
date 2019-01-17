<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class |UNIQUESTRING|_Display_Error
{

	/**
	* Error notice
	*/
	public $|uniquestring|_error_notice = '';

	public function __construct( $|uniquestring|_error_notice )
	{

		$this->|uniquestring|_error_notice = $|uniquestring|_error_notice;

	}

	public function |uniquestring|_show_error()
	{
		
		add_action( 'admin_notices', function() { ?>

			<div class="notice notice-error is-dismissible">

			    <p><?php echo $this->|uniquestring|_error_notice; ?></p>
			    
			</div>
		    
		<?php } );

	}

}