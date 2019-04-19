<?php 
session_start();
$direccion = $_REQUEST['direccion'];

    $entidad = $_REQUEST["entidad"];
    $_SESSION['entidad'] = $_REQUEST["entidad"];
?>

<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acciones</title>

    <link rel="stylesheet" href="css/acuerdoLista.css">

    <script type="text/javascript" src="entidadPresuntos.js"></script>

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
            <a href="#" class="logo">Información de <?php echo  $_SESSION['entidad']; ?>  </a>
		    <div class="navbarJuicios-right">
                <a href="javascript:cerrarlista()">Cerrar</a>
		    </div>
        </div>
        
        <div id = "contenedor">
            <p   id="xxx" name="xxx"><?php echo  $entidad ; ?></p>

          <table id="juicios" class="display" style="width:100%">
            <thead>
                <tr>
				    <th></th>
                    <th>Acción</th>
                    <th>Entidad</th>
                    <th>CP</th>
                    <th>Fondo</th>
                    <th>UAA</th>
                    <th>PO</th>
                    <th>Presunto Responsable</th>
                    <th>Cargo</th>
                    <th>Irregularidad</th>
                    <th>Trámite</th>
                    <th>Monto</th>
                    <th>clave</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Acción</th>
                    <th>Entidad</th>
                    <th>CP</th>
                    <th>Fondo</th>
                    <th>UAA</th>
                    <th>PO</th>
                    <th>Presunto Responsable</th>
                    <th>Cargo</th>
                    <th>Irregularidad</th>
                    <th>Trámite</th>
                    <th>monto</th>
                    <th>clave</th>

                </tr>
            </tfoot>
          </table>
        </div>
    </div>    
</body>
</html>
