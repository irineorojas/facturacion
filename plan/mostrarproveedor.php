<?php 
session_start();
if ($_SESSION['idrol']!=1 && $_SESSION['idrol']!=2) {
	header('Location: principal.php');
}
include "../conexion.php";
if (isset($_GET['id'])) {
	$codproveedor=$_GET['id']; 
	$query=mysqli_query($conexion, "UPDATE proveedor SET estado=0 WHERE codproveedor='$codproveedor'");
	mysqli_close($conexion);
	if($query){
		header("Location: mostrarproveedor.php");
	}else{
		echo "Fatal Error";
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de Proveedor</title>
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
		<h1>Proveedores</h1>
		<a href="registroproveedor.php" class="newuser"><img src="img/plus.png"> Nuevo Proveedor</a>
		<form action="buscarproveedor.php" method="get" class="form-buscar">
			<input type="text" name="buscar" id="buscar" placeholder="Buscar" class="bbuscar">
			<input type="submit"  class="btn-buscar" value="Buscar">
		</form>
		<table class="tabla">
			<tr>
				<th>Codigo</th>
				<th>Proveedor</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Direccion</th>
				<th>Fecha</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
			<?php 

			$pag=mysqli_query($conexion,"SELECT COUNT(*) as total FROM proveedor where estado=1");
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

			$sql=mysqli_query($conexion, "SELECT * FROM proveedor WHERE estado=1 ORDER BY codproveedor ASC LIMIT $inicio,$porpagina");
			mysqli_close($conexion);
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
						<td><?php echo $data['fecha'] ?></td>
						<td>
							<a href="actualizarproveedor.php?id=<?php echo $data['codproveedor'] ?>" class="edit">Edit</a>
						</td>
						<td>
							<a href="mostrarproveedor.php?id=<?php echo $data['codproveedor'] ?>" class="delete">Delete</a>
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
				<?php } ?>
			</ul>
			
		</div>	
	</section>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
	
</body>
</html>