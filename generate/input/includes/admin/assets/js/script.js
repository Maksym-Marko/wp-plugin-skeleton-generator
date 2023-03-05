jQuery( document ).ready( function ( $ ) {

	$( '#|uniquestring|_form_update' ).on( 'submit', function ( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#|uniquestring|_wpnonce' ).val();

		var title = $( '#|uniquestring|_title' ).val();
		var id = $( '#|uniquestring|_id' ).val();

		var description = $( '#|uniquestring|_mx_description' ).val();

		var data = {

			'action': '|uniquestring|_update',
			'nonce': nonce,
			'id': id,
			'title': title,
			'description': description

		};

		jQuery.post( |uniquestring|_admin_localize.ajaxurl, data, function ( response ) {

			// console.log( response );
			alert( 'Updated!' );

		} );

	} );

} );