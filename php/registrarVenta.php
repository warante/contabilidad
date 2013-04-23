<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Registrar Venta</title>	
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
			
			if(isset($_POST['registrar']))
			{			
				$cod_venta = time();
				$modelo = $_POST['modelo'];
				$distribuidor = $_POST['distribuidor'];
				$cantidad = $_POST['cantidad'];
				$fecha_venta = $_POST['fecha'];
				$estado = $_POST['estado'];
				$pvp_venta = $_POST['pvp_venta'];
				$pvp_beneficio = $_POST['pvp_beneficio'];
				$codigo = $_POST['codigo'];
				$fecha_reg = date("d-m-y  G:i:s");
				
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
								
				$insertar = "INSERT INTO `contabilidad`.`venta` (`cod_venta`, `modelo`, `distribuidor`, `cantidad`, `fecha_venta`, `estado`, `pvp_venta`, `pvp_beneficios`, `fecha_registro`) VALUES ('$cod_venta', '$modelo', '$distribuidor', '$cantidad', '$fecha_venta', '$estado', '$pvp_venta', '$pvp_beneficio', '$fecha_reg');";
				$result = mysql_query($insertar, $conn) or die(mysql_error());
		?>
				<div class="alert alert-success"> Registro realizado con éxito, venga! a producir! </div>
				<div>
						<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>			
				</div>
		<?php
				
			}
			else
			{			
				$sql_mod = "SELECT * FROM `modelo`";
				$mod = mysql_query($sql_mod, $conn) or die(mysql_error());
				
				$sql_dis = "SELECT * FROM `distribuidor`";
				$dis = mysql_query($sql_dis, $conn) or die(mysql_error());	
		?>
				<div class="row-fluid">
				
					<div class="span12 thumbnail ">
					
						<form name="datos_registro" action="registrarVenta.php" method="post" enctype="multipart/form-data">
							<h2>Datos de la venta</h2>
							
							<p>Módelo</p>
							<select name="modelo" id="modelo">
								<?php 
								if(isset($_GET['modelo'])){
									echo '<option value="' . $_GET['modelo'] . '">' . $_GET['modelo'] . '</option>';
								}
								else
								{					
									while($filas = mysql_fetch_array($mod))
									{
										echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
									}
								}
								?>
							</select>
							
							<p>Distribuidor</p>
							<select name="distribuidor" id="distribuidor">
								<?php 
								if(isset($_GET['distribuidor'])){
									echo '<option value="' . $_GET['distribuidor'] . '">' . $_GET['distribuidor'] . '</option>';
								}
								else
								{		
									while($filas = mysql_fetch_array($dis))
									{
										echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
									}
								}
								?>
							</select>
							
							<p>Cantidad</p>
							<?php 
								if(isset($_GET['cantidad'])){
									echo '<select name="cantidad" id="cantidad">';
									for($i=1; $i<=$_GET['cantidad']; $i++)
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
							<input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>"/>
							
							<p>Estado</p>
							<select name="estado" id="estado">
								<option value="pagado">Pagado</option>
								<option value="pendiente de pago">Pendiente de pago</option>
							</select>
							
							<p>Precio de venta</p>
							<input type="text" name="pvp_venta" id="pvp_venta" value="7" />
							
							<p>Precio beneficio</p>
							<input type="text" name="pvp_beneficio" id="pvp_beneficio" value="6" />
							<input type="text" name="codigo" id="codigo" class="fade" value="<?php echo $_GET['codigo'];?>" />
							
							<div>
								<br />
								<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>
								<input type="submit" name="registrar" id="registrar" value="Registrar" class="btn btn-primary btn-large"/>
								<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>
								<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>
								<input type="button" name="volver" id="volver" value="Ir a ganancias" class="btn btn-success btn-large" onclick="window.location='consultarGanancias.php'"/>
						<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>																	
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