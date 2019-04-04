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
        url: 'p/jsonPFRRcontrol.php',
        data: data,
        success: function (data) {
              const body = document.getElementById('procedimiento');
              var tabla   = document.createElement("table");
              encabezado(tabla, data[0]);
              var tblBody = document.createElement("tbody");
              for (var i = 0; i < data.length; i++) {
                  renglon(tblBody, data[i]);
              };
              tabla.appendChild(tblBody);
              body.appendChild(tabla);
        }
      });
    

	$.ajax({
        type: "GET",
          dataType: "json",
          url: 'p/jsonPFRRresponsables.php',
          data: dataSentencia,
          success: function (dataSentencia) {
              const body = document.getElementById('responsables');
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
