<?php 
session_start();

include "../conexion.php";
if (!empty($_POST)) {
	if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$idcliente=$_POST['id'];
		$dni=$_POST['dni'];
		$nombre=$_POST['nombre'];
		$telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];

		$query = mysqli_query($conexion,"SELECT * FROM clinete WHERE (dni=$dni AND idcliente!=$idcliente)");
		$result=mysqli_fetch_array($query);
		if ($result >0) {
			echo '<script> alert("El numero de dni ya existe")</script>';
		}else{
				$actua=mysqli_query($conexion,"UPDATE clinete set dni='$dni', nombre='$nombre', telefono='$telefono', direccion='$direccion' WHERE idcliente=$idcliente");
			
			if ($actua) {
				echo '<script> alert("Se Actualizo con exito")</script>';
			}else{
			echo '<script> alert("fallo la actualizacion")</script>';
			}
		}


	}
	//mysqli_close($conexion);
}

if (empty($_REQUEST['id'])) {
	header('Location: mostraruser.php');
	mysqli_close($conexion);	
}
$idcliente=$_REQUEST['id'];
$sql=mysqli_query($conexion,"SELECT * FROM clinete WHERE idcliente=$idcliente");
mysqli_close($conexion);
$resultado=mysqli_num_rows($sql);
if ($resultado==0) {
	header('Location: mostrarcliente.php');
}else{
	while ($date=mysqli_fetch_array($sql)) {
		$idcliente=$date['idcliente'];
		$dni=$date['dni'];
		$nombre=$date['nombre'];
		$telefono=$date['telefono'];
		$direccion=$date['direccion'];
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Actualizar Cliente</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<div class="registro">
		<h1>Actualizar de Cliente</h1>
		<form action="" method="POST">
			<input type="hidden" name="id" value="<?php echo $idcliente; ?>">
			<label for="dni">Dni:</label>
			<input type="number" name="dni" id="dni" placeholder="Número de Dni" value="<?php echo $dni; ?>">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
			<label for="telefono">Telefono:</label>
			<input type="number" name="telefono" id="telefono" placeholder="Número de teléfono o celular" value="<?php echo $telefono; ?>">
			<label for="direccion">Direccion:</label>
			<input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $direccion; ?>">
			<input type="hidden" name="fecha">
			<button type="submit" class="guardar" name="guardar"><img src="img/update.png" class="save"> Actualizar Cliente</button>
			<div class="cancelaredit"><a href="mostrarcliente.php">Cancelar</a></div>
		</form>

	</div>
	
</body>
</html>


