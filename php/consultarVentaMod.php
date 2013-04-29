<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Consultar venta</title>	
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
			$sql_mod = "SELECT * FROM `modelo`";
			$mod = mysql_query($sql_mod, $conn) or die(mysql_error());			
		?>
		<div class="row-fluid">
		
			<div class="span12 thumbnail">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#">Ventas por modelos</a></li>
					<li><a href="consultarVenta2.php">Ventas por distribuidor</a></li>	
				</ul>
				
				<ul class="nav nav-pills">
					<li><a href="consultarVenta.php">Todos</a></li>
					<?php 					
						while($filas = mysql_fetch_array($mod))
						{
							if($_GET['modelo'] == $filas['nombre'])
							{
								echo '<li class="active"><a href="consultarVentaMod.php?modelo=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
							}
							else
							{
								echo '<li><a href="consultarVentaMod.php?modelo=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
							}
						}
					?>
				</ul>
				
				<table class="table table-hover">
					<thread> 
						<th>Distribuidor</th><th>Cantidad</th><th>Pvp venta</th><th>Pvp beneficio</th><th>Fecha</th>
					</thread>
					
					<tbody>
				
						<?php 
							$sql_stock = "SELECT * FROM `venta` WHERE `modelo` LIKE '" . $_GET['modelo'] . "' ORDER BY `fecha_venta`";
							$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
								
							$cantidad_total = 0;
							$pvp_venta_total = 0;
							$pvp_beneficio_total = 0;
										
							while($filas2 = mysql_fetch_array($stock))
							{			
								echo '<tr><td><a href="consultarVentaDis.php?distribuidor='. $filas2['distribuidor'] .'">' . $filas2['distribuidor'] . '</a></td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp_venta'] . '</td><td>' . $filas2['pvp_beneficios'] . '</td><td>' . $filas2['fecha_venta'] . '</td>	</tr>';
								$cantidad_total += $filas2['cantidad'];
								$pvp_venta_total += $filas2['pvp_venta'] * $filas2['cantidad'];
								$pvp_beneficio_total += $filas2['pvp_beneficios'] * $filas2['cantidad'];
							}
							echo '<tr><td><b>Totales</b><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_venta_total . '</b></td><td><b>' . $pvp_beneficio_total . '</b></td><td></td></tr>';
						?>
					</tbody>
				</table>
				<div>
						<br />
						<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>		
						<input type="button" name="registrar" id="registrar" value="Registrar una venta" class="btn btn-primary btn-large" onclick="window.location='registrarVenta.php'"/>						
						<input type="button" name="volver" id="volver" value="Ir a gastos" class="btn btn-success btn-large" onclick="window.location='consultarGastos.php'"/>
						<input type="button" name="volver" id="volver" value="Ir a ganancias" class="btn btn-success btn-large" onclick="window.location='consultarGanancias.php'"/>
						<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>	
						<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>	
				</div>
			</div>
				
		</div>
		
	</div>
	
</body>

</html>