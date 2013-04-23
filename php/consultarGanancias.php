<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Consultar ganancias</title>	
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="../css/general.css" rel="stylesheet" media="screen">
</head>

<body>

	<div class="container">

		<?php
			include("db.php");
			$conn = mysql_connect($server, $db_user, $db_pass) or die(mysql_error());
			mysql_select_db($database, $conn);
			
			$sql_venta = "SELECT * FROM `venta`";
			$venta = mysql_query($sql_venta, $conn) or die(mysql_error());	
			
			$sql_gastos = "SELECT * FROM `gastos`";
			$gastos = mysql_query($sql_gastos, $conn) or die(mysql_error());	
			
		?>
		<div class="row-fluid">
			
			<div class="span12 thumbnail">
							
				<table class="table table-hover">
					<caption><h1>Totales</h1></caption>
					<thread> 
						<th>Nº total</th><th>Ventas</th><th>Gastos</th><th>Beneficios</th>
					</thread>
					<tbody>
					
					<?php
						$num_total = 0;
						$ventas_total = 0;
						$gastos_total = 0;
						$beneficios = 0;
						while($filas = mysql_fetch_array($venta))
						{					
							$num_total += $filas['cantidad'];
							$ventas_total += $filas['pvp_beneficios'] * $filas['cantidad'];
						}
						
						while($filas = mysql_fetch_array($gastos))
						{					
							$gastos_total += $filas['pvp'] * $filas['cantidad'];
						}
						
						$beneficios = $ventas_total - $gastos_total;
						echo "<tr  class=\"success\"><td><b>$num_total</b></td><td><b>$ventas_total</b></td><td><b>$gastos_total</b></td><td><b>$beneficios</b></td></tr>";
					?>	
					</tbody>
				</table>
				<div>
					<br />
					<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>
					<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>
					<input type="button" name="volver" id="volver" value="Ir a gastos" class="btn btn-success btn-large" onclick="window.location='consultarGastos.php'"/>
					<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>	
					<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>	
				</div>
				
			</div>
				
		</div>
		
	</div>
	
</body>

</html>