<?php ?> 
<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acuerdos de Inicio</title>

    <link rel="stylesheet" href="css/resolucionesCP.css">
    <link rel="stylesheet" href="js/datatables/dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css"/>

    <script type="text/javascript" src="p/tablas.js"></script>

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
            <a href="#" class="logo">Fincamiento de Responsabilidades Resarcitorias</a>
		    <div class="navbarJuicios-right">
                <a href="javascript:cerrarlista()">Cerrar</a>
		    </div>
        </div>



        <div class="info">
                <div class="tablita" tabindex="0">
                <h2>1</h2>
                </div>
            </div>

            <div class="item3">
                <div class="tablita" tabindex="0">

                <h2>Fincamiento de Responsabilidades Resarcitorias</h2>
                </div>
            </div>

            <div class="item4"> 



                <div class="tablita" tabindex="0">
                    <h3>por Procedimiento</h3>
                    <div id="procedimiento"></div>
                </div>
                <p> </p>

                <div>

                <div class="tablita" tabindex="0">
                    <h3>por Presunto Responsable</h3>
                    <div id="responsables"></div>
                </div>
                <p> </p>


            </div>

    </div>    
</body>
</html>
