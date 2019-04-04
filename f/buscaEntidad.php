<?php ?> 
<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acciones</title>

    <link rel="stylesheet" href="css/buscaEntidad.css">
    <link rel="stylesheet" href="js/datatables/dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.4/css/buttons.dataTables.min.css"/>

    <script type="text/javascript" src="f/buscaEntidad.js"></script>

    <script>
        function cerrarlista() {
		    $("#grid-container").fadeOut();
		    $('#popup-overlay').fadeOut('slow');
        }
    </script>  
</head>

<body>
    <div id='altaOficio' style="display: none;"></div>
    <div id="popup-overlay"></div>

    <div class="grid-container" id="grid-container">
        <div class="navbarJuicios">
            <a href="#" class="logo">Buscar Entidad</a>
		    <div class="navbarJuicios-right">
                <a href="javascript:cerrarlista()">Cerrar</a>
		    </div>
        </div>
        
        <div class = "info">
            <p>hola</p>
            <form id="searchForm">
                <label for="entidad">Entidad:</label>
                <select name="entidad" id="entidad" >
                    <option value="Estado de México">Estado de México</option>;
                    <option value="Veracruz">Veracruz</option>;
                </select>
                <input type="button" class="boton" value="Buscar"  onclick="formaTabla()" />
            </form>
        </div>
    </div>    
</body>
</html>
