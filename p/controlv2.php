<?php
    require_once 'database.php';
    require 'libreriaP.php';
    $db = new libreria();
    $sentencia = $db->getJCAcontrol02();
?>

<!DOCTYPE html>
<html lang="es">  
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Juicios Contenciosos Administrativos</title>
    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script> 
<script>

function encabezado(tabla, person) {
  var tbltHead = document.createElement("thead");
  var hilera = document.createElement("tr");
  for (var x in person) {
    var celda = document.createElement("th");
    var textoCelda = document.createTextNode(x);
    celda.appendChild(textoCelda);
    hilera.appendChild(celda);
  }
  tbltHead.appendChild(hilera);
  tabla.appendChild(tbltHead);
}

function renglon(tblBody, person) {
  let hilera = document.createElement("tr");
  for (var x in person) {
    var celda = document.createElement("td");
    var textoCelda = document.createTextNode(person[x]);
    celda.appendChild(textoCelda);
    hilera.appendChild(celda);
  }
  tblBody.appendChild(hilera);
}



  function get_table(data) {
    let result = ['<table border=1>'];
    for(let row of data) {
        result.push('<tr>');
        for(let cell of row){
            result.push(`<td>${cell}</td>`);
        }
        result.push('</tr>');
    }
    result.push('</table>');
    return result.join('\n');
  }

$(document).ready(function () {
    var data;
    var txt;
    var dataSentencia;
    var dataAmparo;
    var dataRecurso;
	$.ajax({
        type: "GET",
		dataType: "json",
		url: 'jsonJCAcontrol01.php',
		data: data,
		success: function (data) {
            const body = document.getElementById('notificacion');
            var tabla   = document.createElement("table");
            encabezado(tabla, data[0]);
            var tblBody = document.createElement("tbody");
            for (var i = 0; i < data.length; i++) {
                renglon(tblBody, data[i]);
            };
            tabla.appendChild(tblBody);
            body.appendChild(tabla);
            document.getElementById("resueltosN").innerHTML = Number(data[0].juicios) + Number(data[1].juicios) ;
            document.getElementById("sustanciandoseN").innerHTML = Number(data[2].juicios);
        }
	});

	$.ajax({
        type: "GET",
		dataType: "json",
		url: 'jsonJCAcontrol02.php',
		data: dataSentencia,
		success: function (dataSentencia) {
            const body = document.getElementById('sentencia');
            var tabla   = document.createElement("table");
            encabezado(tabla, dataSentencia[0]);
            var tblBody = document.createElement("tbody");
            for (var i = 0; i < dataSentencia.length; i++) {
                renglon(tblBody, dataSentencia[i]);
            };
            tabla.appendChild(tblBody);
            body.appendChild(tabla);
            document.getElementById("resueltosS").innerHTML = Number(dataSentencia[0].Reporte) + Number(dataSentencia[1].Reporte) 
            + Number(dataSentencia[0].a2018) + Number(dataSentencia[1].a2018)
            + Number(dataSentencia[0].a2019) + Number(dataSentencia[1].a2019);
            document.getElementById("sustanciandoseS").innerHTML = Number(dataSentencia[2].juicios);
        }
	});

	$.ajax({
        type: "GET",
		dataType: "json",
		url: 'jsonJCAcontrol03.php',
		data: dataAmparo,
		success: function (dataAmparo) {
            const body = document.getElementById('amparo');
            var tabla   = document.createElement("table");
            encabezado(tabla, dataAmparo[0]);
            var tblBody = document.createElement("tbody");
            for (var i = 0; i < dataAmparo.length; i++) {
                renglon(tblBody, dataAmparo[i]);
            };
            tabla.appendChild(tblBody);
            body.appendChild(tabla);
            document.getElementById("resueltosAD").innerHTML = Number(dataAmparo[0].Reporte) + Number(dataAmparo[1].Reporte) 
            + Number(dataAmparo[0].a2018) + Number(dataAmparo[1].a2018)
            + Number(dataAmparo[0].a2019) + Number(dataAmparo[1].a2019);
            document.getElementById("sustanciandoseAD").innerHTML = Number(dataAmparo[2].juicios);
        }
	});


	$.ajax({
        type: "GET",
		dataType: "json",
		url: 'jsonJCAcontrol04.php',
		data: dataRecurso,
		success: function (dataRecurso) {
            const body = document.getElementById('recurso');
            var tabla   = document.createElement("table");
            encabezado(tabla, dataRecurso[0]);
            var tblBody = document.createElement("tbody");
            for (var i = 0; i < dataRecurso.length; i++) {
                renglon(tblBody, dataRecurso[i]);
            };
            tabla.appendChild(tblBody);
            body.appendChild(tabla);
            document.getElementById("resueltosRF").innerHTML = Number(dataRecurso[0].Reporte) + Number(dataRecurso[2].Reporte) 
            + Number(dataRecurso[0].a2018) + Number(dataRecurso[2].a2018)
            + Number(dataRecurso[0].a2019) + Number(dataRecurso[2].a2019);
            document.getElementById("sustanciandoseRF").innerHTML = Number(dataRecurso[1].juicios) + Number(dataRecurso[3].juicios);
        }
	});




});

/*
                var tbltHead = document.createElement("thead");
                encabezado(tbltHead, data[0]);
                tabla.appendChild(tbltHead);

*/
</script>

</head>

<main>
    <div class="table-wrapper" tabindex="0">
        <h2>Juicios contenciosos administrativos notificados</h2>
        <table>
            <tbody>
                <tr>
                    <td>Juicios administrativos contenciosos notificados</td>
                    <td id="resueltosN"></td>
                </tr>
                <tr>
                    <td>Juicios administrativos contenciosos sustanciándose</td>
                    <td id="sustanciandoseN"></td>
                </tr>
            </tbody>
        </table>
        <h3>Notificados</h3>
        <div id="notificacion"></div>

        <h2>Juicios contenciosos administrativos con fecha de sentencia</h2>
        <table>
            <tbody>
                <tr>
                    <td>Juicios administrativos contenciosos resueltos</td>
                    <td id="resueltosS"></td>
                </tr>
                <tr>
                    <td>Juicios administrativos contenciosos sustanciándose</td>
                    <td id="sustanciandoseS"></td>
                </tr>
            </tbody>
        </table>
        <h3>Con fecha de sentencia</h3>
        <div id="sentencia"></div>

        <h2>Amparos Directos</h2>
        <table>
            <tbody>
                <tr>
                    <td>Juicios de amparos resueltos</td>
                    <td id="resueltosAD"></td>
                </tr>
                <tr>
                    <td>Juicios de amparos sustanciándose</td>
                    <td id="sustanciandoseAD"></td>
                </tr>
            </tbody>
        </table>
        <h3>Con amparo directo</h3>
        <div id="amparo"></div>

        <h2>Recursos de Revisión Fiscal</h2>
        <table>
            <tbody>
                <tr>
                    <td>Recursos de revisión fiscal resueltos</td>
                    <td id="resueltosRF"></td>
                </tr>
                <tr>
                    <td>Recursos de revisión fiscal sustanciándose</td>
                    <td id="sustanciandoseRF"></td>
                </tr>
            </tbody>
        </table>
        <h3>Con recurso de revisión fiscal</h3>
        <div id="recurso"></div>


    </div>
  
  </main>

<style>
/* basic styles */
body, input, textarea, select, option, button, label {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Droid Sans", "Helvetica Neue", sans-serif;
  font-size: 100%;
}
main {
    padding: 1em;
  }
  
  .table-wrapper {
    overflow: auto;
      max-width: 100%;
      background:
          linear-gradient(to right, white 30%, rgba(255,255,255,0)),
          linear-gradient(to right, rgba(255,255,255,0), white 70%) 0 100%,
          radial-gradient(farthest-side at 0% 50%, rgba(0,0,0,.2), rgba(0,0,0,0)),
          radial-gradient(farthest-side at 100% 50%, rgba(0,0,0,.2), rgba(0,0,0,0)) 0 100%;
      background-repeat: no-repeat;
      background-color: white;
      background-size: 40px 100%, 40px 100%, 14px 100%, 14px 100%;
    background-position: 0 0, 100%, 0 0, 100%;
      background-attachment: local, local, scroll, scroll;
  }
  
  tr {
    border-bottom: 1px solid;
  }
  
  th {
    background-color: #555;
    color: #fff;
    white-space: nowrap;
  }
  
  th,
  td {
    text-align: left;
    padding: 0.5em 1em;
  }
  
  .numeric {
    text-align: right;
  }
  
  p {
    text-align: left;
    margin-top: 1em;
    font-style: italic;
  }

  tr:nth-child(odd) {
  background-color: #eee;
}

</style>