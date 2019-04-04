$(document).ready(function() {
    $('#juicios').DataTable( {
        language: {
            processing:     "Procesando...",
            search:         "Busca&nbsp;:",
            lengthMenu:    "Muestra _MENU_ Presuntos Responables",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_  Presuntos Responables",
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
            decimal: ".",
            thousands: ",",
            aria: {
                sortAscending:  ": activar para ordenar en forma ascendente",
                sortDescending: ": activar para ordena en forma descendente"
            }
        },
        "order": [[ 9, "desc" ]],
        

        ajax: {
             url: "f/jsonPresuntos.php",
             dataSrc: ''
        },
   
        "columns": [
            {
                className:      'Seguimiento',
                orderable:      false,
                data:           null,
                defaultContent: '<a href="" title="Información Acción" class="accionInfo"><i class="material-icons verde">description</i></a>'+ 
                '<a href="" title="Proceso Presuntos" class="procesoPresunto"><i class="material-icons verde">add_to_home_screen</i></a>' +
                '<a href="" title="Actualizar Presunto" class="editPresunto"><i class="material-icons verde">build</i></a>'

            },
            { "data": "cont" },
            { "data": "accion" },
            { "data": "procedimiento" },
            { "data": "nombre" },
            { "data": "cargo" },
            { "data": "dependencia" },
            { "data": "domicilio" },
            { "data": "monto" },
            { "data": "tipo_notificacion" },
            { "data": "fecha_notificacion_oficio_citatorio" },
            { "data": "fecha_audiencia" },
            { "data": "R" }
        ],

        "columnDefs": [
                { "searchable": false, "targets": 0 },
                { "orderable": false, "targets": 0 },
                {
                    "targets": [ 1 ],
                    "visible": false,
                    "searchable": false
                },
                {  "targets": [8], "className": 'dt-body-right' }
    
            ],

            dom: '<"#boton"B><"top"fl>t<ipr><"clear">', //<#boton >frtip',  // <"top"B>irt<"bottom"flp><"clear">', //'Bfrtip',
            buttons: [
                'excelHtml5', 'pdfHtml5',  'copy'
            ],
    

    } );

    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());

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

    function mostrarInfoClave(pagina, titulo) {
        let alto = 560;
        let ancho =1000;
        let top = 10;
    
    
        this.alto = new Number(alto);
        this.ancho = new Number(ancho);
        this.titulo = new String(titulo);
        this.top = new Number(top);
        this.pagina = String(pagina);
        
        $('#cuadroRes').html('<center><img src="images/load_bar.gif" style="margin:100px 0"></center>');
        document.getElementById('cuadroTitulo').innerHTML = this.titulo;
        this.cuadro = document.getElementById('cuadroDialogo');	
        this.cuadroRes = document.getElementById('cuadroRes');	
        this.cuadro.style.height = this.alto+"px";
        this.cuadroRes.style.height = (this.alto-50)+"px";
        this.cuadro.style.width = this.ancho+"px";
        this.cuadro.style.marginLeft = this.ancho-(this.ancho*1.5)+"px"; // mientras mas alto mas a la izquierda
        
        //this.cuadro.style.top = this.top+"px";
        $("#cuadroDialogo").css("top", "3%");
                
        $("#fondoOscuro").fadeIn();
        $("#cuadroDialogo").fadeIn();
        
        $("#cuadroRes").load(this.pagina);
    }
    

    
    $('#juicios').on('click', 'a.accionInfo', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();
        var pagina = 'cont/pfrr_informacion.php?numAccion=' + encodeURIComponent(row.data().accion) + '&usuario=fllamas' +  
                    '&direccion=DG' +  + '&nivel=A';
        var titulo = row.data().accion +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +  row.data().dependencia + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().R;
        mostrarInfoClave(pagina, titulo);
	} );


    $('#juicios').on('click', 'a.procesoPresunto', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();
        var pagina = 'cont/pfrr_presuntos_proceso.php?idPresuntop='+encodeURIComponent(row.data().cont)+ 
                    '&numAccion=' + encodeURIComponent(row.data().accion) + '&usuario=fllamas';
        var titulo = row.data().nombre + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +  row.data().accion + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().R;
        mostrarInfoClave(pagina, titulo);
    } );
    

    $('#juicios').on('click', 'a.editPresunto', function (e) {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        e.preventDefault();
        var pagina = 'f/pfrr_presuntos_datos.php?idPresuntop='+encodeURIComponent(row.data().cont)+ 
                    '&numAccion=' + encodeURIComponent(row.data().accion) + '&usuario=fllamas';
        var titulo = row.data().accion +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +  row.data().dependencia + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().R;
        mostrarInfoClave(pagina, titulo);
	} );

} );