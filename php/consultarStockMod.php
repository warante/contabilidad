<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Stock</title>	
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
						<li><a href="consultarStock.php">Stock por distribuidor</a></li>
						<li class="active"><a href="#">Stock por modelo</a></li>		  
					</ul>
				
				<ul class="nav nav-pills">
					<li class="active"><a href="#">Todos</a></li>
					<?php 					
						while($filas = mysql_fetch_array($mod))
						{
							echo '<li><a href="consultarStockMod2.php?modelo=' .$filas['nombre'] . '">' .$filas['nombre'] . '</a></li>';
						}
					?>
				</ul>
					<?php 						
						$mod = mysql_query($sql_mod, $conn) or die(mysql_error());
						while($filas = mysql_fetch_array($mod))
						{
							$sql_stock = "SELECT * FROM `stock` WHERE `modelo` LIKE '" . $filas['nombre'] . "'";
							$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
							if(mysql_num_rows($stock)>0)
							{
								echo '<table class="table table-hover"> 
										<caption><h3><a href="consultarStockMod2.php?modelo=' . $filas['nombre'] . '">' . $filas['nombre'] . '</h3></caption> 
										<thread> 
											<th>Distribuidor</th><th>Cantidad</th><th>Acciones</th>
										</thread>
										<tbody>';
								$cantidad_total = 0;		
								while($filas2 = mysql_fetch_array($stock))
								{			
									/*echo '<tr><td><a href="consultarStockDis.php?distribuidor=' . $filas2['distribuidor'] . '">' . $filas2['distribuidor'] . '</td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['fecha'] . '</td><td><button type="button" class="btn btn-success" onclick="window.location=\'registrarVenta.php?distribuidor=' . $filas['nombre'] . '&modelo=' . $filas2['modelo'] . '&codigo=' . $filas2['cod_stock'] .'&cantidad=' . $filas2['cantidad'] . '\'">Vendida</button><button type="button" class="btn btn-warning" onclick="window.location=\'modificarStock.php?codigo=' . $filas2['cod_stock'] . '\'">Modificar</button></td>
											</tr>';*/
									$cantidad_total += $filas2['cantidad'];
								}
								echo '<tr><td><b>Totales</b><td><b>' . $cantidad_total . '</b></td><td><button type="button" class="btn btn-info" onclick="window.location=\'registrarStock.php?modelo=' . $filas['nombre'] . '\'">Registrar stock de este modelo</button></td></tr>';
								echo '</tbody>
									</table>';
							}
						}
					?>
									
					<div>
						<br />
						<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>	
						<input type="button" name="registrar" id="registrar" value="Registrar stock" class="btn btn-primary btn-large" onclick="window.location='registrarStock.php'"/>			
						<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>							
						<input type="button" name="volver" id="volver" value="Ir a ganancias" class="btn btn-success btn-large" onclick="window.location='consultarGanancias.php'"/>			
						<input type="button" name="volver" id="volver" value="Ir a gastos" class="btn btn-success btn-large" onclick="window.location='consultarGastos.php'"/>	
						<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>	
					</div>
				</div>
	  
			</div>
		
	</div>
</body>
</html>