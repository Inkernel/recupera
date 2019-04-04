$(document).ready(function() {
    $('#juicios').DataTable( {

        language: {
            processing:     "Procesando...",
            search:         "Busca&nbsp;:",
            lengthMenu:    "Muestra _MENU_ Amparos Directos",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Amparos Directos",
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
             url: "e/jsonJuiciosAD.php",
             dataSrc: ''
        },
   
        "columns": [
            {
                className:      'Seguimiento',
                orderable:      false,
                data:           null,
                defaultContent: '<a href="" title="Generar Oficio" class="oficio"><i class="material-icons" style="color:#069;">description</i></a>' + 
                                '<a href="" title="Generar Volante" class="zzz"><i class="material-icons">add_to_home_screen</i></a>' + 
                                '<a href="" title="Detalle" class="motor"><svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#bd10e0" stroke-width="3" stroke-linecap="square" stroke-linejoin="arcs"><path d="M12 19V6M5 12l7-7 7 7"/></svg></a>'
            },
            { "data": "id" },
            { "data": "procedimiento" },
            { "data": "juicionulidad" },
            { "data": "actor" },
            { "data": "ejecutoria_amparo" },
            { "data": "sub" },
            { "data": "ad_status" },
            { "data": "ad_f_interposicion" },
            { "data": "fecha_ejec_amp" },
            { "data": "fecha_not_ejec_amp" }
        ],

        "columnDefs": [
                { "searchable": false, "targets": 0 },
                { "orderable": false, "targets": 0 },
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                {
                "targets": [5,6,7],
                "className": 'dt-body-right'
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
    $("#altaOficio").css("overflow", "auto");
    $("#altaOficio").height($(window).height());

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
    $("#altaOficio").fadeIn();
    $("#altaOficio").load(pagina);
}



    
//    $("#formajuicios").html('<b>Custom tool bar! Text/images etc.</b>');
 //   $("#Fallo").on("click", {msg: "You just clicked me!"}, handlerName);

    $('#juicios').on('click', 'a.xxx', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        let pagina = 'e/juiciosActualiza.php?juicioid='+row.data().id;
        console.log(pagina);
        mostrarSeguimiento(pagina);
	} );
    
    $('#juicios').on('click', 'a.oficio', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();

        console.log(row.data().id);
        var pagina = 'e/juiciosADoficio.php?id='+encodeURIComponent(row.data().id)+'&accion='+encodeURIComponent(row.data().accion)+'&juicionulidad='+encodeURIComponent(row.data().juicionulidad);
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