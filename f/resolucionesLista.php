<?php ?> 
<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resoluciones Notificadas x Presunto</title>

    <link rel="stylesheet" href="css/acuerdoLista.css">
    <link rel="stylesheet" href="js/datatables/dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css"/>

    <script type="text/javascript" src="f/resolucionesLista.js"></script>

    <script>
        function cerrarlista() {
		    $("#lista").fadeOut();
		    $('#popup-overlay').fadeOut('slow');
        }
    </script>  
</head>

<body>
    <div id='altaOficio' style="display: none;"></div>
    <div id="popup-overlay"></div>

    <div id="lista">
        <div class="navbarJuicios">
            <a href="#" class="logo">Resoluciones Notificadas por Presunto responsable</a>
		    <div class="navbarJuicios-right">
                <a href="javascript:cerrarlista()">Cerrar</a>
		    </div>
        </div>
        
        <div id = "contenedor">
          <table id="juicios" class="display" style="width:100%">
            <thead>
                <tr>
				    <th>x</th>
                    <th>Cuenta</th>
                    <th>Entidad</th>
                    <th>Acción</th>
                    <th>Procedimiento</th>
                    <th>Monto</th>
                    <th>Emisión R</th>
                    <th>Notificación R</th>
                    <th>Presunto</th>
                    <th>Resp</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th>x</th>
                    <th>Cuenta</th>
                    <th>Entidad</th>
                    <th>Acción</th>
                    <th>Procedimiento</th>
                    <th>Monto</th>
                    <th>Emisión R</th>
                    <th>Notificación R</th>
                    <th>Presunto</th>
                    <th>Resp</th>
                    <th>Estado</th>
                </tr>
            </tfoot>
          </table>
        </div>
    </div>    
</body>
</html>
