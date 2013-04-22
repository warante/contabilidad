<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar venta</title>	
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link rel="icon" type="image/icon" href="../img/favicon.ico" />
</head>
<body>

<div class="container">

<?php
		include("db.php");
		$conn = mysql_connect($server, $db_user, $db_pass) or die(mysql_error());
		mysql_select_db($database, $conn);
		
		$sql_venta = "SELECT * FROM `venta` ORDER BY `fecha_venta`";
		$venta = mysql_query($sql_venta, $conn) or die(mysql_error());
		
		$sql_mod_venta = "SELECT * FROM `venta` ORDER BY `modelo`";
		$mod_vedta = mysql_query($sql_mod_venta, $conn) or die(mysql_error());
		
		$sql_mod = "SELECT * FROM `modelo`";
		$mod = mysql_query($sql_mod, $conn) or die(mysql_error());		
		
?>
		<div class="row-fluid">
		
			<div class="span12 thumbnail">
			<h1>Ventas por modelos</h1>
			<table class="table table-hover">
			
			<?php 
				while($filas = mysql_fetch_array($mod))
				{
					$sql_stock = "SELECT * FROM `venta` WHERE `modelo` LIKE '" . $filas['nombre'] . "'";
					$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
					if(mysql_num_rows($stock)>0)
					{
						echo '<table class="table table-hover"> 
								<caption><h3>' . $filas['nombre'] . '</h3></caption> 
								<thread> 
									<th>Distribuidor</th><th>Cantidad</th><th>Pvp venta</th><th>Pvp beneficio</t><th>Fecha</th>
								</thread>
								<tbody>';
						$cantidad_total = 0;
						$pvp_venta_total = 0;
						$pvp_beneficio_total = 0;
								
						while($filas2 = mysql_fetch_array($stock))
						{			
							echo '<tr><td>' . $filas2['distribuidor'] . '</td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp_venta'] . '</td><td>' . $filas2['pvp_beneficios'] . '</td><td>' . $filas2['fecha_venta'] . '</td>	</tr>';
							$cantidad_total += $filas2['cantidad'];
							$pvp_venta_total += $filas2['pvp_venta'] * $filas2['cantidad'];
							$pvp_beneficio_total += $filas2['pvp_beneficios'] * $filas2['cantidad'];
						}
						echo '<tr><td><b>Totales</b></td><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_venta_total . '</b></td><td><b>' . $pvp_beneficio_total . '</b></td><td></td></tr>';
						
						echo '</tbody>
							</table>';
					}
				}
			
			?>
			</table>
			
			<h1>Ventas por distribuidor</h1>
			
			<h1>Ventas por fecha<h1>
			
			</div>
			
		</div>
	
</div>
</body>
</html>