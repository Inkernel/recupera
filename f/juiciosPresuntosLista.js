$(document).ready(function() {
    $('#juicios').DataTable( {

        language: {
            processing:     "Procesando...",
            search:         "Busca&nbsp;:",
            lengthMenu:    "Muestra _MENU_ Juicios Contenciosos",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Juicios contenciosos administrativos",
            infoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered:   "(filtrado de un total de _MAX_ registros)",
            infoPostFix:    "",
            loadingRecords: "Cargando información...",
            zeroRecords:    "No se encontraron resultados",
            emptyTable:     "Ningún dato disponible en esta tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar en forma ascendente",
                sortDescending: ": activar para ordena en forma descendente"
            }
        },

        ajax: {
             url: "f/jsonPresuntos.php",
             dataSrc: ''
        },
   
        "columns": [
            {
                className:      'Seguimiento',
                orderable:      false,
                data:           null,
                defaultContent: '<a href="" title="Proceso de Presuntos" class="dummy"><i class="material-icons">description</i></a>'+ 
                '<a href="" title="Información" class="dummy"><i class="material-icons">add_to_home_screen</i></a>' +
                '<a href="" title="Acción" class="dummy"><i class="material-icons">book</i></a>'

            },
            { "data": "cont" },
            { "data": "nombre" },
            { "data": "accion" },
            { "data": "cargo" },
            { "data": "dependencia" },
            { "data": "monto" },
            { "data": "R" }
        ],

        "columnDefs": [
                { "searchable": false, "targets": 0 },
                { "orderable": false, "targets": 0 },
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                }
            ],

            dom: '<"#boton"B><"top"fl>t<ipr><"clear">', //<#boton >frtip',  // <"top"B>irt<"bottom"flp><"clear">', //'Bfrtip',
            buttons: [
                'excelHtml5', 'pdfHtml5',  'copy'
            ]    

    } );

    $('#fondoOscuro3').fadeIn();
    $('#fondoOscuro3').height($(window).height());

    // Setup - add a text input to each footer cell
    $('#juicios tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="F '+title+'" />' );
    } );
     
    // DataTable
    var table = $('#juicios').DataTable();
     
    // Apply the search
    table.columns().every( function () {
            var that = this;
     
            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
    } );


    


function mostrarSeguimiento(pagina) {
    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());

    $("#altaOficio").css("width", "80%");
    $("#altaOficio").css("top", "3%");
    $("#altaOficio").css("height", "auto");

    $("#altaOficio").fadeIn();
    $("#altaOficio").load(pagina);
}

function mostrarAltaOficio(pagina) {
    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());
    $("#altaOficio").css("width", "65%");

    $("#altaOficio").fadeIn();
    $("#altaOficio").load(pagina);
}

function mostrarAltaVolante(pagina) {
    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());
    $("#altaOficio").css("width", "65%");
    $("#altaOficio").fadeIn();
    $("#altaOficio").load(pagina);
}


function mostrarAltaRecurso(pagina) {
    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());
    $("#altaOficio").css("width", "65%");
    $("#altaOficio").fadeIn();
    $("#altaOficio").load(pagina);
}




    

    
    $('#juicios').on('click', 'a.oficio', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        var pagina = 'e/juiciosOficio.php?id='+encodeURIComponent(row.data().id)+'&accion='+encodeURIComponent(row.data().accion)+'&juicionulidad='+encodeURIComponent(row.data().juicionulidad);
        console.log(pagina);
        mostrarAltaOficio(pagina);
    } );
    
    $('#juicios').on('click', 'a.zzz', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        var pagina = 'e/juiciosVolante.php?id='+encodeURIComponent(row.data().id)+'&accion='+encodeURIComponent(row.data().accion)+'&juicionulidad='+encodeURIComponent(row.data().juicionulidad);
        console.log(pagina);
        mostrarAltaVolante(pagina);
    } );
    
    $('#juicios').on('click', 'a.recurso', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        var pagina = 'e/juiciosRecursoFiscal.php?id=' + encodeURIComponent(row.data().id) + 
                        '&accion=' + encodeURIComponent(row.data().accion) + 
                        '&juicionulidad=' + encodeURIComponent(row.data().juicionulidad) + 
                        '&procedimiento=' + encodeURIComponent(row.data().procedimiento) + 
                        '&actor=' + encodeURIComponent(row.data().actor);
        console.log(pagina);
        mostrarAltaRecurso(pagina);
	} );

    $('#juicios').on('click', 'a.amparoDirecto', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        var pagina = 'e/juiciosAmparoDirecto.php?id=' + encodeURIComponent(row.data().id) + 
                        '&accion=' + encodeURIComponent(row.data().accion) + 
                        '&juicionulidad=' + encodeURIComponent(row.data().juicionulidad) + 
                        '&procedimiento=' + encodeURIComponent(row.data().procedimiento) + 
                        '&actor=' + encodeURIComponent(row.data().actor);
        console.log(pagina);
        mostrarAltaRecurso(pagina);
    } );
    
    $('#juicios').on('click', 'a.motor', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        let pagina = 'e/juiciosModifica.php?juicioid='+row.data().id;
        console.log(pagina);
        mostrarSeguimiento(pagina);
    } );




} );