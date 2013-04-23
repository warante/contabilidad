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
					
					<?php 
						include_once('arrays.php');
						foreach($categorias as $i => $value)
						{
							echo '<li><a href="consultarGasMat.php?categoria=' . $categorias[$i] . '">' . $categorias[$i] . '</a></li>';
						}
					?>
				</ul>
				
				<?php
					foreach($categorias as $i => $value)
					{
						echo '<table class="table table-hover"> 
								<caption><h3><a href="consultarGasMat.php?categoria=' . $categorias[$i] . '">' . $categorias[$i] . '</a></h3></caption> 
							<thread> 
								<th>Cantidad</th><th>Pvp gasto</th><th>Acciones</th>
							</thread>
						<tbody>'; 
						
						$sql_mat = "SELECT * FROM `gastos` WHERE `categoria`LIKE '$categorias[$i]'";
						$mat = mysql_query($sql_mat, $conn) or die(mysql_error());	
						$cantidad_total = 0;
						$pvp_coste_total = 0;
						while($filas2 = mysql_fetch_array($mat))
						{									
							$cantidad_total += $filas2['cantidad'];
							$pvp_coste_total += $filas2['pvp'] * $filas2['cantidad'];
						}
						echo '<tr><td><b>' . $cantidad_total . '</b></td><td><b>' . $pvp_coste_total . '</b></td><td><button type="button" class="btn btn-success" onclick="window.location=\'registrarGastos.php?Categoria=' . $categorias[$i] . '\'">Comprar más</button></td>
							</tbody>
							</table>';			
					}
				?>	
				
				<div>
					<br />
						<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>		
						<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>							
						<input type="button" name="volver" id="volver" value="Ir a ganancias" class="btn btn-success btn-large" onclick="window.location='consultarGanancias.php'"/>			
						<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>
						<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>	
				</div>
				
			</div>
				
		</div>
		
	</div>
	
</body>

</html>