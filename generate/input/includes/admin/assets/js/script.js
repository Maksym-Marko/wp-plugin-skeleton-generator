jQuery( document ).ready( function ( $ ) {

	// Bulk actions
	$( '#|uniquestring|_custom_talbe_form' ).on( 'submit', function ( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#_wpnonce' ).val();

		var bulk_action = $( this ).find( '#bulk-action-selector-top' ).val()

		if( bulk_action !== '-1') {
			
			var ids = []
			$( '.|uniquestring|_bulk_input' ).each( function( index, element ) {
				if( $( element ).is(':checked') ) {
					ids.push( $( element ).val() )
				}
			} );

			if( ids.length > 0 ) {

				var data = {
					'action': '|uniquestring|_bulk_actions',
					'nonce': nonce,
					'bulk_action': bulk_action,
					'ids': ids
				}
	
				jQuery.post( |uniquestring|_admin_localize.ajaxurl, data, function( response ) {

					location.reload()
		
				} );

			}

		}
	
	} );

	// Create table item
	$( '#|uniquestring|_form_create_table_item' ).on( 'submit', function ( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#|uniquestring|_wpnonce' ).val();

		var title = $( '#|uniquestring|_title' ).val();
		var description = $( '#|uniquestring|_mx_description' ).val();

		var data = {

			'action': '|uniquestring|_create_item',
			'nonce': nonce,
			'title': title,
			'description': description

		};

		if( title == '' || description == '' ) {

			alert( 'Fill in all fields' )

			return;

		}

		jQuery.post( |uniquestring|_admin_localize.ajaxurl, data, function( response ) {

			if( response === '1' ) {
				window.location.href = |uniquestring|_admin_localize.main_page
			}
			alert( 'Created!' );

		} );
	
	} );

	// Edit table item
	$( '#|uniquestring|_form_update' ).on( 'submit', function ( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#|uniquestring|_wpnonce' ).val();

		var id = $( '#|uniquestring|_id' ).val();
		var title = $( '#|uniquestring|_title' ).val();
		var description = $( '#|uniquestring|_mx_description' ).val();

		var data = {

			'action': '|uniquestring|_update',
			'nonce': nonce,
			'id': id,
			'title': title,
			'description': description

		};

		if( id == '' || title == '' || description == '' ) {

			alert( 'Fill in all fields' )

			return;

		}

		jQuery.post( |uniquestring|_admin_localize.ajaxurl, data, function( response ) {

			// console.log( response );
			alert( 'Updated!' );

		} );

	} );

} );