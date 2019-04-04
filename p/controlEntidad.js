var e;
var llave;



function formaTabla() {
 //   e = document.getElementById('entidad');
 //   llave = e.options[e.selectedIndex].text;
    
    console.log('llave: '+llave);
    console.log($(searchForm).serialize());

    $.post( "f/jsonBuscaEntidad.php", $(searchForm).serialize() )
        .done(function( data ) {
            for (var i = 0; i < data.length; i++) {
                for (var key in data[i]){
                    console.log( "Data Loaded: " + key );
                }
            };

            // console.log( "Data Loaded: " + data );
            $('#irregularidad').text(data.length);
        });

/*
        $.ajax({
            async: true,   // this will solve the problem
            type: "POST",
            url: "f/jsonBuscaEntidad.php",
            contentType: "application/json",
            data: JSON.stringify({ entidad: llave }),
            success: function(result){
                console.log(result);
            }
         });
*/
}

function formaTablaCargo() {
       $.post( "f/jsonBuscaEntidad.php", $(searchForm).serialize() )
           .done(function( data ) {
               for (var i = 0; i < data.length; i++) {
                   for (var key in data[i]){
                       console.log( "Data Loaded: " + key );
                   }
               };
   
               // console.log( "Data Loaded: " + data );
               $('#irregularidad').text(data.length);
           });
   
   /*
           $.ajax({
               async: true,   // this will solve the problem
               type: "POST",
               url: "f/jsonBuscaEntidad.php",
               contentType: "application/json",
               data: JSON.stringify({ entidad: llave }),
               success: function(result){
                   console.log(result);
               }
            });
   */
   }

function cerrarCuadrito() {
    $("#tablero").fadeOut();
    $('#mantel').fadeOut('slow');
  }


    

$(document).ready(function() {

    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());

    $("#entidad").autocomplete({
        source: function( request, response ) {
            $.ajax({
                type: "POST",
                url: "f/jsonEstado.php",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function( data ) {
                    console.info(data);
                    response(data);
                    }
                });
        },
        select: function( event, ui )   {
          }
    });


    $("#kernel").click(function(){
        formaTabla();

	});






} );
