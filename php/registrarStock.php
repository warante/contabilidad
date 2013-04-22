<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar stock</title>	
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
			$fecha = $_POST['fecha'];
			
			
			$insertar = "INSERT INTO `contabilidad`.`stock` (`cod_stock`, `modelo`, `distribuidor`, `cantidad`, `fecha`) VALUES ('$cod_stock', '$modelo', '$distribuidor', '$cantidad', '$fecha');";
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
			<form name="datos_registro" action="registrarStock.php" method="post" enctype="multipart/form-data">
				<h2>Datos de stock</h2>
				
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
				<input type="text" value="1" name="cantidad" id="cantidad"/>
				
				<p>Fecha</p>
				<input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>"/>
								
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>
					<input type="submit" name="registrar" id="registrar" value="Registrar" class="btn btn-primary btn-large"/>					
				</div>
			
			</form>
			</div>
			
		</div>
	
</div>
</body>
</html>