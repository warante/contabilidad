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
			$sql_dis = "SELECT * FROM `distribuidor`";
			$dis = mysql_query($sql_dis, $conn) or die(mysql_error());				
		?>
		<div class="row-fluid">
			
			<div class="span12 thumbnail">
				<ul class="nav nav-tabs">
					<li><a href="consultarVenta.php">Ventas por modelos</a></li>
					<li class="active"><a href="#">Ventas por distribuidor</a></li>	
				</ul>
				
				<ul class="nav nav-pills">
					<li><a href="consultarVenta2.php">Todos</a></li>
					<?php 					
						while($filas = mysql_fetch_array($dis))
						{
							if($_GET['distribuidor'] == $filas['nombre'])
							{
								echo '<li class="active"><a href="consultarVentaDis.php?distribuidor=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
							}
							else
							{
								echo '<li><a href="consultarVentaDis.php?distribuidor=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
							}
						}
					?>
				</ul>
				
				<?php 
					$sql_stock = "SELECT * FROM `venta` WHERE `distribuidor` LIKE '" . $_GET['distribuidor'] . "'";
					$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
					echo '<table class="table table-hover"> 
							<thread> 
								<th>Modelo</th><th>Cantidad</th><th>Pvp venta</th><th>Pvp beneficio</th><th>Fecha</th>
							</thread>
						<tbody>';
					$cantidad_total = 0;
					$pvp_venta_total = 0;
					$pvp_beneficio_total = 0;
									
					while($filas2 = mysql_fetch_array($stock))
					{			
						echo '<tr><td><a href="consultarVentaMod.php?modelo=' . $filas2['modelo'] . '">' . $filas2['modelo'] . '</a></td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp_venta'] . '</td><td>' . $filas2['pvp_beneficios'] . '</td><td>' . $filas2['fecha_venta'] . '</td>	</tr>';
						$cantidad_total += $filas2['cantidad'];
						$pvp_venta_total += $filas2['pvp_venta'] * $filas2['cantidad'];
						$pvp_beneficio_total += $filas2['pvp_beneficios'] * $filas2['cantidad'];
					}
					echo '<tr><td><b>Totales</b><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_venta_total . '</b></td><td><b>' . $pvp_beneficio_total . '</b></td><td></td></tr>';
						
					echo '</tbody>
						</table>';
				
				?>
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>		
				</div>
			</div>
				
		</div>
		
	</div>
	
</body>

</html>