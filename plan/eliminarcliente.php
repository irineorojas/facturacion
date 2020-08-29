<?php 
session_start();
if ($_SESSION['idrol']!=1 AND $_SESSION['idrol']!=2) {
	header('Location: principal.php');
}
include "../conexion.php";
if (!empty($_POST)) {
	$idcliente=$_POST['idcliente']; 
	$query=mysqli_query($conexion, "UPDATE clinete SET estado=0 WHERE idcliente='$idcliente'");
	mysqli_close($conexion);
	if($query){
		header("Location: mostrarcliente.php");
	}else{
		echo "Fatal Error";
	}
}

if (empty($_REQUEST['id'])) {
	header("Location: mostrarcliente.php");
	mysqli_close($conexion);
}else{
	$idcliente=$_REQUEST['id'];
	$sql=mysqli_query($conexion,"SELECT * FROM clinete WHERE idcliente= $idcliente");
	mysqli_close($conexion);
	$result=mysqli_num_rows($sql);
	if ($result>0) {
		while ($data=mysqli_fetch_array($sql)) {
			$dni=$data['dni'];
			$nombre=$data['nombre'];
		}
	}else{
			header("Location: mostrarcliente.php");
		}
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Eliminar Cliente</title>
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
		<p>DNI: <span><?php echo $dni; ?></span></p>
		<p>NOMBRE: <span><?php echo $nombre; ?></span></p>
		<form class="operation" method="POST" action="">
			<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
			<input type="submit" value="Aceptar" class="aceptar">
			<a href="mostrarcliente.php" class="cancelar">Cancelar</a>
		</form>

	</div>
	
</body>
</html>