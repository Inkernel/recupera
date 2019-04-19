var e;
var llave;



function formaTabla() {
 //   e = document.getElementById('entidad');
 //   llave = e.options[e.selectedIndex].text;
    
    console.log('llave: '+llave);
    console.log($(searchForm).serialize());

        $.post( "jsonBuscaIrregularidad.php", $(searchForm).serialize() )
        .done(function( data ) {
             console.log( "Irreglaridad: ");
             var d = JSON.parse(data);
            $('#irregularidad').text('Irregularidad: acciones ' + d.length);
        });

        $.post( "jsonBuscaIrregularidadPresuntos.php", $(searchForm).serialize() )
        .done(function( data ) {
             console.log( "Irreglaridad presntos: " + data );
             var d = JSON.parse(data);
            $('#irregularidadPresuntos').text('Irregularidad presuntos: ' + d.length);
        });


        $.post( "jsonBuscaCargo.php", $(searchForm).serialize() )
        .done(function( data ) {
             console.log( "Cargo: " + data );
             var d = JSON.parse(data);
            $('#cargo').text('Presuntos - Cargo: ' + d.length);
        });


        $.post( "jsonBuscaEntidad.php", $(searchForm).serialize() )
        .done(function( data ) {
             console.log( "Estado: " + data );
             var d = JSON.parse(data);
            $('#estado').text('Acciones en Entidad Federativa: ' + d.length);
        });

        $.post( "jsonBuscaEntidadPresuntos.php", $(searchForm).serialize() )
        .done(function( data ) {
             console.log( "Entidad Presuntos: " + data );
             var d = JSON.parse(data);
            $('#estadoPresuntos').text('Presuntos en Entidad Federativa: ' + d.length);
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
                url: "api/jsonEstado.php",
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
