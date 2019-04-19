<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Busca entidad</title>
    <link rel="stylesheet" href="css/controlEntidad.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../js/datatables/dataTables.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="controlEntidad.js"></script>

    <script>
        function mostrarLista(pagina) {
            $("#mesa").css("width", "80%");
            $("#mesa").css("top", "3%");
            $("#mesa").css("height", "auto");

            $("#mesa").fadeIn();
            pagina = pagina + '?' + $(searchForm).serialize();
            console.log($(searchForm).serialize());
            console.log(pagina);
            $("#mesa").load(pagina);
        }
    </script>  
</head>

<body>
    <div id="fondo"></div>
    <div id='mesa' style="display: none;"></div>



<nav aria-label="breadcrumb">



    <div id="tablero">
        <div class="jaula">
            <div class="barra">


 <!--               <nav role="navigation">
                  <ul>
                    <li><a href="#">Información por Entidad</a></li>
                    <li><a href="#">Analisis</a>
                      <ul class="dropdown">
                        <li><a href="javascript:mostrarLista('accionesEntidad.php')">Entidad acciones</a></li>
                        <li><a href="javascript:mostrarLista('accionesPresuntoEntidad.php')">Entidad presuntos</a></li>
                        <li><a href="javascript:mostrarLista('accionesIR.php')">Irregularidad acciones</a></li>
                        <li><a href="javascript:mostrarLista('presuntosIrregularidad.php')">Irregularidad presuntos</a></li>
                      </ul>
                    </li>

                    <li><a href="#">x Entidad</a>
                      <ul class="dropdown">
                        <li><a href="javascript:mostrarLista('entidad.php')">Entidad acciones</a></li>
                        <li><a href="javascript:mostrarLista('entidadPresuntos.php')">Entidad presuntos</a></li>
                      </ul>
                    </li>

                    <li><a href="javascript:mostrarLista('dtns.php')">DTNS</a></li>
                    <li><a href="javascript:mostrarLista('desahogo.php')">Desahogo</a></li>
                    
                    <li><a href="#">Impugnados</a>
                      <ul class="dropdown">
                        <li><a href="javascript:mostrarLista('juicios.php')">Resolción Notificada</a></li>
                        <li><a href="javascript:mostrarLista('juiciosNew.php')">Juicios</a></li>
                        <li><a href="javascript:mostrarLista('rr.php')">Recursos de Reconsideración</a></li>
                      </ul>
                    </li>



                    <li><a href="javascript:cerrarCuadrito()">Cerrar</a></li>
                  </ul>
                </nav>
     -->          
             
                 
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Entidad</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Análisis
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="javascript:mostrarLista('accionesEntidad.php')">Entidad acciones</a>
          <a class="dropdown-item" href="javascript:mostrarLista('accionesPresuntoEntidad.php')">Entidad presuntos</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="javascript:mostrarLista('accionesIR.php')">Irregularidad acciones</a>
          <a class="dropdown-item" href="javascript:mostrarLista('presuntosIrregularidad.php')">Irregularidad presuntos</a>
        </div>
    </li>
    
 
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
            
            </div>

            <div class="info">
                <p>hola</p>
                <form id="searchForm">
                    <label for="entidad">Entidad:</label>

				    <input type="text"  size="35" id="entidad" name="entidad"  placeholder="indica una palabra y selecciona de la lista"></td>

<!--
                    <select name="entidad" id="entidad" >
                        <option value="Estado de México">Estado de México</option>;
                        <option value="Veracruz">Veracruz</option>;
                    </select>
                  
                    <input type="button" class="boton" value="Buscar"  onclick="formaTabla()" />
-->  
                    <input type="button" class="boton" id="kernel" name="kernel" value="Buscar" >

                </form>
                <div id="irregularidad"></div>
                <div id="irregularidadPresuntos"></div>
                <div id="cargo"></div>
                <div id="estado"></div>
                <div id="estadoPresuntos"></div>
            </div>



            <div class= "piePagina">
				        <p>ASF DGR ® Todos los derechos reservados</p>
	          </div>

        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script type="text/javascript" src="../js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script> 
    <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>

    <script src='../js/pdfmake.min.js'></script>
    <script src='../js/vfs_fonts.js'></script>


</body>
</thead>