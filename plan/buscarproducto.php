<?php 
session_start();
include "../conexion.php";

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Lista de Producto</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/querys.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<section class="lista">
		<?php 
		$buscar=strtolower($_REQUEST['buscar']);
		if(empty($buscar)) {
			header('Location: mostrarproducto.php');
			mysqli_close($conexion);
		}

		 ?>
		<h1>Productos</h1>
		<a href="registroproducto.php" class="newuser"><img src="img/plus.png"> Nuevo Porducto</a>
		<form action="buscarproducto.php" method="get" class="form-buscar">
			<input type="text" name="buscar" id="buscar" placeholder="Buscar producto o por codigo" class="bbuscar">
			<input type="submit"  class="btn-buscar" value="Buscar">
		</form>
		<table>
			<tr>
				<th>Codigo</th>
				<th>Producto</th>
				<th>Proveedor</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Foto</th>
				<th>Fecha</th>
				<?php if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2) { ?>
				<th>Editar</th>
				<th>Eliminar</th>
			<?php } ?>
			</tr>
			<?php 

			$pag=mysqli_query($conexion,"SELECT COUNT(*) as total FROM producto where (codproducto like '%$buscar%' or descripcion like '%buscar%') and estado=1");

			$resutado=mysqli_fetch_array($pag);
			$totalreg=$resutado['total'];

			$porpagina=4;
			if (empty($_GET['pagina'])) {
				$pagina=1;
			}else{
				$pagina=$_GET['pagina'];
			}

			$inicio=($pagina-1)*$porpagina;
			$totalpag=ceil($totalreg/$porpagina);

			$sql=mysqli_query($conexion, "SELECT pr.codproducto, pr.descripcion, p.proveedor, pr.precio, pr.existencia, pr.foto, pr.fecha FROM producto pr INNER JOIN proveedor p ON pr.codproveedor=p.codproveedor WHERE (pr.codproducto like '%$buscar%' or pr.descripcion like '%$buscar%') and pr.estado=1 ORDER BY pr.codproducto ASC LIMIT $inicio,$porpagina");
			mysqli_close($conexion);
			$resutl=mysqli_num_rows($sql);
			if ($resutl>0) {
				while ($data=mysqli_fetch_array($sql)) {
					if ($data['foto'] !='producto.png') {
						$foto='img/productos/'.$data['foto'];
					}else{
						$foto='img/'.$data['foto'];
					}
				?>	
					<tr>
						<td><?php echo $data['codproducto'] ?></td>
						<td><?php echo $data['descripcion'] ?></td>
						<td><?php echo $data['proveedor'] ?></td>
						<td><?php echo $data['precio'] ?></td>
						<td><?php echo $data['existencia'] ?></td>
						<td> <img src="<?php echo $foto; ?>" alt="<?php echo $data['descripcion'] ?>"></td>
						<td><?php echo $data['fecha'] ?></td>
						<?php if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2) { ?>
						<td>
							<a href="actualizarproducto.php?id=<?php echo $data['codproducto'] ?>" class="edit">Edit</a>
						</td>
						<td>
							<a href="mostrarproducto.php?id=<?php echo $data['codproducto'] ?>" class="delete">Delete</a>
						</td>
					<?php } ?>
					</tr>
				<?php
				}
			}
			 ?>
			
		</table>
		<?php 
		if ($totalreg!=0) {
		
		 ?>
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
		<?php
		}else{
		?>	
		<p style="text-align: center; font-size: 20px; margin-top: 20px">NO SE ENCUENTRA REGISTRADO LA PALABRA "<?php echo $buscar; ?>"</p>
		<?php	
		}

		 ?>	
	</section>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
	
</body>
</html>