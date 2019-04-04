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
        var textoCelda = document.createTextNode(person[x]==0?'-':person[x]);
        celda.appendChild(textoCelda);
        hilera.appendChild(celda);
    }
    tblBody.appendChild(hilera);
}


$(document).ready(function () {
    var data;
    var txt;
    var dataSentencia;
    var dataAmparo;
    var dataRecurso;
    var xProcedimiento;
    let f =new Date();
    // document.getElementById("fecha").innerHTML = f.getDate() + " / " + (f.getMonth() + 1) + " / " + f.getFullYear();

    $('#popup-overlay').fadeIn();
    $('#popup-overlay').height($(window).height());

    $.ajax({
        type: "GET",
          dataType: "json",
          url: 'p/jsonDesahogosProcedimiento.php',
          data: dataSentencia,
          success: function (dataSentencia) {
              const body = document.getElementById('resolucionesCP');
              var tabla   = document.createElement("table");
              encabezado(tabla, dataSentencia[0]);
              var tblBody = document.createElement("tbody");
              for (var i = 0; i < dataSentencia.length; i++) {
                  renglon(tblBody, dataSentencia[i]);
              };
              tabla.appendChild(tblBody);
              body.appendChild(tabla);
          }
      });
  

	$.ajax({
      type: "GET",
        dataType: "json",
        url: 'p/jsonDesahogosPR.php',
		data: dataSentencia,
		success: function (dataSentencia) {
            const body = document.getElementById('resoluciones');
            var tabla   = document.createElement("table");
            encabezado(tabla, dataSentencia[0]);
            var tblBody = document.createElement("tbody");
            for (var i = 0; i < dataSentencia.length; i++) {
                renglon(tblBody, dataSentencia[i]);
            };
            tabla.appendChild(tblBody);
            body.appendChild(tabla);
        }
	});


  
});
