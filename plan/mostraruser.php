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
			$pag=mysqli_query($conexion,"SELECT COUNT(*) as total FROM usuario where estado=1");
			$resutado=mysqli_fetch_array($pag);
			$totalreg=$resutado['total'];

			$porpagina=6;
			if (empty($_GET['pagina'])) {
				$pagina=1;
			}else{
				$pagina=$_GET['pagina'];
			}

			$inicio=($pagina-1)*$porpagina;
			$totalpag=ceil($totalreg/$porpagina);

			$sql=mysqli_query($conexion, "SELECT u.idusuario,u.nombre,u.correo, u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol where estado=1 ORDER BY idusuario ASC LIMIT $inicio,$porpagina");
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
							<a href="actualizaruser.php?id=<?php echo $data['idusuario'] ?>" class="edit">Edit</a>
							<?php if ($data['idusuario']!=1) {?>
							||
							<a href="eliminaruser.php?id=<?php echo $data['idusuario'] ?>" class="delete">Delete</a>
						<?php } ?>
					</td>
					</tr>
				<?php
				}
			}
			 ?>
			
		</table>
		<div class="pagina">
			<ul>
				<?php if ($pagina!=1) {
		
				?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
				<?php 
				} 
				for ($i=1; $i <= $totalpag; $i++) { 
					if ($i==$pagina) {
						echo '<li class="selec">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				 } 
				 if ($pagina!=$totalpag) {
				 ?>
				<li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $totalpag; ?>">>|</a></li>
				<?php } ?>
			</ul>
			
		</div>	
	</section>
	
	
</body>
</html>