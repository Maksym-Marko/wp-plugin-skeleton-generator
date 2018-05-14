<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class |UNIQUESTRING|DataBaseTalk
{

	/*
	* |UNIQUESTRING|DataBaseTalk constructor
	*/
	public function __construct()
	{

		$this->|uniquestring|_observe_update_data();

	}

	/*
	* Observe function
	*/
	public function |uniquestring|_observe_update_data()
	{

		add_action( 'wp_ajax_|uniquestring|_update', array( $this, 'prepare_update_script' ) );

	}

	/*
	* Prepare for data updates
	*/
	public function prepare_update_script()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], '|uniquestring|_nonce_request' ) ){

			// Restore data by default
			if( $_POST['is_checked_restore'] === 'restore' ){

				$this->restore_data();

			} else{

				$this->update_script( $_POST['script_string'], $_POST['block_string'] );

			}			

		}

		wp_die();

	}

		// Update data
		public function update_script( $string_script, $string_block )
		{

			$clean_string_script = str_replace( '\\', '', esc_html( $string_script ) );

			$clean_string_block = str_replace( '\\', '', esc_html( $string_block ) );

			global $wpdb;

			$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

			$wpdb->update(

				$table_name, 
				array(
					'script' => $clean_string_script,
					'block_icons' => $clean_string_block,
				), 
				array( 'id' => 1 ), 
				array( 
					'%s'
				)

			);

		}

		// Restore data
		public function restore_data()
		{

			$restore_string_script = '&lt;script type=&quot;text/javascript&quot;&gt;(function() {
			  if (window.pluso)if (typeof window.pluso.start == &quot;function&quot;) return;
			  if (window.ifpluso==undefined) { window.ifpluso = 1;
			    var d = document, s = d.createElement(&#039;script&#039;), g = &#039;getElementsByTagName&#039;;
			    s.type = &#039;text/javascript&#039;; s.charset=&#039;UTF-8&#039;; s.async = true;
			    s.src = (&#039;https:&#039; == window.location.protocol ? &#039;https&#039; : &#039;http&#039;)  + &#039;://share.pluso.ru/pluso-like.js&#039;;
			    var h=d[g](&#039;body&#039;)[0];
			    h.appendChild(s);
			  }})();&lt;/script&gt;';

			$restore_string_block = '&lt;div class=&quot;pluso&quot; data-background=&quot;transparent&quot; data-options=&quot;medium,round,line,horizontal,nocounter,theme=04&quot; data-services=&quot;vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print&quot; data-url=&quot;%PAGE-URL%&quot; data-title=&quot;%TITLE%&quot; data-description=&quot;%DESCRIPTION%&quot;&gt;&lt;/div&gt;';

			global $wpdb;

			$table_name = $wpdb->prefix . |UNIQUESTRING|_TABLE_SLUG;

			$wpdb->update(

				$table_name, 
				array(
					'script' => $restore_string_script,
					'block_icons' => $restore_string_block,
				), 
				array( 'id' => 1 ), 
				array( 
					'%s'
				)

			);

		}

}

// New instance
new |UNIQUESTRING|DataBaseTalk();