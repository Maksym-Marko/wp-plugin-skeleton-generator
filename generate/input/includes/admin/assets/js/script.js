jQuery( document ).ready( function( $ ){

	$( '#|uniquestring|_form_update' ).on( 'submit', function( e ){

		e.preventDefault();

		var nonce = $( '#|uniquestring|_wpnonce' ).val();

		var data = {

			'action': '|uniquestring|_update',
			'nonce': nonce

		};

		jQuery.post( ajaxurl, data, function( response ){

			alert( 'Changes saved!' );

		} );

	} );

} );