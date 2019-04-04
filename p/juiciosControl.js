$(document).ready(function() {
    $('#juicios').DataTable( {

        language: {
            processing:     "Procesando...",
            search:         "Busca&nbsp;:",
            lengthMenu:    "Muestra _MENU_ procedimientos",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ procedimientos",
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
             url: "p/jsonJCAxProcemiento.php",
             dataSrc: ''
        },
        /*
        "scrollX": true,
        */
        "columns": [
            { "data": "procedimiento" },
            { "data": "resultado" },
            { "data": "j" },
            { "data": "jcaF" },
            { "data": "jcaD" },
            { "data": "jcaT" },
            { "data": "a" },
            { "data": "aF" },
            { "data": "aD" },
            { "data": "aT" },
            { "data": "rrf" },
            { "data": "rrfF" },
            { "data": "rrfD" },
            { "data": "rrfT" }
        ],
        "columnDefs": [
            {
            "targets": [2,3,4,5,6,7,8,9,10,11,12,13],
            "className": 'dt-body-right'
            }
        ],
        dom: '<"top"iB>rt<"bottom"flp><"clear">', //<#boton >frtip',  // <"top"B>irt<"bottom"flp><"clear">', //'Bfrtip',
        buttons: [
                'excelHtml5', 'pdfHtml5',  'copy'
            ]    

    } );

    $('#fondo').fadeIn();
    $('#fondo').height($(window).height());

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


    



    



} );