<?php 
include "../conexion.php";
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de facturacion</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<section class="lista">
		<h1>Lista de usuarios</h1>
		<a href="registrocliente.php" class="newuser">Nuevo Cliente</a>
		<table>
			<tr>
				<th>ID</th>
				<th>Nit</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
			</tr>
			<?php 
			$sql=mysqli_query($conexion, "SELECT * FROM cliente");
			$resutl=mysqli_num_rows($sql);
			if ($resutl>0) {
				while ($data=mysqli_fetch_array($sql)) {
				?>	
					<tr>
						<td><?php echo $data['idcliente'] ?></td>
						<td><?php echo $data['nit'] ?></td>
						<td><?php echo $data['nombre'] ?></td>
						<td><?php echo $data['telefono'] ?></td>
						<td><?php echo $data['direccion'] ?></td>
						<td>
							<a href="" class="edit">Edit</a>
							||
							<a href="" class="delete">Delete</a>
						</td>
					</tr>
				<?php
				}
			}
			 ?>
			
		</table>
	</section>
	
</body>
</html>