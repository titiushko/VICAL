<?php
include "../../../loggin/BloqueSeguridad.php";
include "../../../loggin/AccesoAdministrador.php";
include "../../../librerias/abrir_conexion.php";

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
?>
<HTML>
	<head>
		<title>REPORTE_DE_PROVEEDORES</title>
		<meta http-equiv="content-type"  content="text/html;charset=utf-8">
		<meta http-equiv="expires"       content="0">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="pragma"        content="nocache">
		<meta name="author"              content="TITIUSHKO">
		<meta name="keywords"            content="ejercicio, estilo, html">
		<meta name="description"         content="Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador">
		<link rel="shortcut icon" 		 href="../../../imagenes/vical.ico"></link>
		<link rel="stylesheet" 			 href="../../../librerias/formato.css" type="text/css"></link>
	</head>
	<BODY class="cuerpo1" onLoad="window.print()">
		<table align="center">
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<h1 align='center' class='encabezado1'>REPORTE DE PROVEEDORES</h1>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
			<tr>
				<td align="center" colspan="3">
					<table border="1" id="registros" bgcolor="white">
						<thead>
							<tr>
								<th><h3>Codigo</h3></th>
								<th><h3>Nombre Empresa</h3></th>
								<th><h3>Tipo Empresa</h3></th>
								<th><h3>Departamento</h3></th>
								<th><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direccion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></th>
								<th><h3>Telefono1</h3></th>
								<th><h3>Telefono2</h3></th>
								<th><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contacto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></th>
								<th><h3>Esta&ntilde;on</h3></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($proveedores = mysql_fetch_array($consulta_proveedores)){
							?>
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
								<td><?php echo $proveedores[4];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[5] <> NULL){ ?>
								<td><?php echo $proveedores[5];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[6] <> NULL){ ?>
								<td><?php echo $proveedores[6];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
							<?php } ?>
							<!--==================================-->
							<?php if($proveedores[7] <> NULL){ ?>
								<td><?php echo $proveedores[7];?></td>
							<?php } else{ ?>
								<td>&nbsp;</td>
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
							}
							?>
						</tbody>
					</table>
				</td>
			</tr>
			<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
		</table>
<!------------------------------------------------------------------------------------------------------------------------>
		<hr><center>Sistema de Compras y Control de Proveedores de la Empresa VICAL de El Salvador &#8226; Derechos Reservados 2011</center>
	</BODY>
</HTML>
<?php include "../../../librerias/cerrar_conexion.php"; ?>