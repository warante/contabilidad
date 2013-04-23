<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar gastos</title>	
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
		
		$sql_mat = "SELECT * FROM `gastos`";
		$mat = mysql_query($sql_mat, $conn) or die(mysql_error());	
		
?>
		<div class="row-fluid">
		
			<div class="span12 thumbnail">
			<ul class="nav nav-pills">
				<li class="active"><a href="#">Todos</a></li>
				<li><a href="consultarGasMat.php?categoria=Diadema ancha">Diadema ancha</a></li>
				<li><a href="consultarGasMat.php?categoria=Diadema fina">Diadema fina</a></li>
				<li><a href="consultarGasMat.php?categoria=Forro">Forro</a></li>
				<li><a href="consultarGasMat.php?categoria=Goma eva">Goma eva</a></li>
			</ul>
			
			<?php
			$array = array('Diadema ancha', 'Diadema fina', 'Forro', 'Goma eva');
					foreach($array as $i => $value)
					{
						echo '<table class="table table-hover"> 
								<caption><h3><a href="consultarGasMat.php?categoria=' . $array[$i] . '">' . $array[$i] . '</a></h3></caption> 
							<thread> 
								<th>Cantidad</th><th>Pvp gasto</th><th>Acciones</th>
							</thread>
						<tbody>'; 
						
						$sql_mat = "SELECT * FROM `gastos` WHERE `categoria`LIKE '$array[$i]'";
						$mat = mysql_query($sql_mat, $conn) or die(mysql_error());	
						$cantidad_total = 0;
						$pvp_coste_total = 0;
						while($filas2 = mysql_fetch_array($mat))
						{			
							//echo '<tr><td>' . $filas2['distribuidor'] . '</td><td>' . $filas2['cantidad'] . '</td><td>' . $filas2['pvp_venta'] . '</td><td>' . $filas2['pvp_beneficios'] . '</td><td>' . $filas2['fecha_venta'] . '</td>	</tr>';
							$cantidad_total += $filas2['cantidad'];
							$pvp_coste_total += $filas2['pvp'] * $filas2['cantidad'];
						}
						echo '<tr><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_coste_total . '</b></td><td><button type="button" class="btn btn-success" onclick="window.location=\'registrarGastos.php?Categoria=' . $array[$i] . '\'">Comprar</button></td>
						</tbody>
					</table>';			
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