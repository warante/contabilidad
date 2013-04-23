<?php 
		session_start();	
		$mostrar = 0;
		if(isset($_POST['entrar']))
		{
			if($_POST['pass'] == 'davilitomio')
			{
				$_SESSION['acceso'] = 'permitido';
				header('Location: php/index.php');
			}
			else
			{
				$mostrar = 1;
			}
		}
?>
<!DOCTYPE HTML>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Contabilidad</title>	
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
	<link href="css/general.css" rel="stylesheet" media="screen">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>
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
						</ol>
						<div class="carousel-inner">
							<div class="active item">
								<img src="img/1.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Draculaura</h4>
								  <p>Producto estrella</p>
								</div>
							</div>
							<div class="item">
								<img src="img/2.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Loba</h4>
								  <p>La favorita de las madres</p>
								</div>
							</div>
							<div class="item">
								<img src="img/3.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Frankie</h4>
								  <p>No es gran cosa...</p>
								</div>
							</div>
							  <div class="item">
								<img src="img/4.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Bob esponja</h4>
								  <p>El maldito</p>
								</div>
							</div>
							<div class="item">
								<img src="img/5.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Yelps</h4>
								  <p>Una vez se vendio una</p>
								</div>
							</div>
							<div class="item">
								<img src="img/6.jpg" alt="">
								<div class="carousel-caption">
								  <h4>Cleo</h4>
								  <p>Mucho ruido y pocas nueves</p>
								</div>
							</div>
							<div class="item">
								<img src="img/7.jpg" alt="">
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
				<div class="span4 thumbnail offset4">	
					<form name="datos_acceso" action="index.php" method="post" enctype="multipart/form-data">	
						<h4>Página privada, introduzca la contraseña</h4>
						<input name="pass" id="pass" type="password"/>
						<input name="entrar" id="entrar" type="submit" value="Entrar" class="btn btn-primary btn-large"/>	
						<?php
							if($mostrar == 1)
							{
								echo '<p class="text-error">La contraseña introducida no es correcta</p>';
							}
						?>
					</form>
				</div>			
			</div>
			<br />		
			
		</div>
		
	</div>
	
</body>

</html>