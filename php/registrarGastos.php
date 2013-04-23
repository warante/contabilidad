<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Registrar gastos</title>	
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
			require_once('arrays.php');
		?>
		<div class="row-fluid">
			
			<div class="span12 thumbnail">
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
							foreach($categorias as $i => $value)
							{
								echo '<option value="' . $categorias[$i] . '">' . $categorias[$i] . '</option>' ;
							}
						}
					?>
					</select>
						
					<p>Color</p>
					<select name="color" id="color">
					
					<?php										
						foreach($colores as $i => $value)
						{
							echo '<option value="' . $colores[$i] . '">' . $colores[$i] . '</option>' ;
						}				
					?>
					</select>
						
					<p>Cantidad (unidades o metros)</p>
					<input type="text" name="cantidad" id="cantidad" placeholder="usar el punto para los decimales"/>
						
					<p>Pvp (por unidad o metro)</p>
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