//------------------------------------------------------------------------------------
//								calcular el monto y total
//------------------------------------------------------------------------------------
function calcularMonto(){
with (document.forms["formulario"]){
	var totalVc1,totalVc2,totalVc3,totalVc4,totalVc5,totalVc6,totalVc7,totalVc8,totalVc9,totalVc10;
	
	totalVc1 = Number(Vc1.value)*precio;
	if(Vc1.value != "") {Vc1.value = redondear(Vc1.value,2); Vp1.value = redondear(totalVc1,2);}
	else Vp1.value = "";
	
	totalVc2 = Number(Vc2.value)*precio;
	if(Vc2.value != "") {Vc2.value = redondear(Vc2.value,2); Vp2.value = redondear(totalVc2,2);}
	else Vp2.value = "";
	
	totalVc3 = Number(Vc3.value)*precio;
	if(Vc3.value != "") {Vc3.value = redondear(Vc3.value,2); Vp3.value = redondear(totalVc3,2);}
	else Vp3.value = "";
	
	totalVc4 = Number(Vc4.value)*precio;
	if(Vc4.value != "") {Vc4.value = redondear(Vc4.value,2); Vp4.value = redondear(totalVc4,2);}
	else Vp4.value = "";
	
	totalVc5 = Number(Vc5.value)*precio;
	if(Vc5.value != "") {Vc5.value = redondear(Vc5.value,2); Vp5.value = redondear(totalVc5,2);}
	else Vp5.value = "";
	
	//para plano
	totalVc6 = Number(Vc6.value)*precio;
	if(Vc6.value != "") {Vc6.value = redondear(Vc6.value,2); Vp6.value = redondear(totalVc6,2);}
	else Vp6.value = "";
	
	totalVc7 = Number(Vc7.value)*precio;
	if(Vc7.value != "") {Vc7.value = redondear(Vc7.value,2); Vp7.value = redondear(totalVc7,2);}
	else Vp7.value = "";
	
	totalVc8 = Number(Vc8.value)*precio;
	if(Vc8.value != "") {Vc8.value = redondear(Vc8.value,2); Vp8.value = redondear(totalVc8,2);}
	else Vp8.value = "";
	
	totalVc9 = Number(Vc9.value)*precio;
	if(Vc9.value != "") {Vc9.value = redondear(Vc9.value,2); Vp9.value = redondear(totalVc9,2);}
	else Vp9.value = "";
	
	totalVc10 = Number(Vc10.value)*precio;
	if(Vc10.value != "") {Vc10.value = redondear(Vc10.value,2); Vp10.value = redondear(totalVc10,2);}
	else Vp10.value = "";
	
	var totalCantidadBotella = Number(Vc1.value)+Number(Vc2.value)+Number(Vc3.value)+Number(Vc4.value)+Number(Vc5.value);
	if(totalCantidadBotella == 0.0) BTo1.value = "";
	else BTo1.value = redondear(totalCantidadBotella,2);
	
	var totalMontoBotella = Number(Vp1.value)+Number(Vp2.value)+Number(Vp3.value)+Number(Vp4.value)+Number(Vp5.value);
	if(totalMontoBotella == 0.0) BTo2.value = "";
	else BTo2.value = redondear(totalMontoBotella,2);
	
	var totalCantidadPlano = Number(Vc6.value)+Number(Vc7.value)+Number(Vc8.value)+Number(Vc9.value)+Number(Vc10.value);
	if(totalCantidadPlano == 0.0) PTo1.value = "";
	else PTo1.value = redondear(totalCantidadPlano,2);
	
	var totalMontoPlano = Number(Vp6.value)+Number(Vp7.value)+Number(Vp8.value)+Number(Vp9.value)+Number(Vp10.value);
	if(totalMontoPlano == 0.0) PTo2.value = "";
	else PTo2.value = redondear(totalMontoPlano,2);
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