$( document ).ready( function(){

  // submit
  $( '#mxFormCreateSceleton' ).on( 'submit', function( e ){

    e.preventDefault();

    var notSubmitted = [];

    $( this ).find( 'input, textarea' ).each( function(){

      // check empty
      mxCheckEmpty( $( this ) );

      if( $( this ).attr( 'data-not-submitted' ) === 'true' ){

        notSubmitted.push( 'true' );

      }

    } );

    // AJAX
    var _this = $( this );

    setTimeout( function(){

      if( notSubmitted.length === 0 ){        

        mxPostData( _this.serialize() );

      }      

    },1000 );   

  } );

  // change
  $( 'input, textarea' ).each( function(){

    $( this ).on( 'change', function(){

      // check empty
      mxCheckEmpty( $( this ) );   

    } );

  } );

  // paste
  $( 'input, textarea' ).each( function(){

    $( this ).on( 'paste', function(){

      // check empty
      mxCheckEmpty( $( this ) );   

    } );

  } );

} );

// check empty
function mxCheckEmpty( _this ){

  if( _this.val().length === 0 ){

    _this.addClass( 'mx-border_red' );

    _this.next( '.invalid-feedback' ).addClass( 'mx-db' );        

    // not submitted
    _this.attr( 'data-not-submitted', 'true' );

  } else{

    _this.removeClass( 'mx-border_red' );

    _this.next( '.invalid-feedback' ).removeClass( 'mx-db' );

    // is submitted
    _this.removeAttr( 'data-not-submitted' );

  }

}

// $.post
function mxPostData( serialize ){

  $.post( "generate.php", serialize, function( data ) {

    //console.log( 'Created!' );
    console.log( data );

  } );

}