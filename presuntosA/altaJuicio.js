function comprobarForma(form) {
	var mensaje = "Los campos marcados en color rojo son obligatorios";
	var error = 0;
	frm = document.forms[form];
	for(i=0; ele=frm.elements[i]; i++) {
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
	const accion = document.getElementById('accion').value;
	const procedimiento = document.getElementById('procedimiento').value;
	const actor = document.getElementById('actor').value;
	const cont = document.getElementById('idPresunto').value;
	const alerta = document.getElementById('mensaje');
	var valor = $("#llave").val();
	//Swal.fire('Funciona  esta madre');

	const juicionulidad = document.getElementById('juicionulidad');
    juicionulidad.focus();

/*
    if (valor === undefined || valor == null || valor.length === 0 || valor === "" ) {
    //if(Boolean(valor)){
        alert($("damos alta").val());
        console.log($("#llave").val());
    } else {
        alert("ya tiene asignado un juicio este presunto para este procedimiento");
        console.log($("#llave").val()+" qe pasa");
        
    }
*/
	$("#inserta_juicio").click(function(){
        var datosUrl =  "accion=" + accion  + "&" + "procedimiento=" + procedimiento  + "&" +
        "actor=" + actor + "&" + "cont=" + cont + "&" +  $("#forma").serialize();
        console.log(datosUrl);
		if(comprobarForma("forma"))
		{
				$.ajax
				({
					beforeSend: function(objeto) {
					},
					complete: function(objeto, exito) {
					},
					type: "POST",
					url: "presuntos/altaJuicioInserta.php",
					data: datosUrl,
					error: function(objeto, quepaso, otroobj) {
					},
					success: function(datos) {
						alerta.innerHTML = datos;
						$('#mensaje').text(datos);
						$('#ventanita').addClass("alert success");
						//document.forms["forma"].reset();
						$("#forma :input").prop('readonly', true);
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

