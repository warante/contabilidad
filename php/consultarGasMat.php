<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar gastos</title>	
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
		?>
		<div class="row-fluid">
			
			<div class="span12 thumbnail">
					
				<ul class="nav nav-pills">
					<li><a href="consultarGastos.php">Todos</a></li>
					<?php 			
						$array = array('Diadema ancha', 'Diadema fina', 'Forro', 'Goma eva');
						foreach($array as $i => $value)
						{
							if($_GET['categoria'] == $array[$i])
							{
								echo '<li class="active"><a href="consultarGastMat.php?categoria=' . $array[$i] . '">' .$array[$i] . '</a></li>';
							}
							else
							{
								echo '<li><a href="consultarGasMat.php?categoria=' . $array[$i] . '">' . $array[$i] . '</a></li>';
							}
						}
					?>
				</ul>	

				<table class="table table-hover"> 
					<thread> 
						<th>Color</th><th>Cantidad</th><th>Pvp coste</th><th>Pvp coste total</th><th>Fecha</th>
					</thread>
					<tbody>			
				<?php 
					$sql_gas = "SELECT * FROM `gastos` WHERE `categoria` LIKE '" . $_GET['categoria'] . "'";
					$gas = mysql_query($sql_gas, $conn) or die(mysql_error());
					$cantidad_total = 0;
					$pvp_gasto_total = 0;
									
					while($filas2 = mysql_fetch_array($gas))
					{		
						$cantidad_total += $filas2['cantidad'];
						$pvp_gasto_total += $filas2['pvp'] * $filas2['cantidad'];
						echo '<tr><td>' . $filas2['color'] . '<td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp'] . '</td><td>' . $pvp_gasto_total . '</td><td>' . $filas2['fecha_compra'] . '</td></tr>';
					}			
				?>
					
					</tbody>
				</table>
				<div>
						<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>		
				</div>
				
			</div>
				
		</div>
		
	</div>
	
</body>

</html>