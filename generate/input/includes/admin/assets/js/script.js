jQuery( document ).ready( function( $ ){

	$( '#|uniquestring|_form_update' ).on( 'submit', function( e ){

		e.preventDefault();

		var nonce = $( this ).find( '#|uniquestring|_wpnonce' ).val();

		var someString = $( '#|uniquestring|_some_string' ).val();

		var data = {

			'action': '|uniquestring|_update',
			'nonce': nonce,
			'|uniquestring|_some_string': someString

		};

		jQuery.post( ajaxurl, data, function( response ){

			console.log( response );

		} );

	} );

} );