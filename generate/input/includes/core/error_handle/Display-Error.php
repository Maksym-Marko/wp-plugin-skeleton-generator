<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class |UNIQUESTRING|DisplayError
{

	/**
	* Error notice
	*/
	public $errorNotice = '';

	public function __construct( $errorNotice )
	{

		$this->errorNotice = $errorNotice;

	}

	public function showError()
	{
		
		add_action( 'admin_notices', function() { ?>

			<div class="notice notice-error is-dismissible">

			    <p><?php echo esc_attr( $this->errorNotice ); ?></p>
			    
			</div>
		    
		<?php } );

	}

}
