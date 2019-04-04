function groupBy(list, keyGetter) {
    const map = new Map();
    list.forEach((item) => {
        const key = keyGetter(item);
        if (!map.has(key)) {
            map.set(key, [item]);
        } else {
            map.get(key).push(item);
        }
    });
    return map;
}

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
    var xProcedimiento;
    let f =new Date();
    // document.getElementById("fecha").innerHTML = f.getDate() + " / " + (f.getMonth() + 1) + " / " + f.getFullYear();


	$.ajax({
        type: "GET",
        dataType: "json",
        url: 'p/jsonPFRRtotales.php',
        data: data,
        success: function (data) {
              const body = document.getElementById('totales');
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


  



  
});
