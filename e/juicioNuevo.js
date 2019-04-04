function comprobarForma(form) {
	var mensaje = "Los campos marcados en color rojo son obligatorios";
	var error = 0;
	frm = document.forms[form];
	for(i=0; ele=frm.elements[i]; i++)
	{
		//elementos += " Nombre = "+ele.name+" | Tipo = "+ele.type+" | Valor = "+ele.value+"\n";
		if((ele.value == ' ' || ele.value == '' || ele.value == 'nada') && (ele.type != 'button' && ele.type != 'hidden' && ele.type != 'image') && (ele.disabled == false))
		{
			mensaje += '\n - '+ele.name;	
			document.getElementById(ele.name).style.borderColor = 'red';
			error++;	
		} 		
		if((ele.value != '') && (ele.type != 'button' && ele.type != 'hidden' && ele.type != 'image') && (ele.disabled == false))
			{document.getElementById(ele.name).style.borderColor = 'silver';
			}
	}
	if(error != 0) {
			$('#mensaje').text(mensaje);
			$('#ventanita').addClass("alert error");
			//alert(mensaje);
			return false;
	}
	else  {
		return true;
	}
}

$(document).ready(function() {
	$('#popup-overlay').fadeIn();
	$('#popup-overlay').height($(window).height());
	const procedimiento = document.getElementById('procedimiento');
	const alerta = document.getElementById('mensaje');

	procedimiento.focus();

	$("#inserta_juicio").click(function(){
		var datosUrl = $("#formita").serialize();
		if(comprobarForma("formita"))
		{
				$.ajax
				({
					beforeSend: function(objeto) {
					},
					complete: function(objeto, exito) {
					},
					type: "POST",
					url: "e/juicios_nuevo_v2.php",
					data: datosUrl,
					error: function(objeto, quepaso, otroobj) {
					//alert("Estas viendo esto por que fallé"); alert("Pasó lo siguiente: "+quepaso);
					},
					success: function(datos) {
						alerta.innerHTML = datos;
						$('#mensaje').text(datos);
						$('#ventanita').addClass("alert success");
						//document.forms["formita"].reset();
						$("#formita :input").prop('readonly', true);
						document.getElementById("inserta_juicio").disabled = true;
						document.getElementById('inserta_juicio').style.visibility = 'hidden';
						$("#fechanot").datepicker('disable');
						$("#vencimiento").datepicker().datepicker('disable');
						document.getElementById("dir").disabled = true;
						document.getElementById("sub").disabled = true;

					
					//alert(datos);
					//cerrarCuadro();
					}
				});
		}
	});

	$("#actor").autocomplete({
			source: function( request, response ) {
				$.ajax({
					beforeSend: function(objeto){ $('#idLoad').html('<img src="images/load_chico.gif">'); },
					type: "POST",
					url: "e/jsonActores.php",
					dataType: "json",
					data: {
						term: request.term, accion: $("#accion").val()
					},
					success: function( data ) {
						$('#idLoad').html('');
						console.info(data);
						response(data);
						}
					});
			},
		    select: function( event, ui )   {
					$("#cont").val(ui.item.cont);

				$("#monto").focus();
		  	}
	});

	$("#procedimiento").autocomplete({
		source: function( request, response ) {
			$.ajax({
				beforeSend: function(objeto){ $('#idLoad').html('<img src="images/load_chico.gif">'); },
				type: "POST",
				url: "e/jsonProcedimiento.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function( data ) {
					console.info(data);
					$('#idLoad').html('');
					response(data);
					}
				});
		},
		minLength: 2,
		select: function( event, ui )   {
			$("#accion").val(ui.item.accion);
			$("#entidad").val(ui.item.entidad);
			$("#juicionulidad").focus();
		  }
});


	$( "#fechanot" ).datepicker({
	  	dateFormat: "dd/mm/yy",
      	changeMonth: false,
      	numberOfMonths: 1,
	  	showAnim:'slideDown',
	  	beforeShowDay: noLaborales,
      	onClose: function(fecha, obj) {
		console.log(fecha)
		let buena = `${fecha.substr(3,2)}/${fecha.substr(0,2)}/${fecha.substr(6,4)}`;
		console.log(buena);
		let fecha1 = new  Date(buena);
		console.log(fecha1);
		let dias = 60;
		let diasMs = 1000*60*60*24*dias;
		let fecha2 = fecha1.getTime() + diasMs;
		let d = new Date(fecha2);
		console.log(d);

		let day = d.getDate()
		console.log("dia "+day);
        let month = d.getMonth() + 1
        let year = d.getFullYear()

        if(month < 10){
           d = `${day}/0${month}/${year}`
        }else{
           d=`${day}/${month}/${year}`
        }
		$("#vencimiento").val(d);   
	  }
	});
});


/*
jQuery(document).ready(function( $ ){
$(document).ready(function() {		
    $("#vencimiento").click(function(){
		let fecha1 = new  Date($("#fechanot").val());
		let dias = 60;
		let diasMs = 1000*60*60*24*dias;
		let fecha2 = fecha1.getTime() + diasMs;
		let d = new Date(fecha2);
		console.log(d);

		let day = d.getDate()
        let month = d.getMonth() + 1
        let year = d.getFullYear()

        if(month < 10){
           d = `${day}-0${month}-${year}`
        }else{
           d=`${day}-${month}-${year}`
        }
		$("#vencimiento").val(d);   
    });
});
*/

