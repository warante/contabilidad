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
					<li><a href="consultarVenta.php">Ventas por modelo</a></li>	
					<li class="active"><a href="#">Ventas por distribuidor</a></li>				
				</ul>
				
				<ul class="nav nav-pills">
					<li class="active"><a href="#">Todos</a></li>
					<?php 					
						while($filas = mysql_fetch_array($dis))
						{
							echo '<li><a href="consultarVentaDis.php?distribuidor=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
						}
					?>
				</ul>
				
				<?php 
					$dis = mysql_query($sql_dis, $conn) or die(mysql_error());
					while($filas = mysql_fetch_array($dis))
					{
						$sql_stock = "SELECT * FROM `venta` WHERE `distribuidor` LIKE '" . $filas['nombre'] . "'";
						$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
						if(mysql_num_rows($stock)>0)
						{
							echo '<table class="table table-hover"> 
									<caption><h3><a href="consultarVentaDis.php?distribuidor=' .$filas['nombre'] . '">' . $filas['nombre'] . '</a></h3></caption> 
									<thread> 
										<th>Cantidad</th><th>Pvp venta</th><th>Pvp beneficio</t>
									</thread>
									<tbody>';
							$cantidad_total = 0;
							$pvp_venta_total = 0;
							$pvp_beneficio_total = 0;
									
							while($filas2 = mysql_fetch_array($stock))
							{			
								//echo '<tr><td>' . $filas2['distribuidor'] . '</td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp_venta'] . '</td><td>' . $filas2['pvp_beneficios'] . '</td><td>' . $filas2['fecha_venta'] . '</td>	</tr>';
								$cantidad_total += $filas2['cantidad'];
								$pvp_venta_total += $filas2['pvp_venta'] * $filas2['cantidad'];
								$pvp_beneficio_total += $filas2['pvp_beneficios'] * $filas2['cantidad'];
							}
							echo '<tr><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_venta_total . '</b></td><td><b>' . $pvp_beneficio_total . '</b></td></tr>';
							
							echo '</tbody>
								</table>';
						}
					}				
				?>
				
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