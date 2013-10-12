<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Borrar stock</title>	
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
			
			if(isset($_POST['borrar']))
			{		
				$modelo = $_POST['modelo'];
				$distribuidor = $_POST['distribuidor'];
				$cantidad = $_POST['cantidad'];
				$codigo = $_POST['codigo'];		
				
				$sql_stock = "SELECT * FROM `stock` WHERE `cod_stock` LIKE '" . $codigo . "'";
				$stock = mysql_query($sql_stock, $conn) or die(mysql_error());			
				$filas = mysql_fetch_array($stock);
				
				if($filas['cantidad'] > $cantidad)
				{
					$filas['cantidad'] = $filas['cantidad'] - $cantidad;
					$sql_actualizar = "UPDATE `stock` SET `cantidad` = '" . $filas['cantidad'] . "' WHERE `stock`.`cod_stock` = '" . $codigo . "'";
					$stock_act = mysql_query($sql_actualizar, $conn) or die(mysql_error());		
				}
				else
				{				
					$sql_borrar = "DELETE FROM `stock` WHERE `stock`.`cod_stock` = '" . $codigo . "'";
					$stock_borrar = mysql_query($sql_borrar, $conn) or die(mysql_error());				
				}	
		?>
				
				<div class="row-fluid">				
					<div class="span12 thumbnail">
						<div class="alert alert-success"> Stock borrado con éxito, venga! a producir! </div>
						<div>
							<br />
							<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>	
							<input type="button" name="registrar" id="registrar" value="Registrar stock" class="btn btn-primary btn-large" onclick="window.location='registrarStock.php'"/>			
							<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>			
							<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>							
							<input type="button" name="volver" id="volver" value="Ir a ganancias" class="btn btn-success btn-large" onclick="window.location='consultarGanancias.php'"/>			
							<input type="button" name="volver" id="volver" value="Ir a gastos" class="btn btn-success btn-large" onclick="window.location='consultarGastos.php'"/>	
							<input type="button" name="volver" id="volver" value="Cerrar sesion" class="btn btn-inverse btn-large" onclick="window.location='../index.php?salir=salir'"/>	
							<br />
						</div>
					</div>
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
				
					<div class="span12 thumbnail">
					
						<form name="datos_registro" action="borrarStock.php" method="post" enctype="multipart/form-data">
							<h2>Borrar stock</h2>
							<h4>Datos del estock a borrar (puede modificar la cantidad)</h4>
							
							<p>Módelo</p>
							<select name="modelo" id="modelo">
								<?php 
									echo '<option value="' . $fila['modelo'] . '">' . $fila['modelo'] . '</option>';
								?>
							</select>
							
							<p>Distribuidor</p>
							<select name="distribuidor" id="distribuidor">
								<?php 	
									echo '<option value="' . $fila['distribuidor'] . '">' . $fila['distribuidor'] . '</option>';
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
									
							<input type="text" name="codigo" id="codigo" class="fade" value="<?php echo $_GET['codigo'];?>" />		
							<div>
								<br />
								<input type="button" name="volver" id="volver" value="Principal" class="btn btn-large" onclick="window.location='index.php'"/>
								<input type="submit" name="borrar" id="borrar" value="Borrar" class="btn btn-primary btn-large"/>	
								<input type="button" name="volver" id="volver" value="Ir a stock" class="btn btn-success btn-large" onclick="window.location='consultarStock.php'"/>
								<input type="button" name="volver" id="volver" value="Ir a ventas" class="btn btn-success btn-large" onclick="window.location='consultarVenta.php'"/>
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