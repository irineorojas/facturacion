<?php 
include "../conexion.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de usuarios</title>
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
		<a href="registrouser.php" class="newuser">Nuevo usuario</a>
		<table>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Accion</th>
			</tr>
			<?php 
			$sql=mysqli_query($conexion, "SELECT u.idusuario,u.nombre,u.correo, u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
			$resutl=mysqli_num_rows($sql);
			if ($resutl>0) {
				while ($data=mysqli_fetch_array($sql)) {
				?>	
					<tr>
						<td><?php echo $data['idusuario'] ?></td>
						<td><?php echo $data['nombre'] ?></td>
						<td><?php echo $data['correo'] ?></td>
						<td><?php echo $data['usuario'] ?></td>
						<td><?php echo $data['rol'] ?></td>
						<td>
							<a href="actualizaruser.php" class="edit">Edit</a>
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