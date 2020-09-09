<?php 
session_start();
if ($_SESSION['idrol']!=1 && $_SESSION['idrol']!=2) {
	header('Location: principal.php');
}
require_once '../conexion.php';
if (!empty($_POST)) {
	if (empty($_POST['descripcion']) || empty($_POST['precio'])  ) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$codproducto=$_POST['codproducto'];
		$descripcion=$_POST['descripcion'];
		$precio=$_POST['precio'];
	
		$actua=mysqli_query($conexion,"UPDATE producto set descripcion='$descripcion', precio='$precio' WHERE codproducto=$codproducto");
			
			if ($actua) {
				echo '<script> alert("Se Actualizo con exito")</script>';
			}else{
			echo '<script> alert("fallo la actualizacion")</script>';
			}


	}
	mysqli_close($conexion);
}
if (empty($_REQUEST['id'])) {
	header('Location: mostrarproducto.php');
}else{
	$codproducto=$_REQUEST['id'];

	$sql=mysqli_query($conexion,"SELECT pr.codproducto, pr.descripcion, pr.precio,p.codproveedor, p.proveedor, pr.foto FROM producto pr INNER JOIN proveedor p ON pr.codproveedor=p.codproveedor WHERE pr.codproducto=$codproducto and pr.estado =1");
	mysqli_close($conexion);
	$resultado=mysqli_num_rows($sql);
	if ($resultado>0) {
		$date=mysqli_fetch_assoc($sql);
		
	}else{
		header('Location: mostrarproducto.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Actualizar Producto</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<div class="registro">
		<h1>Actualizar Producto</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">
			<label for="descripcion">Producto:</label>
			<input type="text" name="descripcion" id="descripcion" placeholder="Nombre del producto" value="<?php echo $date['descripcion']; ?>">
			<label for="precio">Precio:</label>
			<input type="number" name="precio" id="precio" placeholder="Precio en soles" value="<?php echo $date['precio']; ?>">
			<label for="proveedor">Proveedor:</label>
			<?php 
			include "../conexion.php";
			$sql_prov=mysqli_query($conexion,"SELECT codproveedor,proveedor FROM proveedor WHERE estado=1");
			mysqli_close($conexion);
			$resul_prov=mysqli_num_rows($sql_prov);			
			?>
			<select name="proveedor" id="proveedor" class="notItem">
				<option  value="<?php echo $date['codproveedor']; ?>" selected><?php echo $date['proveedor']; ?></option>
				<?php 
				if ($resul_prov>0) {
					while ($rol=mysqli_fetch_array($sql_prov)) {
				?>
					<option value="<?php echo $rol['codproveedor']; ?>"><?php echo $rol['proveedor']; ?></option>
				<?php 
					}
				}

				 ?>
				 
			</select>
			<button type="submit" class="guardar" name="guardar"><img src="img/update.png" class="save"> Actualizar Producto</button>
			<div class="cancelaredit"><a href="mostrarproducto.php">Cancelar</a></div>
		</form>

	</div>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
</body>
</html>