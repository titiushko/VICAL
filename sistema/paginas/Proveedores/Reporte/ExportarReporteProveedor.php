<?php
include "../../../librerias/abrir_conexion.php";
include "../../../login/BloqueSeguridad.php";
include "../../../login/AccesoAdministrador.php";
include "../../../librerias/funciones.php";

$instruccion_select = "
SELECT
codigo_proveedor,
nombre_proveedor,
tipos_empresas.nombre_tipo_empresa,
departamento,
direccion_proveedor,
telefono_proveedor1,
telefono_proveedor2,
contacto,
estanon
FROM
proveedores
JOIN
tipos_empresas
WHERE tipos_empresas.codigo_tipo_empresa = proveedores.codigo_tipo_empresa
ORDER BY codigo_proveedor ASC";
$consulta_proveedores = mysql_query($instruccion_select, $conexion) or die ("<SPAN CLASS='error'>Fallo en consulta_proveedores!!</SPAN>".mysql_error());

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=REPORTE_DE_PROVEEDORES.doc");?>
<HTML>
	<head>
		<title>Proveedores</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO).">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico"></link>
	</head>
	<BODY>
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<h1 align='center'>REPORTE DE PROVEEDORES</h1>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<?php
					$total_paginas = $_SESSION["total_paginas"];
					$registros = 1;	$paginas = 1;	$reiniciar = true;					
					while ($proveedores = mysql_fetch_array($consulta_proveedores)){
						if($reiniciar){
					?>
					<table border="1" width="100%">
						<thead align="center">
							<tr>
								<th>Codigo</th>
								<th>Nombre Empresa</th>
								<th>Tipo Empresa</th>
								<th>Departamento</th>
								<th width="250">Direccion</th>
								<th width="90">Telefono1</th>
								<th width="90">Telefono2</th>
								<th width="150">Contacto</th>
								<th>Esta&ntilde;on</th>
							</tr>
						</thead>
					<?php
						}
						if($registros == 30){
					?>
						</tbody>
					</table>
					<b>Pagina <?php echo $paginas;?> de <?php echo $total_paginas;?></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b><?php echo hoyEs();?></b>
					<br><br>
					<?php
							$registros = 1;	$paginas++;	$reiniciar = true;
						}
						else{
					?>
						<tbody>
							<tr align="center">
							<!--==================================-->
							<?php if($proveedores[0] <> NULL){ ?>
								<td><?php echo $proveedores[0];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[1] <> NULL){ ?>
								<td><?php echo $proveedores[1];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[2] <> NULL){ ?>
								<td><?php echo $proveedores[2];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[3] <> NULL){ ?>
								<td><?php echo $proveedores[3];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[4] <> NULL){ ?>
								<td width="250"><?php echo $proveedores[4];?></td>
							<?php } else{ ?>
								<td width="250">&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[5] <> NULL){ ?>
								<td width="90"><?php echo $proveedores[5];?></td>
							<?php } else{ ?>
								<td width="90">&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[6] <> NULL){ ?>
								<td width="90"><?php echo $proveedores[6];?></td>
							<?php } else{ ?>
								<td width="90">&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[7] <> NULL){ ?>
								<td width="150"><?php echo $proveedores[7];?></td>
							<?php } else{ ?>
								<td width="150">&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[8] <> NULL){ ?>
								<td><?php echo $proveedores[8];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							</tr>
					<?php
							$reiniciar = false;
						}
						$registros++;
					}
					?>
						</tbody>
					</table>
					<?php
					if($paginas <= $total_paginas){
					?>
					<b>Pagina <?php echo $paginas;?> de <?php echo $total_paginas;?></b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<b><?php echo hoyEs();?></b>
					<?php
					}
					?>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema Inform&aacute;tico para Ayudar en el Registro de Compras de Vidrio y en el Control de Proveedores de VICAL El Salvador (COMVICONPRO). &#8226; Derechos Reservados 2012</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>