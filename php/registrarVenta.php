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
		<div class="row-fluid">
		
			<div class="span6 thumbnail">
				<h2>Datos de la venta</h2>
				
				<p>Módelo</p>
				<select name="modelo" id="modelo">
					<option value=""></option>
				</select>
				
				<p>Distribuidor</p>
				<select name="distribuidor" id="distribuidor">
					<option value=""></option>
				</select>
				
				<p>Cantidad</p>
				<input type="text" value="1" />
				
				<p>Fecha</p>
				<input type="date" name="fecha" id="fecha"/>
				
				<p>Estado</p>
				<select name="estado" id="estado">
					<option value="pagado">Pagado</option>
					<option value="pendiente de pago">Pendiente de pago</option>
				</select>
				
				
				
				
				
				<p>Nombre de usuario</p>
				<input type="text" placeholder="nombre"/>
				<p>Contraseña</p>
				<input type="password"/>
				<div>
					<input type="button" value="Cancelar" class="btn btn-large"/>
					<input type="submit" value="Entrar" class="btn btn-primary btn-large"/>					
				</div>
			</div>
			<div class="span6 thumbnail">
				<h2>Registro</h2>
				<p>Nombre</p>
				<input type="text"/>
				<p>Apellidos</p>
				<input type="text"/>
				<p>Nombre de usuario</p>
				<input type="text"/>
				
				<div>
					<input type="button" value="Cancelar" class="btn btn-large"/>
					<input type="submit" value="Registrar" class="btn btn-primary btn-large"/>					
				</div>
			</div>
		</div>
	
</div>
</body>
</html>