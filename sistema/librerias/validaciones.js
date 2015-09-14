/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*								validar los formularios									*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
//------------------------------------------------------------------------------------
//							formulario nueva compra de vidrio
//------------------------------------------------------------------------------------
function validarNuevaCompra(F,cantidad){
	var cantidad_vacios = 0;
	var elemento;
	var bandera = 0;
	borrarMensaje(cantidad);	elementosVacios(cantidad+1);
//campo fecha
	if(F.fecha.value > fechaActual()){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		return false;
	}
//campo codigo factura
	if(F.factura.value.length == 0){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		return false;
	}
//verificar que el numero de factura no este repetido
	for(i=0; i<facturas.length; i++){
		if(F.factura.value == facturas[i]){
			elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
			return false;
		}
	}
//listas recolector
	if(F.nombre_recolector.selectedIndex == 0 || F.codigo_recolector.selectedIndex == 0){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
		return false;
	}
//listas proveedor
	if(F.nombre_proveedor.selectedIndex == 0 || F.codigo_proveedor.selectedIndex == 0){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		elemento = document.getElementById('id5'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id6'); elemento.addClassName("elementoVacio");
		return false;
	}
//lista sucursal
	if(F.sucursal.selectedIndex == 0){
		elemento = document.getElementById('mensaje6'); elemento.addClassName("visto");
		elemento = document.getElementById('id7'); elemento.addClassName("elementoVacio");
		return false;
	}
//campos cantidad vidrio
	if(F.BVe1.value.length == 0) cantidad_vacios++;	if(F.PVe1.value.length == 0) cantidad_vacios++;
	if(F.BCr1.value.length == 0) cantidad_vacios++;	if(F.PCr1.value.length == 0) cantidad_vacios++;
	if(F.BCa1.value.length == 0) cantidad_vacios++;	if(F.PCa1.value.length == 0) cantidad_vacios++;
	if(F.BBr1.value.length == 0) cantidad_vacios++;	if(F.PBr1.value.length == 0) cantidad_vacios++;
	if(F.BRe1.value.length == 0) cantidad_vacios++;	if(F.PRe1.value.length == 0) cantidad_vacios++;
//mostrar si no se registro ningun vidrio
	if(cantidad_vacios == 10){
		elemento = document.getElementById('mensaje7'); elemento.addClassName("visto");
		elemento = document.getElementById('id8'); elemento.addClassName("elementoVacio");
		F.BVe1.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//								formulario nuevo proveedor
//------------------------------------------------------------------------------------
function validarNuevoProveedor(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);	elementosVacios(cantidad+1);
//campo caja de texto nombre proveedor
	if(F.nombre_proveedor.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		F.nombre_proveedor.focus();
		return false;
	}
//lista de tipos de empresas
	if (F.nombre_tipo_empresa.selectedIndex == 0){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		F.nombre_tipo_empresa.focus();
		return false;
	}
//lista de departamentos
	if (F.departamento.selectedIndex == 0){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		F.departamento.focus();
		return false;
	}
//caja de texto nombre del representante
	if(F.contacto.value == ""){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
		F.contacto.focus();
		return false;
	}
//caja de texto primer numero telefonico
	if(F.telefono1_1.value == "" || F.telefono1_2.value == ""){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		elemento = document.getElementById('id5'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id6'); elemento.addClassName("elementoVacio");
		F.telefono1_1.focus();
		//F.telefono1_2.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//								formulario nuevo recolector
//------------------------------------------------------------------------------------
function validarNuevoRecolector(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);	elementosVacios(cantidad+5);
//caja de texto nombre recolector
	if(F.nombre_recolector.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		F.nombre_recolector.focus();
		return false;
	}
//caja de texto del dui
	if(F.dui1.value == "" || F.dui2.value == ""){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		F.dui1.focus();
		return false;
	}
//caja de texto del nit
	if(F.nit1.value == "" || F.nit2.value == "" || F.nit3.value == "" || F.nit4.value == ""){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id5'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id6'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id7'); elemento.addClassName("elementoVacio");
		F.nit1.focus();
		return false;
	}
//caja de texto del telefonico
	if(F.telefono1.value == "" || F.telefono2.value == ""){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		elemento = document.getElementById('id8'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id9'); elemento.addClassName("elementoVacio");
		F.telefono1.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario nuevo centro de acopio
//------------------------------------------------------------------------------------
function validarNuevoCentroAcopio(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);	elementosVacios(cantidad+1);
//caja de texto nombre entro de acopio
	if(F.nombre_centro_acopio.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		F.nombre_centro_acopio.focus();
		return false;
	}
//lista de encargados
	if (F.nombre_recolector.selectedIndex == 0){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		F.nombre_recolector.focus();
		return false;
	}
//lista departamentos
	if (F.departamento.selectedIndex == 0){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		F.departamento.focus();
		return false;
	}
//caja de texto del telefonico
	if(F.telefono1.value != "" || F.telefono2.value != ""){
		if(!(F.telefono1.value != "" && F.telefono2.value != "")){
			elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
			elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
			elemento = document.getElementById('id5'); elemento.addClassName("elementoVacio");
			F.telefono1.focus();
			//F.telefono2.focus();
			return false;
		}
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario nuevo usuario
//------------------------------------------------------------------------------------
function validarNuevoUsuario(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);	elementosVacios(cantidad-1);
//caja de texto nombre
	if(F.nombre.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		F.nombre.focus();
		return false;
	}
//caja de texto usuario
	if(F.usuario.value == ""){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		F.usuario.focus();
		return false;
	}
//verificar que el nombre de usuario no este repetido
	for(i=0; i<usuarios.length; i++){
		if(F.usuario.value == usuarios[i]){
			elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
			return false;
		}
	}
//caja de texto password
	if(F.password.value == ""){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		F.password.focus();
		return false;
	}
//lista de tipos de usuarios
	if (F.nivel.selectedIndex == 0){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
		F.nivel.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario iniciar sesion
//------------------------------------------------------------------------------------
function validarIniciarSesion(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);	elementosVacios(cantidad-1);
//caja de texto usuario
	if(F.usuario.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		F.usuario.focus();
		return false;
	}
//caja de texto password
	if(F.password.value == ""){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		F.password.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario modificar compra
//------------------------------------------------------------------------------------
function validarModificarCompra(F,cantidad){
	borrarMensaje(cantidad);
//campo fecha
	if(F.fecha.value > fechaActual()){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		return false;
	}
	var cantidad_vacios = 0;
//campos cantidad vidrio
	if(F.Vc1.value.length == 0) cantidad_vacios++;	if(F.Vc6.value.length == 0) cantidad_vacios++;
	if(F.Vc2.value.length == 0) cantidad_vacios++;	if(F.Vc7.value.length == 0) cantidad_vacios++;
	if(F.Vc3.value.length == 0) cantidad_vacios++;	if(F.Vc8.value.length == 0) cantidad_vacios++;
	if(F.Vc4.value.length == 0) cantidad_vacios++;	if(F.Vc9.value.length == 0) cantidad_vacios++;
	if(F.Vc5.value.length == 0) cantidad_vacios++;	if(F.Vc10.value.length == 0) cantidad_vacios++;
//mostrar si no se registro ningun vidrio
	if(cantidad_vacios == 10){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		F.Bc1.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario modificar proveedor
//------------------------------------------------------------------------------------
function validarModificarProveedor(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);
//caja de texto nombre proveedor
	if(F.nombre_proveedor.value == ""){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		F.nombre_proveedor.focus();
		return false;
	}
//caja de texto primer numero telefonico
	if(F.telefono1_1.value == "" || F.telefono1_2.value == ""){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		F.telefono1_1.focus();
		return false;
	}
//caja de texto nombre del representante
	if(F.contacto.value == ""){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		F.contacto.focus();
		return false;
	}
	return true;
}
//------------------------------------------------------------------------------------
//							formulario estadistica vidrio
//------------------------------------------------------------------------------------
function validarEstadisticaVidrio(F,cantidad){
	borrarMensaje(cantidad);
	return ListaMes(F,1) && ListaAno(F,2) && RadioMostrar(F,3) && ListaSucursal(F,4);
}
//------------------------------------------------------------------------------------
//							formulario estadistica proveedor
//------------------------------------------------------------------------------------
function validarEstadisticaProveedor(F,cantidad){
	borrarMensaje(cantidad);
	return ListaAno(F,1) && ListaProveedor(F,2) && RadioMostrar(F,3) && RadioVidrio(F,4);
}
//------------------------------------------------------------------------------------
//							formulario estadistica recolector
//------------------------------------------------------------------------------------
function validarEstadisticaRecolector(F,cantidad){
	borrarMensaje(cantidad);
	return ListaAno(F,1) && ListaRecolector(F,2) && RadioMostrar(F,3) && RadioVidrio(F,4);
}
//------------------------------------------------------------------------------------
//							formulario reporte recolector
//------------------------------------------------------------------------------------
function validarReporteRecolector(F,cantidad){
	borrarMensaje(cantidad);
	return ListaRecolector(F,1) && ListaMes(F,2) && ListaAno(F,3);
}
//------------------------------------------------------------------------------------
//							formulario comparacion de compras
//------------------------------------------------------------------------------------
function validarComparacionCompra(F,cantidad){
	var elemento;
	borrarMensaje(cantidad);
	if (F.mes1.selectedIndex == 0){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		return false;
	}
	if (F.ano1.selectedIndex == 0){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		return false;
	}
	if (F.mes2.selectedIndex == 0){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		return false;
	}
	if (F.ano2.selectedIndex == 0){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		return false;
	}
//validar las fechas a comprar
	var periodo1;	if(F.mes1.value < 10) periodo1 = F.ano1.value+'-0'+F.mes1.value;	else periodo1 = F.ano1.value+'-'+F.mes1.value;
	var periodo2;	if(F.mes2.value < 10) periodo2 = F.ano2.value+'-0'+F.mes2.value;	else periodo2 = F.ano2.value+'-'+F.mes2.value;
	
	if (periodo1 == periodo2){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		return false;
	}
	if (periodo1 > periodo2){
		elemento = document.getElementById('mensaje6'); elemento.addClassName("visto");
		return false;
	}
	if (periodo2 < periodo1){
		elemento = document.getElementById('mensaje7'); elemento.addClassName("visto");
		return false;
	}
	if(periodo1 > fechaActual()){
		elemento = document.getElementById('mensaje8'); elemento.addClassName("visto");
		return false;
	}
	if(periodo2 > fechaActual()){
		elemento = document.getElementById('mensaje9'); elemento.addClassName("visto");
		return false;
	}
	if (F.mostrar.selectedIndex == 0){
		elemento = document.getElementById('mensaje10'); elemento.addClassName("visto");
		return false;
	}
	if (F.sucursal.selectedIndex == 0){
		elemento = document.getElementById('mensaje11'); elemento.addClassName("visto");
		return false;
	}
//si no hubo error, eviar un valor verdadero
	return true;
}
//------------------------------------------------------------------------------------
//							formulario historial de compras
//------------------------------------------------------------------------------------
function validarHistorialCompra(F,cantidad,criterio){
	borrarMensaje(cantidad);
	switch(criterio){
	case 'periodo':
					return FechaInicialFinal(F) && ListaSucursal(F,10);
					break;
	case 'tipo':
					return ListaTipoVidrio(F,8) && ListaSucursal(F,10);
					break;
	case 'proveedor':
					return ListaProveedor(F,9) && ListaSucursal(F,10);
					break;
	}
}
//------------------------------------------------------------------------------------
//							funciones sobre las validaciones
//------------------------------------------------------------------------------------
//radio button mostrar
function RadioMostrar(F,msj){
	var i, correcto = false;
	for(i=0; i<F.mostrar.length; i++){
		if(F.mostrar[i].checked)
		correcto = true;
	}
	if(!correcto){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//radio button vidrio
function RadioVidrio(F,msj){
	var i, correcto = false;
	for(i=0; i<F.vidrio.length; i++){
	if(F.vidrio[i].checked)
		correcto = true;
	}
	if(!correcto){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//inputs fecha_inicial y fecha_final
function FechaInicialFinal(F){
//falta seleccionar la fecha_inicial
	if (F.fecha_inicial.value == 0){
		elemento = document.getElementById('mensaje1'); elemento.addClassName("visto");
		elemento = document.getElementById('id1'); elemento.addClassName("elementoVacio");
		return false;
	}
//falta seleccionar la fecha_final
	if (F.fecha_final.value == 0){
		elemento = document.getElementById('mensaje2'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		return false;
	}
//fecha_inicial no debe ser igual a fecha_final
	if (F.fecha_inicial.value == F.fecha_final.value){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		return false;
	}
//fecha_inicial no debe ser mayor a fecha_final
	if (F.fecha_inicial.value > F.fecha_final.value){
		elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
		return false;
	}
//fecha_final no debe ser menor a fecha_inicial
	if (F.fecha_final.value < F.fecha_inicial.value){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		return false;
	}
//fecha_inicial no debe ser mayor ni igual a la fecha actual
	if(F.fecha_inicial.value >= fechaActual()){
		elemento = document.getElementById('mensaje6'); elemento.addClassName("visto");
		return false;
	}
//fecha_final no debe ser mayor ni igual a la fecha actual
	if(F.fecha_final.value >= fechaActual()){
		elemento = document.getElementById('mensaje7'); elemento.addClassName("visto");
		return false;
	}
//si no hubo error, eviar un valor verdadero
	return true;
}
//lista años
function ListaAno(F,msj){
	if (F.seleccionar_ano.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//lista meses
function ListaMes(F,msj){
	if (F.seleccionar_mes.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//lista proveedores
function ListaProveedor(F,msj){
	if (F.seleccionar_proveedor.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//lista recolectores
function ListaRecolector(F,msj){
	if (F.seleccionar_recolector.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//lista sucursal
function ListaSucursal(F,msj){
	if (F.sucursal.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//lista tipos vidrio
function ListaTipoVidrio(F,msj){
	if (F.seleccionar_tipo.selectedIndex == 0){
		var elemento = document.getElementById('mensaje'+msj); elemento.addClassName("visto");
		return false;
	}
	return true;
}
//ocultar los mensajes
function borrarMensaje(cantidad){
	var elemento;
	for(i=1; i<=cantidad; i++){
		elemento = document.getElementById('mensaje'+i); elemento.removeClassName("visto");
	}
}
//quitarle lo rojo a los elementos
function elementosVacios(cantidad){
	var elemento;
	for(i=1; i<=cantidad; i++){
		elemento = document.getElementById('id'+i); elemento.removeClassName("elementoVacio");
	}
}
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*								fin validar los formularios								*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/