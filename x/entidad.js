$(document).ready(function() {
    console.log("hola:"+$("#xxx").val());
    $('#juicios').DataTable( {

        language: {
            processing:     "Procesando...",
            search:         "Busca&nbsp;:",
            lengthMenu:    "Muestra _MENU_ Acciones",
            info:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ Acciones",
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
             url: "x/jsonEntidad.php",
             data: { "xxx": $("#xxx").val() },
             dataSrc: ''

        },
   
        "columns": [
            {
                className:      'x',
                orderable:      false,
                data:           null,
                defaultContent: '<a href="" title="Ver Información" class="informacion icon-5 info-tooltip"></a>' + 
                                '<a href="" title="Actualizar" class="actualizar icon-1 info-tooltip"></a>' +
                                '<a href="" title="Presuntos Responsables" class="presuntos icon-6 info-tooltip"></a>' +
                                '<a href="" title="Autoridades" class="autoridades icon-7 info-tooltip"></a>'  +
                                '<a href="" title="Ver Bitacora" class="bitacora icon-8 info-tooltip"></a>' 
            },
            { "data": "num_accion" },
            { "data": "entidad" },
            { "data": "cp",  width: "10px" },
            { "data": "fondo",  width: "10px" },
            { "data": "UAA",  width: "10px" },
            { "data": "po",  width: "10px" },


            { "data": "pdrcs" },
 
            { "data": "estado", width: "150px" },
            { "data": "monto" },
           
            { "data": "detalle_edo_tramite", width: "10px" }
        ],
        "order": [[ 9, "desc" ]],

        "columnDefs": [
                { "searchable": false, "targets": 0 },
                { "orderable": false, "targets": 0 }
            ],

            dom:  '<"top"Birf>t<"bottom"lpi><"clear">', 
            buttons: [
                'excelHtml5', 'pdfHtml5',  'copy'
            ]    

    } );

    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());

    // Setup - add a text input to each footer cell
    $('#juicios tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
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



    function mostrarInformacion(pagina, titulo) {
        let alto = 660;
        let ancho =1200;
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



function mostrarAltaVolante(pagina, titulo) {
    let alto = 560;
    let ancho =1300;
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
    

    
$('#juicios').on('click', 'a.informacion', function (e) {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    e.preventDefault();
    var pagina = 'cont/pfrr_informacion.php?numAccion='+encodeURIComponent(row.data().num_accion)+ '&usuario=fllamas' + '&direccion=DG' + '&nivel=A';
    var titulo = encodeURIComponent(row.data().num_accion) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +  row.data().entidad + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().estado;
    mostrarInformacion(pagina, titulo);
} );

$('#juicios').on('click', 'a.actualizar', function (e) {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    e.preventDefault();
    var pagina = 'cont/pfrr_proceso.php?numAccion='+encodeURIComponent(row.data().num_accion)+ '&usuario=fllamas' + '&direccion=DG' + '&nivel=A';
    var titulo = encodeURIComponent(row.data().num_accion) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().entidad + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().estado;
    mostrarAltaVolante(pagina, titulo);
} );

$('#juicios').on('click', 'a.presuntos', function (e) {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    e.preventDefault();
    var pagina = 'cont/pfrr_presuntos.php?numAccion='+encodeURIComponent(row.data().num_accion)+ '&usuario=fllamas' + '&direccion=DG' + '&nivel=A';
    var titulo = encodeURIComponent(row.data().num_accion) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().entidad + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().estado;
    mostrarAltaVolante(pagina, titulo);
} );

$('#juicios').on('click', 'a.autoridades', function (e) {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    e.preventDefault();
    var pagina = 'cont/pfrr_autoridades.php?numAccion='+encodeURIComponent(row.data().num_accion)+ '&usuario=fllamas' + '&direccion=DG' + '&nivel=A';
    var titulo = encodeURIComponent(row.data().num_accion) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().entidad + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().estado;
    mostrarAltaVolante(pagina, titulo);
} );

$('#juicios').on('click', 'a.bitacora', function (e) {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    e.preventDefault();
    var pagina = 'cont/pfrr_bitacora.php?numAccion='+encodeURIComponent(row.data().num_accion)+ '&usuario=fllamas' + '&direccion=DG' + '&nivel=A';
    var titulo = encodeURIComponent(row.data().num_accion) +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().entidad + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + row.data().estado;
    mostrarAltaVolante(pagina, titulo);
} );


} );