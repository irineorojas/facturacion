<?php 
session_start();
require_once '../conexion.php';
if (isset($_POST['guardar'])) {
		$dni 		=$_POST['dni'];
		$nombre 	=$_POST['nombre'];
		$telefono 	=$_POST['telefono'];
		$direccion 	=$_POST['direccion'];
		$id_usuario =$_SESSION['idusuario'];

	if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$query = mysqli_query($conexion,"SELECT * FROM clinete WHERE dni='$dni'");
		$resul=mysqli_fetch_array($query);
		if ($resul>0){
			echo '<script> alert("El número Dni ya existe")</script>';
		}else{
			$insertar="INSERT INTO clinete (dni,nombre,telefono,direccion,idusuario) VALUES('$dni','$nombre','$telefono','$direccion',$id_usuario)";
			$result=mysqli_query($conexion, $insertar);
			if ($result) {
				echo '<script> alert("Se inserto con exito")</script>';
			}else{
			echo '<script> alert("fallo el registro")</script>';
			}
		}
		

	}
	mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Registro Cliente</title>
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
		<h1>Registro Cliente</h1>
		<form action="" method="POST">
			<label for="dni">Dni:</label>
			<input type="number" name="dni" id="dni" placeholder="Número de Dni">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
			<label for="telefono">Telefono:</label>
			<input type="number" name="telefono" id="telefono" placeholder="Número de teléfono o celular">
			<label for="direccion">Direccion:</label>
			<input type="text" name="direccion" id="direccion" placeholder="Dirección">
			<input type="hidden" name="fecha">
			<button type="submit" class="guardar" name="guardar"><img src="img/save.png" class="save"> Guardar Cliente</button>
		</form>

	</div>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
</body>
</html>