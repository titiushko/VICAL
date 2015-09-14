/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*								calcular el monto y total								*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
var precio = 1.2;	//precio unitario
var BotellaTotal_cantidad = 0;
var BotellaTotal_monto = 0;
var PlanoTotal_cantidad = 0;
var PlanoTotal_monto = 0;
var TotalCantidad = 0;
var TotalMonto = 0;
var cantidad = 0;
var monto = 0;
var formulario = "";
var elemento_cantidad = "";
var elemento_precio = "";
//------------------------------------------------------------------------------------
//					calcular el monto de cada vidrio y los totales
//------------------------------------------------------------------------------------
function iniciarElementos(F,elemento1,elemento2){
	formulario = eval("document." + F);
	elemento_cantidad = eval("document." + F + "." + elemento1);
	elemento_precio = eval("document." + F + "." + elemento2);
}
function calculoUnitario(F,elemento1,elemento2){
	iniciarElementos(F,elemento1,elemento2);
	cantidad = 0;	monto = 0;
	if(elemento_cantidad.value != ""){
		cantidad = parseFloat(elemento_cantidad.value);
		monto 	 = cantidad * precio;		
		elemento_cantidad.value = redondear(cantidad,2);
		elemento_precio.value 	= redondear(monto,2);
	}
	else
		elemento_precio.value = "";
}
function calcularMonto(F,elemento1,elemento2){
	iniciarElementos(F,elemento1,elemento2);
	
	if(elemento_cantidad.value != ""){
		calculoUnitario(F,elemento1,elemento2);
		
		//calcular el total de las botellas en cantidad y monto
		if(elemento1[0] == 'B' && elemento2[0] == 'B'){			
			BotellaTotal_cantidad += cantidad;
			BotellaTotal_monto += monto;
			formulario.BTo1.value = redondear(BotellaTotal_cantidad,2);
			formulario.BTo2.value = redondear(BotellaTotal_monto,2);
			TotalCantidad += BotellaTotal_cantidad;
			TotalMonto += BotellaTotal_monto;
		}		
		//calcular el total de planos en cantidad y monto
		if(elemento1[0] == 'P' && elemento2[0] == 'P'){
			PlanoTotal_cantidad += cantidad;
			PlanoTotal_monto += monto;
			formulario.PTo1.value = redondear(PlanoTotal_cantidad,2);
			formulario.PTo2.value = redondear(PlanoTotal_monto,2);
			TotalCantidad += PlanoTotal_cantidad;
			TotalMonto += PlanoTotal_monto;
		}		
		//formulario.TOTAL1.value = TotalCantidad;
		//formulario.TOTAL2.value = TotalMonto;
	}
	//formulario.elements[indice+2].focus();
}
//------------------------------------------------------------------------------------
//								pone los valores a cero
//------------------------------------------------------------------------------------
function reestablecer(){
	BotellaTotal_cantidad = 0;
	BotellaTotal_monto = 0;
	PlanoTotal_cantidad = 0;
	PlanoTotal_monto = 0;
	TotalCantidad = 0;
	TotalMonto = 0;
	formulario = "";
	elemento_cantidad = "";
	elemento_precio = "";
}
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*							fin calcular el monto y total								*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

//------------------------------------------------------------------------------------
//							muestra los codigos y los nombres
//------------------------------------------------------------------------------------
//recolectores
function ponerCodRecolector(F){
	for(i=0; i<recolectores.length; i++)//buscar en el vector el nombre del recolector seleccionado en la lista nombre_recolector
		if(recolectores[i][1] == F.nombre_recolector.value)
			for(j=0; j<recolectores.length; j++)//se encontro el nombre del recolector, con el indice "i" se busca el codigo del recolector en la lista codigo_recolector
				if(recolectores[i][0] == F.codigo_recolector.options[j].text)//se encontro el codigo del recolector, con el infice "j" se selecciona el codigo del recolector en la lista codigo_recolector
					F.codigo_recolector.selectedIndex = j;
}
function ponerNomRecolector(F){
	for(i=0; i<recolectores.length; i++)
		if(recolectores[i][0] == F.codigo_recolector.value)
			for(j=0; j<recolectores.length; j++)
				if(recolectores[i][1] == F.nombre_recolector.options[j].text)
					F.nombre_recolector.selectedIndex = j;
}
//proveedores
function ponerCodProveedor(F){
		for(i=0; i<proveedores.length; i++)
		if(proveedores[i][1] == F.nombre_proveedor.value)
			for(j=0; j<proveedores.length; j++)
				if(proveedores[i][0] == F.codigo_proveedor.options[j].text)
					F.codigo_proveedor.selectedIndex = j;
}
function ponerNomProveedor(F){
	for(i=0; i<proveedores.length; i++)
		if(proveedores[i][0] == F.codigo_proveedor.value)
			for(j=0; j<proveedores.length; j++)
				if(proveedores[i][1] == F.nombre_proveedor.options[j].text)
					F.nombre_proveedor.selectedIndex = j;
}
//------------------------------------------------------------------------------------
//								redireccionar a una pagina
//------------------------------------------------------------------------------------
function redireccionar(direccion){location.href = direccion;}
//------------------------------------------------------------------------------------
//					redondear a la cantidad de decimales que se le pide
//------------------------------------------------------------------------------------
function redondear(valor, numero_decimales){
	var numero = parseFloat(valor);
	var formato = "0.00";
	if (!isNaN(numero)){
		numero = Math.round(numero * Math.pow(10, numero_decimales)) / Math.pow(10, numero_decimales);
		formato = String(numero);
		formato += (formato.indexOf(".") == -1? ".": "") + String(Math.pow(10, numero_decimales)).substr(1);
		formato = formato.substr(0, formato.indexOf(".") + numero_decimales + 1);
	}
	return formato;
}
//------------------------------------------------------------------------------------
//								calcular la fecha actual
//------------------------------------------------------------------------------------
function fechaActual(){	
	var fecha_actual = new Date();
	var dia = fecha_actual.getDate();
	var mes = fecha_actual.getMonth() + 1;
	var anio = fecha_actual.getFullYear();
	if (mes < 10) mes = '0' + mes;
	if (dia < 10) dia = '0' + dia;
	return (anio + "-" + mes + "-" + dia);
}
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*						validar los caracteres en los campos							*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
//------------------------------------------------------------------------------------
//							aceptar solo letras de A-Z, a-z
//------------------------------------------------------------------------------------
function soloLetras(elEvento){
	// Obtener la tecla pulsada 
	var evento = elEvento || window.event;
	var codigoCaracter = evento.charCode || evento.keyCode;
	
	// Permitir utilizar las teclas con Flecha Horizontal
	if(codigoCaracter == 37 || codigoCaracter == 39){
		return true;
	}
	
	// Permitir borrar con la tecla Backspace y con la tecla Supr
	if(codigoCaracter == 8 || codigoCaracter == 46){
		return true;
	}
	
	// Permitir utilizar la tecla Tab
	if(codigoCaracter == 9){
		return true;
	}
	
	// Permitir utilizar la tecla Espaciadora
	if(codigoCaracter == 32){
		return true;
	}
	
	// Permitir utilizar la tecla Enter
	if(codigoCaracter == 13){
		return true;
	}
	
	// Permitir utilizar las teclas A - Z y de a - z
	if (!(codigoCaracter==32 || (codigoCaracter >= 65 && codigoCaracter <= 90) || (codigoCaracter >= 97 && codigoCaracter <= 122))){
		//alert("Solo se permiten LETRAS en este campo.");
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							aceptar solo numeros de 0-9
//------------------------------------------------------------------------------------
function soloNumeros(elEvento){
	// Obtener la tecla pulsada 
	var evento = elEvento || window.event;
	var codigoCaracter = evento.charCode || evento.keyCode;
	
	// Permitir utilizar las teclas con Flecha Horizontal
	if(codigoCaracter == 37 || codigoCaracter == 39){
		return true;
	}
	
	// Permitir borrar con la tecla Backspace
	if(codigoCaracter == 8){
		return true;
	}
	
	// Permitir utilizar la tecla Tab
	if(codigoCaracter == 9){
		return true;
	}
	
	// Permitir utilizar las teclas 0 - 9
	if (!((codigoCaracter >= 48 && codigoCaracter <= 57))){
		//alert("Solo se permiten NUMEROS en este campo.");
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//						aceptar solo numeros de 0-9 y el punto
//------------------------------------------------------------------------------------
function soloNumerosFloat(elEvento){
	// Obtener la tecla pulsada 
	var evento = elEvento || window.event;
	var codigoCaracter = evento.charCode || evento.keyCode;
	
	// Permitir utilizar las teclas con Flecha Horizontal
	if(codigoCaracter == 37 || codigoCaracter == 39){
		return true;
	}
	
	// Permitir borrar con la tecla Backspace y con la tecla Supr
	if(codigoCaracter == 8 || codigoCaracter == 46){
		return true;
	}
	
	// Permitir utilizar la tecla Tab
	if(codigoCaracter == 9){
		return true;
	}
	
	// Permitir utilizar las teclas 0 - 9
	if (!((codigoCaracter >= 48 && codigoCaracter <= 57))){
		//alert("Solo se permiten NUMEROS en este campo.");
		return false;
	}
	return true;
}
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*						fin validar los caracteres en los campos						*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

//------------------------------------------------------------------------------------
//					pasar al siguiente campo cuando llegue a su limite
//------------------------------------------------------------------------------------
function autoTab(thisval,fname, flen){
	var fieldname = eval("document.formulario." + fname);
	
	if(thisval != 9 && thisval != 16){
		if(fieldname.value.length <= flen){
			fieldname.focus();
		}
		else{
			for(x=0; x<document.formulario.elements.length; x++){
				if(fieldname.name == document.formulario.elements[x].name){
				var nextfield = x + 1;
				}
			}
			document.formulario.elements[nextfield].focus();
		}
	}
}
//------------------------------------------------------------------------------------
//					limita la cantidad de caracteres en un campo
//------------------------------------------------------------------------------------
function limita(elEvento, maximoCaracteres){
	var elemento = document.getElementById("maximo");

	// Obtener la tecla pulsada 
	var evento = elEvento || window.event;
	var codigoCaracter = evento.charCode || evento.keyCode;
	
	// Permitir utilizar las teclas con flecha horizontal
	if(codigoCaracter == 37 || codigoCaracter == 39){
		return true;
	}

	// Permitir borrar con la tecla Backspace y con la tecla Supr.
	if(codigoCaracter == 8 || codigoCaracter == 46){
		return true;
	}
	else if(elemento.value.length >= maximoCaracteres ){
		return false;
	}
	else {
		return true;
	}
}
//------------------------------------------------------------------------------------
//					tooltip: muestra mensajitos flotantes (viñetas)
//------------------------------------------------------------------------------------
var objeto = "";
function toolTip(mensaje,elemento) {
	objeto = elemento;
	objeto.onmousemove = actualizaPosicion;
	document.getElementById('toolTipBox').innerHTML = mensaje;
	document.getElementById('toolTipBox').style.display = "block";
	window.onscroll = actualizaPosicion;
}
function actualizaPosicion() {
	var evento = arguments[0]?arguments[0]:event;
	var x = evento.clientX;
	var y = evento.clientY;
	posicionX = 24;
	posicionY = 0;
	document.getElementById('toolTipBox').style.top  = y-2+posicionY+document.body.scrollTop+ "px";
	document.getElementById('toolTipBox').style.left = x-2+posicionX+document.body.scrollLeft+"px";
	objeto.onmouseout = ocultarMensaje;
}
function ocultarMensaje() {
	document.getElementById('toolTipBox').style.display = "none";
}