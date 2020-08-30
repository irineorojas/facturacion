<?php 
session_start();
if ($_SESSION['idrol']!=1 AND $_SESSION['idrol']!=2) {
	header('Location: principal.php');
}
include "../conexion.php";
if (!empty($_POST)) {
	$codproveedor=$_POST['codproveedor']; 
	$query=mysqli_query($conexion, "UPDATE proveedor SET estado=0 WHERE codproveedor='$codproveedor'");
	mysqli_close($conexion);
	if($query){
		header("Location: mostrarproveedor.php");
	}else{
		echo "Fatal Error";
	}
}

if (empty($_REQUEST['id'])) {
	header("Location: mostrarproveedor.php");
	mysqli_close($conexion);
}else{
	$codproveedor=$_REQUEST['id'];
	$sql=mysqli_query($conexion,"SELECT * FROM proveedor WHERE codproveedor= $codproveedor");
	mysqli_close($conexion);
	$result=mysqli_num_rows($sql);
	if ($result>0) {
		while ($data=mysqli_fetch_array($sql)) {
			$proveedor=$data['proveedor'];
			$contacto=$data['contacto'];
		}
	}else{
			header("Location: mostrarproveedor.php");
		}
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Eliminar Proveedor</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<div class="delete_form">
		<h2>¿Esta seguro que quiere eliminar?</h2>
		<p>PROVEEDOR: <span><?php echo $proveedor; ?></span></p>
		<p>CONTACTO: <span><?php echo $contacto; ?></span></p>
		<form class="operation" method="POST" action="">
			<input type="hidden" name="codproveedor" value="<?php echo $codproveedor; ?>">
			<input type="submit" value="Aceptar" class="aceptar">
			<a href="mostrarproveedor.php" class="cancelar">Cancelar</a>
		</form>

	</div>
	
</body>
</html>