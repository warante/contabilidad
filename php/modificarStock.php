<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Modificar stock</title>	
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
		
		if(isset($_POST['registrar']))
		{			
			$cod_stock = time();
			$modelo = $_POST['modelo'];
			$distribuidor = $_POST['distribuidor'];
			$cantidad = $_POST['cantidad'];
			$codigo = $_POST['codigo'];
			$fecha = $_POST['fecha'];			
			
			$sql_stock = "SELECT * FROM `stock` WHERE `cod_stock` LIKE '" . $codigo . "'";
			$stock = mysql_query($sql_stock, $conn) or die(mysql_error());			
			$filas = mysql_fetch_array($stock);
			
			if($filas['cantidad'] > $cantidad)
			{
				$filas['cantidad'] = $filas['cantidad'] - $cantidad;
				$sql_actualizar = "SELECT * FROM `stock` WHERE `cod_stock` LIKE '" . $codigo . "'";
				$sql_actualizar = "UPDATE `contabilidad`.`stock` SET `cantidad` = '" . $filas['cantidad'] . "' WHERE `stock`.`cod_stock` = '" . $codigo . "'";
				$stock_act = mysql_query($sql_actualizar, $conn) or die(mysql_error());		
			}
			else
			{				
				$sql_borrar = "DELETE FROM `contabilidad`.`stock` WHERE `stock`.`cod_stock` = '" . $codigo . "'";
				$stock_borrar = mysql_query($sql_borrar, $conn) or die(mysql_error());				
			}
			
			
			$insertar = "INSERT INTO `contabilidad`.`stock` (`cod_stock`, `modelo`, `distribuidor`, `cantidad`, `fecha`) VALUES ('$cod_stock', '$modelo', '$distribuidor', '$cantidad', '$fecha');";
			$result = mysql_query($insertar, $conn) or die(mysql_error());
			?>
			
			<div class="alert alert-success"> Registro realizado con éxito, venga! a producir! </div>
			<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>			
			</div>
			<?php
		}
		
		else{
		
		$codigo = $_GET['codigo'];
		$sql_stock = "SELECT * FROM `stock` WHERE `cod_stock` LIKE '" . $codigo . "'";
		$stock = mysql_query($sql_stock, $conn) or die(mysql_error());			
		$fila = mysql_fetch_array($stock);
		
		$sql_dis = "SELECT * FROM `distribuidor`";
		$dis = mysql_query($sql_dis, $conn) or die(mysql_error());	
?>
		<div class="row-fluid">
		
			<div class="span6 thumbnail">
			<form name="datos_registro" action="modificarStock.php" method="post" enctype="multipart/form-data">
				<h2>Modificar stock</h2>
				<h4>Introduce el nuevo distribuidor, la cantidad que se desea transferir y la fecha</h4>
				
				<p>Módelo</p>
				<select name="modelo" id="modelo">
					<?php 
							echo '<option value="' . $fila['modelo'] . '">' . $fila['modelo'] . '</option>';

					?>
				</select>
				
				<p>Distribuidor</p>
				<select name="distribuidor" id="distribuidor">
					<?php 	
						while($filas = mysql_fetch_array($dis))
						{
							if($fila['distribuidor'] != $filas['nombre'])
							{
								echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
							}
						}
					?>
				</select>
				
				<p>Cantidad</p>
				<?php 
					if(isset($fila['cantidad'])){
						echo '<select name="cantidad" id="cantidad">';
						for($i=1; $i<=$fila['cantidad']; $i++)
						{
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
						echo '</select>';
					}
					else
					{
						echo '<input type="text" value="1" name="cantidad" id="cantidad"/>';
					}
				
				?>
				
				<p>Fecha</p>
				<input type="date" name="fecha" id="fecha"/>
				
				<p>Codigo</p>
				<input type="text" name="codigo" id="codigo" value="<?php echo $_GET['codigo'];?>" />
								
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>
					<input type="submit" name="registrar" id="registrar" value="Registrar" class="btn btn-primary btn-large"/>					
				</div>
			
			</form>
			</div>
			
		</div>
		<?php 
		}
		?>
	
</div>
</body>
</html>