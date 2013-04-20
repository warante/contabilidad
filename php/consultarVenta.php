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
		
		$sql_mod = "SELECT * FROM `modelo`";
		$mod = mysql_query($sql_mod, $conn) or die(mysql_error());
		
		$sql_venta = "SELECT * FROM `venta` ";
		$ventas = mysql_query($sql_venta, $conn) or die(mysql_error());
?>
		<div class="row-fluid">
		
			<div class="span6 thumbnail">
			<caption> Ventas de diademas por modelos</caption>
			
			<thead>
				<td></td>
			<?php 
				while($filas = mysql_fetch_array($mod))
				{
					echo '<th>' . $filas['nombre'] . '</th>';
				}
			?>
			</thead>
			
			</div>
			
		</div>
	
</div>
</body>
</html>