//------------------------------------------------------------------------------------
//								calcular el monto y total
//------------------------------------------------------------------------------------
function calcularMonto(){
with (document.forms["formulario"]){
	var totalBc1,totalBc2,totalBc3,totalPc1,totalPc2,totalPc3;
	
	totalBc1 = Number(Bc1.value)*precio;
	if(Bc1.value != "") {Bc1.value = redondear(Bc1.value,2); Bp1.value = redondear(totalBc1,2);}
	else Bp1.value = "";
	Vc1.value = Bc1.value;	//cantidad botella clara
	Vp1.value = Bp1.value;	//precio botella clara
	
	totalBc2 = Number(Bc2.value)*precio;
	if(Bc2.value != "") {Bc2.value = redondear(Bc2.value,2); Bp2.value = redondear(totalBc2,2);}
	else Bp2.value = "";
	Vc2.value = Bc2.value;	//cantidad botella verde
	Vp2.value = Bp2.value;	//precio botella verde
	
	totalBc3 = Number(Bc3.value)*precio;
	if(Bc3.value != "") {Bc3.value = redondear(Bc3.value,2); Bp3.value = redondear(totalBc3,2);}
	else Bp3.value = "";
	Vc3.value = Bc3.value;	//cantidad botella cafe
	Vp3.value = Bp3.value;	//precio botella cafe
	
	//para plano
	totalPc1 = Number(Pc1.value)*precio;
	if(Pc1.value != "") {Pc1.value = redondear(Pc1.value,2); Pp1.value = redondear(totalPc1,2);}
	else Pp1.value = "";
	Vc4.value = Pc1.value;	//cantidad plano claro
	Vp4.value = Pp1.value;	//precio plano claro
	
	totalPc2 = Number(Pc2.value)*precio;
	if(Pc2.value != "") {Pc2.value = redondear(Pc2.value,2); Pp2.value = redondear(totalPc2,2);}
	else Pp2.value = "";
	Vc5.value = Pc2.value;	//cantidad plano bronce
	Vp5.value = Pp2.value;	//precio plano bronce
	
	totalPc3 = Number(Pc3.value)*precio;
	if(Pc3.value != "") {Pc3.value = redondear(Pc3.value,2); Pp3.value = redondear(totalPc3,2);}
	else Pp3.value = "";
	Vc6.value = Pc3.value;	//cantidad plano reflectivo
	Vp6.value = Pp3.value;	//precio plano reflectivo
	
	//totales
	var totalCantidadBotella = Number(Bc1.value)+Number(Bc2.value)+Number(Bc3.value);
	if(totalCantidadBotella == 0.0) TBc.value = "";
	else TBc.value = redondear(totalCantidadBotella,2);
	BTc.value = TBc.value;	//cantidad botella total
	
	var totalMontoBotella = Number(Bp1.value)+Number(Bp2.value)+Number(Bp3.value);
	if(totalMontoBotella == 0.0) TBp.value = "";
	else TBp.value = redondear(totalMontoBotella,2);
	BTp.value = TBp.value;	//precio botella total
	
	var totalCantidadPlano = Number(Pc1.value)+Number(Pc2.value)+Number(Pc3.value);
	if(totalCantidadPlano == 0.0) TPc.value = "";
	else TPc.value = redondear(totalCantidadPlano,2);
	PTc.value = TPc.value;	//cantidad plano total
	
	var totalMontoPlano = Number(Pp1.value)+Number(Pp2.value)+Number(Pp3.value);
	if(totalMontoPlano == 0.0) TPp.value = "";
	else TPp.value = redondear(totalMontoPlano,2);
	PTp.value = TPp.value;	//precio plano total
	}
}
//------------------------------------------------------------------------------------
//								cambiar el precio unitario
//------------------------------------------------------------------------------------
function cambiarPrecio(indice){
	precio = precios[indice];
	calcularMonto();
}
//------------------------------------------------------------------------------------
//					muestra los codigos de los recolectores y proveedores
//------------------------------------------------------------------------------------
//recolectores
function ponerCodRecolector(F){
	for(i=0; i<recolectores.length; i++)
		//buscar en el vector el nombre del recolector seleccionado en la lista nombre_recolector
		if(recolectores[i][1] == F.nombre_recolector.value)
			//se encontro el nombre del recolector, con el indice "i" se coloca el codigo del recolector en el campo codigo_recolector
				F.codigo_recolector.value = recolectores[i][0];
}
//proveedores
function ponerCodProveedor(F){
	for(i=0; i<proveedores.length; i++)
		//buscar en el vector el nombre del proveedor seleccionado en la lista nombre_proveedor
		if(proveedores[i][1] == F.nombre_proveedor.value)
			//se encontro el nombre del proveedor, con el indice "i" se coloca el codigo del proveedor en el campo codigo_proveedor
				F.codigo_proveedor.value = proveedores[i][0];
}
//------------------------------------------------------------------------------------
//							cambiar el type text a password
//------------------------------------------------------------------------------------
function cambiarTypeTextPassword(F){
	// password: nombre del campo tipo password
	// cambiar: nombre del checkbox
    var input_formulario = F.password;
    if (F.cambiar.checked){input_formulario.setAttribute("type", "text");}
    else{input_formulario.setAttribute("type", "password");}
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