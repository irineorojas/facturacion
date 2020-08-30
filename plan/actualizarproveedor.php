<?php 
session_start();

include "../conexion.php";
if (!empty($_POST)) {
	if (empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$codproveedor=$_POST['codproveedor'];
		$proveedor=$_POST['proveedor'];
		$contacto=$_POST['contacto'];
		$telefono=$_POST['telefono'];
		$direccion=$_POST['direccion'];

		$actua=mysqli_query($conexion,"UPDATE proveedor set proveedor='$proveedor', contacto='$contacto', telefono='$telefono', direccion='$direccion' WHERE codproveedor=$codproveedor");
			
			if ($actua) {
				echo '<script> alert("Se Actualizo con exito")</script>';
			}else{
			echo '<script> alert("fallo la actualizacion")</script>';
			}
		//}


	}
	//mysqli_close($conexion);
}

if (empty($_REQUEST['id'])) {
	header('Location: mostrarproveedor.php');
	mysqli_close($conexion);	
}
$codproveedor=$_REQUEST['id'];
$sql=mysqli_query($conexion,"SELECT * FROM proveedor WHERE codproveedor=$codproveedor");
mysqli_close($conexion);
$resultado=mysqli_num_rows($sql);
if ($resultado==0) {
	header('Location: mostrarproveedor.php');
}else{
	while ($date=mysqli_fetch_array($sql)) {
		$codproveedor=$date['codproveedor'];
		$proveedor=$date['proveedor'];
		$contacto=$date['contacto'];
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
			<input type="hidden" name="codproveedor" value="<?php echo $codproveedor; ?>">
			<label for="proveedor">Proveedor:</label>
			<input type="text" name="proveedor" id="proveedor" placeholder="Nombre de la empresa" value="<?php echo $proveedor; ?>">
			<label for="contacto">Contacto:</label>
			<input type="text" name="contacto" id="contacto" placeholder="Nombre completo " value="<?php echo $contacto; ?>">
			<label for="telefono">Telefono:</label>
			<input type="number" name="telefono" id="telefono" placeholder="Número de teléfono o celular" value="<?php echo $telefono; ?>">
			<label for="direccion">Direccion:</label>
			<input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $direccion; ?>">
			<button type="submit" class="guardar" name="guardar"><img src="img/update.png" class="save"> Actualizar Cliente</button>
			<div class="cancelaredit"><a href="mostrarproveedor.php">Cancelar</a></div>
		</form>

	</div>
	
</body>
</html>


