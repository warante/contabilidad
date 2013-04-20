<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Stock</title>	
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
		
		$sql_dis = "SELECT * FROM `distribuidor`";
		$dis = mysql_query($sql_dis, $conn) or die(mysql_error());
		
		
?>
		<div class="row-fluid">
		
			<div class="span12 thumbnail">
			<h1>Stock por distribuidor</h1>
			
			<?php 
				while($filas = mysql_fetch_array($dis))
				{
					$sql_stock = "SELECT * FROM `stock` WHERE `distribuidor` LIKE '" . $filas['nombre'] . "'";
					$stock = mysql_query($sql_stock, $conn) or die(mysql_error());
					if(mysql_num_rows($stock)>0)
					{
						echo '<table class="table table-hover"> 
								<caption>' . $filas['nombre'] . ' </caption> 
								<thread> 
									<th>Modelo</th><th>Cantidad</th><th>Fecha</th><th>Acciones</th>
								</thread>
								<tbody>';
								
						while($filas2 = mysql_fetch_array($stock))
						{			
							echo '<tr><td>' . $filas2['modelo'] . '</td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['fecha'] . '</td><td><button type="button" class="btn btn-success">Vendida</button><button type="button" class="btn btn-warning">Modificar</button></td>
									</tr>';
						}
						
						echo '</tbody>
							</table>';
					}
				}
			
			
			?>
								
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>		
				</div>
			
			</div>
			
		</div>
	
</div>
</body>
</html>