<?php
	session_start();
	// require_once("../includes/clases.php");
	require_once("../includes/funciones.php");
	require_once('../includes/database.php');
	require 'libreria.php';

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$direccion = $_SESSION['direccion'];
	$nivel = $_SESSION['nivel'];
	$usuario = $_SESSION['usuario'];

	/*
	$query = "SELECT * FROM usuarios WHERE usuario LIKE '%".$usuario."%' ";
	$sql = $conexion->select($query,false);
	$r = mysql_fetch_array($sql);

	*/

	$procedimiento = "";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="css/juiciosNuevo.css">
	<script src='e/juicioNuevo.js'></script>

	<script>
		function cerrarCuadrito() {
			$("#altaOficio").fadeOut();
			$('#popup-overlay').fadeOut('slow');
		}
	</script>

</head>

<body>
	<div class="navbar">
		<a href="#" class="logo">Alta de Juicio Contencioso Administrativo</a>
		<div class="navbar-right">
		<a href="javascript:cerrarCuadrito()"><i class="material-icons">close</i></a>
		</div>
	</div>

	<form name= "formita" id="formita">
		<div id ="ventanita" class="alert">
	 		<p id="mensaje"><p>
		</div>
		<table>
          	<tr>
		    	<td class="juicio-etiqueta ">Procedimiento</td>
            	<td><input type="text" class="redonda5 "  id="procedimiento" name="procedimiento" size="35" required></td>
				<td class="juicio-etiqueta ">Acción</td>
            	<td><input type="text" class="juicio-sinborde" id="accion" name="accion" value = "" readonly></td>
          	</tr>      
         
		 	<tr>
				<td style="empty-cells: show"></td>
				<td style="empty-cells: show"></td>
      		 	<td class="juicio-etiqueta ">Entidad o Dependencia</td>
            	<td><input type="text" class="juicio-sinborde" size="35" id="entidad" name="entidad" maxlength="100"/ readonly></td>
          	</tr>

			<tr>
				<td class="juicio-etiqueta">Juicio Contencioso</td>
            	<td><input type = "text" name="juicionulidad" id="juicionulidad" size="35" class="juicio-redonda "></td>
          	</tr> 

          	<tr>
            	<td class="juicio-etiqueta ">Sala del Conocimiento</td>
            	<td><input type="text" size="35" id="salaconocimiento" name="salaconocimiento" class="juicio-redonda"></td>
          	</tr>

          	<tr>
            	<td class="juicio-etiqueta ">Actor</td>
				<td><input type="text" class="juicio-redonda "  size="35" id="actor" name="actor" maxlength="100" placeholder="indica una palabra y selecciona de la lista"></td>
				<td><input type="text" class="juicio-sinborde" id="cont" name="cont" value = "" readonly></td>
          	</tr>

          	<tr>	
	            <td class="juicio-etiqueta ">Monto</td>
            	<td><input type="number" class="juicio-redonda " size="35" id="monto" min="0" name="monto" maxlength="12" /></td>
	        </tr>

          	<tr>
            	<td class="juicio-etiqueta ">Fecha Notificacion</td>
            	<td><input type="text" class="juicio-redonda " size="35" id="fechanot" name="fechanot"/></td>
				
				<td class="juicio-etiqueta ">Vencimiento</td>
           		<td><input type="text" class="juicio-sinborde" size="35" id="vencimiento" name="vencimiento" readonly></td>
          	</tr>

          	<tr>
				<td class="juicio-etiqueta ">Dirección de Origen</td>
				<td>
					<select name="dir" id="dir" class="juicio-redonda ">
                    <option value="A" selected="selected">Nelly Zulema Sánchez Cruz</option>

					<?php
						$sql = "SELECT * FROM usuarios WHERE nivel like '%A%' AND puesto = 'Director de Área' AND status != '0' ORDER BY nivel";
						$sqlv = $pdo->prepare($sql);
						$sqlv->execute();
						$r = $sqlv->fetch(PDO::FETCH_ASSOC);
						echo '<option value="'.$r['nivel'].'">'.$r['nombre'].'</option>';
                 	?> 
					</select>
            	</td>
          	</tr>

		 	<tr>
           		<td class="juicio-etiqueta ">Subdirector</td>
            	<td>
				<select name="sub" id="sub" class="juicio-redonda ">
                <option value="" selected="selected">Elegir</option>

				
				 <?php
					$sql = "SELECT * FROM usuarios WHERE LENGTH(nivel) = 3 AND nivel like '%A%' ORDER BY nivel";
					$sqlv = $pdo->prepare($sql);
					$sqlv->execute();
					$resultado = $sqlv->fetchAll();
					foreach ($resultado as $row => $r) {
					echo '<option value="'.$r['nivel'].'">'.$r['nombre'].'</option>';
					}
				?>
				 
				</select>
				</td> 
          	</tr>


            <tr>
				<td colspan="4"><br>
				<input type="hidden" name="nom" id="nom" value="<?php echo $r['nombre']; ?>">
				<input type="button" class="boton" name="inserta_juicio" id="inserta_juicio" value="Insertar nuevo Juicio">
				</td>
	    	</tr>

		</table>
	</form>
</body>
