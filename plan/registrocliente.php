<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de facturacion</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<div class="registro">
		<h1>Formulario de Registro</h1>
		<hr>
		<form action="" method="POST">
			<label for="nit">Nit:</label>
			<input type="text" name="nit" id="nit">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre">
			<label for="telefono">Telefono:</label>
			<input type="text" name="telefono" id="telefono">
			<label for="direccion">Direccion:</label>
			<input type="text" name="direccion" id="direccion">
			<input type="submit" name="" value="Guardar Cliente" class="guardar"> 
		</form>

	</div>
	
</body>
</html>