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
    document.getElementById("fecha").innerHTML = f.getDate() + " / " + (f.getMonth() + 1) + " / " + f.getFullYear();


	$.ajax({
      type: "GET",
      dataType: "json",
      url: 'p/jsonJCAcontrol.php?p=getJCAcontrol01',
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
      }
	});

	$.ajax({
      type: "GET",
        dataType: "json",
        url: 'p/jsonJCAcontrol.php?p=getJCAcontrol02',
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
            document.getElementById("resueltosS").innerHTML = Number(dataSentencia[0].previo) + Number(dataSentencia[1].previo) 
            + Number(dataSentencia[0].a2018) + Number(dataSentencia[1].a2018)
            + Number(dataSentencia[0].a2019) + Number(dataSentencia[1].a2019);
            document.getElementById("sustanciandoseS").innerHTML = Number(dataSentencia[2].juicios);
        }
	});

	$.ajax({
        type: "GET",
		dataType: "json",
        url: 'p/jsonJCAcontrol03.php',
        url: 'p/jsonJCAcontrol.php?p=getJCAcontrol03',
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
            document.getElementById("resueltosAD").innerHTML = Number(dataAmparo[0].previo) + Number(dataAmparo[1].previo) 
            + Number(dataAmparo[0].a2018) + Number(dataAmparo[1].a2018)
            + Number(dataAmparo[0].a2019) + Number(dataAmparo[1].a2019);
            document.getElementById("sustanciandoseAD").innerHTML = Number(dataAmparo[2].juicios);
        }
	});


	$.ajax({
      type: "GET",
      dataType: "json",
      url: 'p/jsonJCAcontrol.php?p=getJCAcontrol04',
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
            document.getElementById("resueltosRF").innerHTML = Number(dataRecurso[0].previo) + Number(dataRecurso[1].previo) 
            + Number(dataRecurso[0].a2018) + Number(dataRecurso[1].a2018)
            + Number(dataRecurso[0].a2019) + Number(dataRecurso[1].a2019);
            document.getElementById("sustanciandoseRF").innerHTML = Number(dataRecurso[2].juicios);
      }
  });

  $.ajax({
    type: "GET",
    dataType: "json",
    contentType: 'json',
    url: 'p/jsonJCAxProcemiento.php',
    data: xProcedimiento,
    success: function (xProcedimiento) {
        const pets = [
            {type:"Dog", name:"Spot"},
            {type:"Cat", name:"Tiger"},
            {type:"Dog", name:"Rover"}, 
            {type:"Cat", name:"Leo"}
        ];
        
        const grouped = groupBy(xProcedimiento, pro => pro.resultado);
        document.getElementById("pDes").innerHTML = Number(grouped.get("favorable").length);
        document.getElementById("pFav").innerHTML = Number(grouped.get("desfavorable").length);
        document.getElementById("pTra").innerHTML = Number(grouped.get("trámite").length);
        document.getElementById("pTot").innerHTML = Number(xProcedimiento.length);
        // console.log(grouped.get("favorable").length);
        // console.log(Array.from(grouped));
    }
});

  
});
