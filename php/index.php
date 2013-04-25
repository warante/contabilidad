<?php
	require('sesion.php');
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Contabilidad</title>	
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="../css/general.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>
</head>

<body>
	<div class="container">		
	
		<div id="cuerpo" class="row-fluid">
		
			<div class="row-fluid">
				<div class="span6 offset3">			
					<br />
					<div id="myCarousel" class="carousel slide">
						<ol class="carousel-indicators">
						  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						  <li data-target="#myCarousel" data-slide-to="1"></li>
						  <li data-target="#myCarousel" data-slide-to="2"></li>
						  <li data-target="#myCarousel" data-slide-to="3"></li>
						  <li data-target="#myCarousel" data-slide-to="4"></li>
						  <li data-target="#myCarousel" data-slide-to="5"></li>
						  <li data-target="#myCarousel" data-slide-to="6"></li>
						</ol>
						<div class="carousel-inner">
							<div class="active item">
								<img src="../img/1.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Draculaura</h4>
								  <p>Producto estrella</p>
								</div>
							</div>
							<div class="item">
								<img src="../img/2.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Loba</h4>
								  <p>La favorita de las madres</p>
								</div>
							</div>
							<div class="item">
								<img src="../img/3.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Frankie</h4>
								  <p>No es gran cosa...</p>
								</div>
							</div>
							  <div class="item">
								<img src="../img/4.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Bob esponja</h4>
								  <p>El maldito</p>
								</div>
							</div>
							<div class="item">
								<img src="../img/5.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Yelps</h4>
								  <p>Una vez se vendio una</p>
								</div>
							</div>
							<div class="item">
								<img src="../img/6.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Cleo</h4>
								  <p>Mucho ruido y pocas nueces</p>
								</div>
							</div>
							<div class="item">
								<img src="../img/7.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Hello Kitty</h4>
								  <p>El aspirante a producto estrella</p>
								</div>
							</div>
						</div>
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
					  </div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span6 thumbnail">			
				<fieldset>
					<a href="registrarVenta.php" class="btn btn-large btn-block btn-success">Registrar venta</a>
					<a href="registrarStock.php" class="btn btn-large btn-block btn-success">Registrar stock</a>
					<a href="registrarGastos.php" class="btn btn-large btn-block btn-success">Registrar gastos</a>
				</fieldset>	
				</div>
				
				<div class="span6 thumbnail">
				<fieldset>
					<a href="consultarVenta.php" class="btn btn-large btn-block btn-primary">Consultar ventas</a>
					<a href="consultarStock.php" class="btn btn-large btn-block btn-primary">Consultar stock</a>
					<a href="consultarGastos.php" class="btn btn-large btn-block btn-primary">Consultar gastos</a>
				</legend>
				</div>			
			</div>
			
			<div class="row-fluid">
				<div class="span10 thumbnail">
					<fieldset>
						<a href="consultarGanancias.php" class="btn btn-large btn-block btn-danger">Consultar Ganancias</a>						
					</fieldset>
				</div>
				<div class="span2 thumbnail">
					<fieldset>
						<a href="../index.php?salir=salir" class="btn btn-large btn-block btn-inverse">Cerrar sesion</a>						
					</fieldset>
				</div>
			</div>					
			
		</div>
		
	</div>
	
</body>

</html>