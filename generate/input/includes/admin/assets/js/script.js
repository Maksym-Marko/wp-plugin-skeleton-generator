jQuery( document ).ready( function ( $ ) {

	$( '#|uniquestring|_form_update' ).on( 'submit', function ( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#|uniquestring|_wpnonce' ).val();

		var name = $( '#|uniquestring|_mx_name' ).val();

		var description = $( '#|uniquestring|_mx_description' ).val();

		var data = {

			'action': '|uniquestring|_update',
			'nonce': nonce,
			'name': name,
			'description': description

		};

		jQuery.post( |uniquestring|_admin_localize.ajaxurl, data, function ( response ) {

			// console.log( response );
			alert( 'Updated!' );

		} );

	} );

} );