function calcularMonto(){
with (document.forms["formulario"]){
	var totales = new Array;
		totales[1] = new Array(0.0, 0.0);				totales[2] = new Array(0.0, 0.0);
	var valores = new Array;
		valores[1] = new Array(Vc1.value, Vp1.value);	valores[2] = new Array(Vc2.value, Vp2.value);
		valores[3] = new Array(Vc3.value, Vp3.value);	valores[4] = new Array(Vc4.value, Vp4.value);
		valores[5] = new Array(Vc5.value, Vp5.value);	valores[6] = new Array(Vc6.value, Vp6.value);
		valores[7] = new Array(Vc7.value, Vp7.value);	valores[8] = new Array(Vc8.value, Vp8.value);
		valores[8] = new Array(Vc9.value, Vp0.value);	valores[10] = new Array(Vc10.value, Vp10.value);
		
	for(i=1; i<=10; i++){
		if(valores[i][1] != "") {valores[i][1] = redondear(valores[i][1],2); valores[i][2] = redondear((Number(valores[i][1])*precio),2);}
		else valores[i][2] = "";
		if(i <= 5) {totales[1][1] += valores[i][1]; totales[1][2] += valores[i][2];}
		if(i >= 6) {totales[2][1] += valores[i][1]; totales[2][2] += valores[i][2];}
	}
	
	Vc1.value = valores[1][1];	Vp1.value = valores[1][2];		Vc2.value = valores[2][1];	Vp2.value = valores[2][2];
	Vc3.value = valores[3][1];	Vp3.value = valores[3][2];		Vc4.value = valores[4][1];	Vp4.value = valores[4][2];
	Vc5.value = valores[5][1];	Vp5.value = valores[5][2];		Vc6.value = valores[6][1];	Vp6.value = valores[6][2];
	Vc7.value = valores[7][1];	Vp6.value = valores[7][2];		Vc8.value = valores[8][1];	Vp8.value = valores[8][2];
	Vc9.value = valores[9][1];	Vp9.value = valores[9][2];		Vc10.value = valores[10][1];	Vp10.value = valores[10][2];
	
	if(totales[1][1] == 0.0) BTo1.value = "";	else BTo1.value = redondear(totales[1][1],2);	
	if(totales[2][2] == 0.0) PTo2.value = "";	else PTo2.value = redondear(totales[2][2],2);
	}
}

function calcularMonto(){
with (document.forms["formulario"]){
	var totalBVe1,totalBCr1,totalBCa1,totalBBr1,totalBRe1,totalPVe1,totalPCr1,totalPCa1,totalPBr1,totalPRe1;
	
	totalBVe1 = Number(BVe1.value)*precio;
	if(BVe1.value != "") {BVe1.value = redondear(BVe1.value,2); BVe2.value = redondear(totalBVe1,2);}
	else BVe2.value = "";
	
	totalBCr1 = Number(BCr1.value)*precio;
	if(BCr1.value != "") {BCr1.value = redondear(BCr1.value,2); BCr2.value = redondear(totalBCr1,2);}
	else BCr2.value = "";
	
	totalBCa1 = Number(BCa1.value)*precio;
	if(BCa1.value != "") {BCa1.value = redondear(BCa1.value,2); BCa2.value = redondear(totalBCa1,2);}
	else BCa2.value = "";
	
	totalBBr1 = Number(BBr1.value)*precio;
	if(BBr1.value != "") {BBr1.value = redondear(BBr1.value,2); BBr2.value = redondear(totalBBr1,2);}
	else BBr2.value = "";
	
	totalBRe1 = Number(BRe1.value)*precio;
	if(BRe1.value != "") {BRe1.value = redondear(BRe1.value,2); BRe2.value = redondear(totalBRe1,2);}
	else BRe2.value = "";
	
	//para plano
	totalPVe1 = Number(PVe1.value)*precio;
	if(PVe1.value != "") {PVe1.value = redondear(PVe1.value,2); PVe2.value = redondear(totalPVe1,2);}
	else PVe2.value = "";
	
	totalPCr1 = Number(PCr1.value)*precio;
	if(PCr1.value != "") {PCr1.value = redondear(PCr1.value,2); PCr2.value = redondear(totalPCr1,2);}
	else PCr2.value = "";
	
	totalPCa1 = Number(PCa1.value)*precio;
	if(PCa1.value != "") {PCa1.value = redondear(PCa1.value,2); PCa2.value = redondear(totalPCa1,2);}
	else PCa2.value = "";
	
	totalPBr1 = Number(PBr1.value)*precio;
	if(PBr1.value != "") {PBr1.value = redondear(PBr1.value,2); PBr2.value = redondear(totalPBr1,2);}
	else PBr2.value = "";
	
	totalPRe1 = Number(PRe1.value)*precio;
	if(PRe1.value != "") {PRe1.value = redondear(PRe1.value,2); PRe2.value = redondear(totalPRe1,2);}
	else PRe2.value = "";
	
	var totalCantidadBotella = Number(BVe1.value)+Number(BCr1.value)+Number(BCa1.value)+Number(BBr1.value)+Number(BRe1.value);
	if(totalCantidadBotella == 0.0) BTo1.value = "";
	else BTo1.value = redondear(totalCantidadBotella,2);
	
	var totalMontoBotella = Number(BVe2.value)+Number(BCr2.value)+Number(BCa2.value)+Number(BBr2.value)+Number(BRe2.value);
	if(totalMontoBotella == 0.0) BTo2.value = "";
	else BTo2.value = redondear(totalMontoBotella,2);
	
	var totalCantidadPlano = Number(PVe1.value)+Number(PCr1.value)+Number(PCa1.value)+Number(PBr1.value)+Number(PRe1.value);
	if(totalCantidadPlano == 0.0) PTo1.value = "";
	else PTo1.value = redondear(totalCantidadPlano,2);
	
	var totalMontoPlano = Number(PVe2.value)+Number(PCr2.value)+Number(PCa2.value)+Number(PBr2.value)+Number(PRe2.value);
	if(totalMontoPlano == 0.0) PTo2.value = "";
	else PTo2.value = redondear(totalMontoPlano,2);
	}
}

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