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
	borrarMensaje(cantidad);	elementosVacios(cantidad-1);
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
//campo codigo factura no debe ser menor a 4
	if(F.factura.value.length < 4){
		elemento = document.getElementById('mensaje3'); elemento.addClassName("visto");
		elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
		return false;
	}
//verificar que el numero de factura no este repetido
	for(i=0; i<facturas.length; i++){
		if(F.factura.value == facturas[i]){
			elemento = document.getElementById('mensaje4'); elemento.addClassName("visto");
			elemento = document.getElementById('id2'); elemento.addClassName("elementoVacio");
			return false;
		}
	}
//lista recolector
	if(F.codigo_recolector.selectedIndex == 0){
		elemento = document.getElementById('mensaje5'); elemento.addClassName("visto");
		elemento = document.getElementById('id3'); elemento.addClassName("elementoVacio");
		return false;
	}
//lista proveedor
	if(F.codigo_proveedor.selectedIndex == 0){
		elemento = document.getElementById('mensaje6'); elemento.addClassName("visto");
		elemento = document.getElementById('id4'); elemento.addClassName("elementoVacio");
		return false;
	}
//campos cantidad vidrio
	if(F.Bc1.value.length == 0) cantidad_vacios++;	if(F.Bp1.value.length == 0) cantidad_vacios++;
	if(F.Bc2.value.length == 0) cantidad_vacios++;	if(F.Bp2.value.length == 0) cantidad_vacios++;
	if(F.Bc3.value.length == 0) cantidad_vacios++;	if(F.Bp3.value.length == 0) cantidad_vacios++;
	if(F.Pc1.value.length == 0) cantidad_vacios++;	if(F.Pp1.value.length == 0) cantidad_vacios++;
	if(F.Pc2.value.length == 0) cantidad_vacios++;	if(F.Pp2.value.length == 0) cantidad_vacios++;
	if(F.Pc3.value.length == 0) cantidad_vacios++;	if(F.Pp3.value.length == 0) cantidad_vacios++;
//mostrar si no se registro ningun vidrio
	if(cantidad_vacios == 12){
		elemento = document.getElementById('mensaje7'); elemento.addClassName("visto");
		elemento = document.getElementById('id5'); elemento.addClassName("elementoVacio");
		elemento = document.getElementById('id6'); elemento.addClassName("elementoVacio");
		F.cheque_botella.checked = false;	activarBotella(F);
		F.Bc1.focus();
		return false;
	}
//lista sucursal
	if(F.sucursal.selectedIndex == 0){
		elemento = document.getElementById('mensaje8'); elemento.addClassName("visto");
		elemento = document.getElementById('id7'); elemento.addClassName("elementoVacio");
		return false;
	}
//lista codigo_centro_acopio
	if(F.codigo_centro_acopio.selectedIndex == 0){
		elemento = document.getElementById('mensaje9'); elemento.addClassName("visto");
		elemento = document.getElementById('id8'); elemento.addClassName("elementoVacio");
		return false;
	}
	return true;
}
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*								fin validar los formularios								*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/