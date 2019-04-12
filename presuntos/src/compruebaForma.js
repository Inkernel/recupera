export function comprobarForma(form) {
	var mensaje = "Los campos marcados en color rojo son obligatorios: ";
	var error = 0;
	var frm = document.forms[form];
	var i;
	var ele = "";

	for(i=0; ele=frm.elements[i]; i++) {

		if((ele.value == ' ' || ele.value == '' || ele.value == 'nada') && (ele.type != 'button' && ele.type != 'hidden' && ele.type != 'image') && (ele.disabled == false))
		{
			mensaje += ele.name + ', ';	
			document.getElementById(ele.name).style.borderColor = 'red';
			console.log(ele.name + ' <- red');
			error++;	
		} 		
		if((ele.value != '') && (ele.type != 'button' && ele.type != 'hidden' && ele.type != 'image') && (ele.disabled == false))
			{document.getElementById(ele.name).style.borderColor = 'silver';
			console.log(ele.name + ' <- silver');
			}
	}
	if(error != 0) {
			$('#mensaje').text(mensaje);
			$('#ventanita').addClass("alert error");
			return false;
	}
	else  {
		return true;
	}
}