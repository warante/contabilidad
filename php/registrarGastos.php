<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar gastos</title>	
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link rel="icon" type="image/icon" href="../img/favicon.ico" />	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
</head>
<body>

<div class="container">

<?php
		include("db.php");
		$conn = mysql_connect($server, $db_user, $db_pass) or die(mysql_error());
		mysql_select_db($database, $conn);
		
		if(isset($_POST['registrar']))
		{			
			//$codigo = $_POST['codigo'];
			$cod_gas = time();
			$categoria = $_POST['categoria'];
			$color = $_POST['color'];
			$pvp = $_POST['pvp'];
			$cantidad = $_POST['cantidad'];
			$fecha_compra = $_POST['fecha'];			
			$fecha_registro = date("d-m-y  G:i:s");
			
			
			$insertar = "INSERT INTO `contabilidad`.`gastos` (`cod_gas`, `categoria`, `color`, `pvp`, `cantidad`, `fecha_compra`, `fecha_registro`) VALUES ('$cod_gas', '$categoria', '$color', '$pvp', '$cantidad', '$fecha_compra', '$fecha_registro');";
			$result = mysql_query($insertar, $conn) or die(mysql_error());
			echo '<div class="alert alert-success"> Registro realizado con éxito </div>';
		}
		
		$sql_mat = "SELECT * FROM `material`";
		$mat = mysql_query($sql_mat, $conn) or die(mysql_error());
?>
		<div class="row-fluid">
		
			<div class="span6 thumbnail">
			<form name="datos_registro" action="registrarGastos.php" method="post" enctype="multipart/form-data">
				<h2>Datos de gasto</h2>
				
				<p>Categoria</p>
				<select name="categoria" id="categoria">
				<?php 
					if(isset($_GET['Categoria']))
					{
						echo '<option value="' . $_GET['Categoria'] . '">' . $_GET['Categoria'] . '</option>';
					}
					else
					{
					?>

									
					<option value="Diadema ancha">Diadema ancha</option>
					<option value="Diadema fina">Diadema fina</option>
					<option value="Forro">Forro</option>
					<option value="Goma eva">Goma eva</option>					
				
				<?php 
				}
				?>
				</select>
				
				<p>Color</p>
				<select name="color" id="color">
					<option value="Amarillo">Amarillo</option>
					<option value="Azul">Azul</option>
					<option value="Blanco">Blanco</option>
					<option value="Carne">Carne</option>
					<option value="Celeste">Celeste</option>
					<option value="Lila">Lila</option>
					<option value="Marrón claro">Marrón claro</option>
					<option value="Marrón oscuro">Marrón oscuro</option>
					<option value="Negro">Negro</option>
					<option value="Rojo">Rojo</option>
					<option value="Rosa">Rosa</option>
					<option value="Rosa claro">Rosa claro</option>
					<option value="Verde">Verde</option>
					<option value="Verde oscuro">Verde oscuro</option>
				</select>
				
				<p>Cantidad</p>
				<input type="text" value="1" name="cantidad" id="cantidad"/>
				
				<p>Pvp</p>
				<input type="text" name="pvp" id="pvp" placeholder="usar el punto para los decimales"/>
				
				<p>Fecha</p>
				<input type="date" name="fecha"  id="fecha" value="<?php echo date('Y-m-d'); ?>"/>
								
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