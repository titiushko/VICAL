//------------------------------------------------------------------------------------
//								calcular el monto y total
//------------------------------------------------------------------------------------
function calcularMonto(){
with (document.forms["formulario"]){
	var totalBc1,totalBc2,totalBc3,totalPc1,totalPc2,totalPc3;
	
	totalBc1 = Number(Bc1.value)*precio;
	if(Bc1.value != "") {Bc1.value = redondear(Bc1.value,2); Bp1.value = redondear(totalBc1,2);}
	else Bp1.value = "";
	cbc.value = Bc1.value;	//cantidad botella clara
	pbc.value = Bp1.value;	//precio botella clara
	
	totalBc2 = Number(Bc2.value)*precio;
	if(Bc2.value != "") {Bc2.value = redondear(Bc2.value,2); Bp2.value = redondear(totalBc2,2);}
	else Bp2.value = "";
	cbv.value = Bc2.value;	//cantidad botella verde
	pbv.value = Bp2.value;	//precio botella verde
	
	totalBc3 = Number(Bc3.value)*precio;
	if(Bc3.value != "") {Bc3.value = redondear(Bc3.value,2); Bp3.value = redondear(totalBc3,2);}
	else Bp3.value = "";
	cbf.value = Bc3.value;	//cantidad botella cafe
	pbf.value = Bp3.value;	//precio botella cafe
	
	//para plano
	totalPc1 = Number(Pc1.value)*precio;
	if(Pc1.value != "") {Pc1.value = redondear(Pc1.value,2); Pp1.value = redondear(totalPc1,2);}
	else Pp1.value = "";
	cpc.value = Pc1.value;	//cantidad plano claro
	ppc.value = Pp1.value;	//precio plano claro
	
	totalPc2 = Number(Pc2.value)*precio;
	if(Pc2.value != "") {Pc2.value = redondear(Pc2.value,2); Pp2.value = redondear(totalPc2,2);}
	else Pp2.value = "";
	cpb.value = Pc2.value;	//cantidad plano bronce
	ppb.value = Pp2.value;	//precio plano bronce
	
	totalPc3 = Number(Pc3.value)*precio;
	if(Pc3.value != "") {Pc3.value = redondear(Pc3.value,2); Pp3.value = redondear(totalPc3,2);}
	else Pp3.value = "";
	cpr.value = Pc3.value;	//cantidad plano reflectivo
	ppr.value = Pp3.value;	//precio plano reflectivo
	
	var totalCantidadBotella = Number(Bc1.value)+Number(Bc2.value)+Number(Bc3.value);
	if(totalCantidadBotella == 0.0) TBc.value = "";
	else TBc.value = redondear(totalCantidadBotella,2);
	cbt.value = TBc.value;	//cantidad botella total
	
	var totalMontoBotella = Number(Bp1.value)+Number(Bp2.value)+Number(Bp3.value);
	if(totalMontoBotella == 0.0) TBp.value = "";
	else TBp.value = redondear(totalMontoBotella,2);
	pbt.value = TBp.value;	//precio botella total
	
	var totalCantidadPlano = Number(Pc1.value)+Number(Pc2.value)+Number(Pc3.value);
	if(totalCantidadPlano == 0.0) TPc.value = "";
	else TPc.value = redondear(totalCantidadPlano,2);
	cpt.value = TPc.value;	//cantidad plano total
	
	var totalMontoPlano = Number(Pp1.value)+Number(Pp2.value)+Number(Pp3.value);
	if(totalMontoPlano == 0.0) TPp.value = "";
	else TPp.value = redondear(totalMontoPlano,2);
	ppt.value = TPp.value;	//precio plano total
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
//						activar desactivar tablas de vidrios
//------------------------------------------------------------------------------------
//botella
function desactivarBotella(F){
	elemento = document.getElementById('id5'); 	 elemento.addClassName("fondo6");
	elemento = document.getElementById('id_b0'); elemento.addClassName("titulo4");
	elemento = document.getElementById('id_b1'); elemento.addClassName("titulo4");
	for(i=2; i<=9; i++){elemento = document.getElementById('id_b'+i); elemento.removeClassName("fondo4"); elemento.addClassName("fondo5");}
	for(i=1; i<=3; i++){campo = eval("F.Bc"+i); campo.disabled=true;}
	F.Bc1.value=F.cbc.value=F.Bp1.value=F.pbc.value=F.Bc2.value=F.cbv.value=F.Bp2.value=F.pbv.value=F.Bc3.value=F.cbf.value=F.Bp3.value=F.pbf.value=F.TBc.value=F.cbt.value=F.TBp.value=F.pbt.value="";		
}
function activarBotella(F){
	elemento = document.getElementById('id5'); 	 elemento.removeClassName("fondo6");
	elemento = document.getElementById('id_b0'); elemento.removeClassName("titulo4");
	elemento = document.getElementById('id_b1'); elemento.removeClassName("titulo4");
	for(i=2; i<=9; i++){elemento = document.getElementById('id_b'+i); elemento.addClassName("fondo4"); elemento.removeClassName("fondo5");}
	for(i=1; i<=3; i++){campo = eval("F.Bc"+i); campo.disabled=false;}
}
function activarDesactivarBotella(F){
	var elemento;
	if (F.cheque_botella.checked){desactivarBotella(F);}
    else{activarBotella(F);}
}
//plano
function DesactivarPlano(F){
	elemento = document.getElementById('id6'); 	 elemento.addClassName("fondo6");
	elemento = document.getElementById('id_p0'); elemento.addClassName("titulo4");
	elemento = document.getElementById('id_p1'); elemento.addClassName("titulo4");
	for(i=2; i<=9; i++){elemento = document.getElementById('id_p'+i); elemento.removeClassName("fondo4"); elemento.addClassName("fondo5");}
	for(i=1; i<=3; i++){campo = eval("F.Pc"+i); campo.disabled=true;}
	F.Pc1.value=F.cpc.value=F.Pp1.value=F.ppc.value=F.Pc2.value=F.cpb.value=F.Pp2.value=F.ppb.value=F.Pc3.value=F.cpr.value=F.Pp3.value=F.ppr.value=F.TPc.value=F.cpt.value=F.TPp.value=F.ppt.value="";
}
function activarPlano(F){
	elemento = document.getElementById('id6'); 	 elemento.removeClassName("fondo6");
	elemento = document.getElementById('id_p0'); elemento.removeClassName("titulo4");
	elemento = document.getElementById('id_p1'); elemento.removeClassName("titulo4");
	for(i=2; i<=9; i++){elemento = document.getElementById('id_p'+i); elemento.addClassName("fondo4"); elemento.removeClassName("fondo5");}
	for(i=1; i<=3; i++){campo = eval("F.Pc"+i); campo.disabled=false;}
}
function activarDesactivarPlano(F){
	var elemento;
	if (F.cheque_plano.checked){DesactivarPlano(F);}
    else{activarPlano(F);}
}