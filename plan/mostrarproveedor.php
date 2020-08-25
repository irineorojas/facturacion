<?php include "../conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Mostrar Porveedor</title>
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
		<h1>Lista de Proveedores</h1>
		<a href="registroproveedor.php" class="newuser">Nuevo Proveedor</a>
		<table>
			<tr>
				<th>ID</th>
				<th>Proveedor</th>
				<th>Contacto</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Acción</th>
			</tr>
			<?php 
			$sql=mysqli_query($conexion, "SELECT * FROM proveedor");
			$resutl=mysqli_num_rows($sql);
			if ($resutl>0) {
				while ($data=mysqli_fetch_array($sql)) {
				?>	
					<tr>
						<td><?php echo $data['codproveedor'] ?></td>
						<td><?php echo $data['proveedor'] ?></td>
						<td><?php echo $data['contacto'] ?></td>
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