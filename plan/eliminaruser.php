<?php 
include "../conexion.php";
if (!empty($_POST)) {
	$idusuario=$_POST['idusuario'];
	//$query=mysqli_query($conexion, "DELETE FROM usuario WHERE idusuario=$idusuario");
	$query=mysqli_query($conexion, "UPDATE usuario SET estado=0 WHERE idusuario='$idusuario'");

	if($query){
		header("Location: mostraruser.php");
	}else{
		echo "Fatal Error";
	}
}

if (empty($_REQUEST['id']) || $_REQUEST['id']==1) {
	header("Location: mostraruser.php");
}else{
	$iduser=$_REQUEST['id'];
	$sql=mysqli_query($conexion,"SELECT u.nombre, u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol= r.idrol WHERE u.idusuario= $iduser");
	$result=mysqli_num_rows($sql);
	if ($result>0) {
		while ($data=mysqli_fetch_array($sql)) {
			$nombre=$data['nombre'];
			$usuario=$data['usuario'];
			$rol=$data['rol'];
		}
	}else{
			header("Location: mostraruser.php");
		}
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Eliminar usruario</title>
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
		<p>Nombre: <span><?php echo $nombre; ?></span></p>
		<p>Usuario: <span><?php echo $usuario; ?></span></p>
		<p>Rol: <span><?php echo $rol; ?></span></p>
		<form class="operation" method="POST" action="">
			<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
			<input type="submit" value="Aceptar" class="aceptar">
			<a href="mostraruser.php" class="cancelar">Cancelar</a>
		</form>

	</div>
	
</body>
</html>