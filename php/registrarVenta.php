<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar Venta</title>	
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
			$cod_venta = time();
			$modelo = $_POST['modelo'];
			$distribuidor = $_POST['distribuidor'];
			$cantidad = $_POST['cantidad'];
			$fecha_venta = $_POST['fecha'];
			$estado = $_POST['estado'];
			$pvp_venta = $_POST['pvp_venta'];
			$pvp_beneficio = $_POST['pvp_beneficio'];
			$fecha_reg = date("d-m-y  G:i:s");
			
			$insertar = "INSERT INTO `contabilidad`.`venta` (`cod_venta`, `modelo`, `distribuidor`, `cantidad`, `fecha_venta`, `estado`, `pvp_venta`, `pvp_beneficios`, `fecha registro`) VALUES ('$cod_venta', '$modelo', '$distribuidor', '$cantidad', '$fecha_venta', '$estado', '$pvp_venta', '$pvp_beneficio', '$fecha_reg');";
			$result = mysql_query($insertar, $conn) or die(mysql_error());
			echo '<div class="alert alert-success"> Registro realizado con éxito </div>';
		}
		
		$sql_mod = "SELECT * FROM `modelo`";
		$mod = mysql_query($sql_mod, $conn) or die(mysql_error());
		
		$sql_dis = "SELECT * FROM `distribuidor`";
		$dis = mysql_query($sql_dis, $conn) or die(mysql_error());	
?>
		<div class="row-fluid">
		
			<div class="span6 thumbnail">
			<form name="datos_registro" action="registrarVenta.php" method="post" enctype="multipart/form-data">
				<h2>Datos de la venta</h2>
				
				<p>Módelo</p>
				<select name="modelo" id="modelo">
					<?php 
						while($filas = mysql_fetch_array($mod))
						{
							echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
						}
					?>
				</select>
				
				<p>Distribuidor</p>
				<select name="distribuidor" id="distribuidor">
					<?php 
						while($filas = mysql_fetch_array($dis))
						{
							echo '<option value="' . $filas['nombre'] . '">' . $filas['nombre'] . '</option>';
						}
					?>
				</select>
				
				<p>Cantidad</p>
				<input type="text" value="1" name="cantidad" id="cantidad"/>
				
				<p>Fecha</p>
				<input type="date" name="fecha" id="fecha"/>
				
				<p>Estado</p>
				<select name="estado" id="estado">
					<option value="pagado">Pagado</option>
					<option value="pendiente de pago">Pendiente de pago</option>
				</select>
				
				<p>Precio de venta</p>
				<input type="text" name="pvp_venta" id="pvp_venta" value="7" />
				
				<p>Precio beneficio</p>
				<input type="text" name="pvp_beneficio" id="pvp_beneficio" value="6" />
				
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large"/>
					<input type="submit" name="registrar" id="registrar" value="Registrar" class="btn btn-primary btn-large"/>					
				</div>
			
			</form>
			</div>
			
		</div>
	
</div>
</body>
</html>