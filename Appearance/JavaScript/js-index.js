
function enviaform(ruta){
	document.general.target = 'contenido';
	document.general.action=ruta;
	document.general.submit();
}	

function enviaform1(ruta){
	document.general.action=ruta;
	document.general.submit();
}

function enviaform2(ruta,oper){
	document.general.target = 'contenido';
	document.general.action=ruta;
	document.general.operacion.value=oper;
	document.general.submit();
}