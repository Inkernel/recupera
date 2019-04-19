<?php 
$direccion = $_REQUEST['direccion'];

    $entidad = $_REQUEST["entidad"];
?>

<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acciones</title>

    <link rel="stylesheet" href="css/acuerdoLista.css">

    <script type="text/javascript" src="presuntosIrregularidad.js"></script>

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
            <a href="#" class="logo">Información de <?php echo  $entidad . $direccion ; ?>  </a>
		    <div class="navbarJuicios-right">
                <a href="javascript:cerrarlista()">Cerrar</a>
		    </div>
        </div>
        
        <div id = "contenedor">
          <table id="juicios" class="display" style="width:100%">
            <thead>
                <tr>
				    <th></th>
                    <th>num_accion</th>
                    <th>entidad</th>
                    <th>nombre</th>
                    <th>cargo</th>
                    <th>dependencia</th>
                    <th>tipo</th>
                    <th>monto</th>
                    <th>resarcido</th>
                    <th>status</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th></th>
                    <th>num_accion</th>
                    <th>entidad</th>
                    <th>nombre</th>
                    <th>cargo</th>
                    <th>dependencia</th>
                    <th>tipo</th>
                    <th>monto</th>
                    <th>resarcido</th>
                    <th>status</th>
                </tr>
            </tfoot>
          </table>
        </div>
    </div>    
</body>
</html>