function formaTabla() {
    let e = document.getElementById('entidad');
    let llave = e.options[e.selectedIndex].text;

    console.log(llave);
    $.post( "f/jsonBuscaEntidad.php", { entidad: llave } )
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
        });
}

    

$(document).ready(function() {

    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());
    




} );