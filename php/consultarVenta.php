<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar venta</title>	
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
		
		$sql_mod = "SELECT * FROM `venta` ORDER BY `modelo`";
		$mod = mysql_query($sql_mod, $conn) or die(mysql_error());
		
		
?>
		<div class="row-fluid">
		
			<div class="span12 thumbnail">
			<h1>Ventas por modelos</h1>

			
			<h1>Ventas por distribuidor</h1>
			
			<h1>Ventas por fecha<h1>
			
			</div>
			
		</div>
	
</div>
</body>
</html>