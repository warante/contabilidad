<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Stock</title>	
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link rel="icon" type="image/icon" href="../img/favicon.ico" />
	<link type="text/css" rel="stylesheet" href="../css/visualize.jQuery.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/visualize.jQuery.js"></script>
	<script type="text/javascript">
		
			$(function(){
			$('table')
   .visualize()
   .appendTo('body')
   .trigger('visualizeRefresh');
});
		</script>
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
			
			<table>
			<caption>Ventas por modelo</caption>
			<thead>
			
				<tr>
					<td></td>
			<?php 
				while($filas = mysql_fetch_array($venta))
				{
					echo '<th>' . $filas['fecha_venta'] . '</th>';
				}
			
			?>
				</tr>
			</thead>
			
			<tbody>
			<?php 
				while($filas2 = mysql_fetch_array($mod))
				{
					echo '	<tr>
								<th>' . $filas2['modelo'] . '</th>';
								$venta = mysql_query($sql_venta, $conn) or die(mysql_error());
								while($filas = mysql_fetch_array($venta))
								{
									if($filas['fecha_venta'] == $filas2['fecha_venta'])
									{
										echo '<td>' . $filas2['cantidad'] . '</td>';
									}
									else
									{
										echo '<td>0</td>';
									}								
					
								}
				}
			
			?>
				
			</tbody>
				<div>
					<input type="button" name="volver" id="volver" value="Volver" class="btn btn-large" onclick="window.location='../index.html'"/>		
				</div>
			</table>
			</div>
			
		</div>
	
</div>
</body>
</html>