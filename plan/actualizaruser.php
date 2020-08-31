<?php 
session_start();
if ($_SESSION['idrol']!=1) {
	header('Location: principal.php');
}
include "../conexion.php";
if (!empty($_POST)) {
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$idusuario=$_POST['idusuario'];
		$nombre=$_POST['nombre'];
		$correo=$_POST['correo'];
		$usuario=$_POST['usuario'];
		$password=md5($_POST['password']);
		$rol=$_POST['rol'];

		$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE (usuario='$usuario'and idusuario!=$idusuario) or  (correo='$correo' and idusuario!=$idusuario)");
		$resul=mysqli_fetch_array($query);
		if ($resul>0) {
			echo '<script> alert("El usuario o el correo ya existe")</script>';
		}else{
			if (empty($_POST['password'])) {
				$actua=mysqli_query($conexion,"UPDATE usuario SET nombre='$nombre', correo='$correo', usuario='$usuario',idrol='$rol' WHERE idusuario=$idusuario");
			}else{
				$actua=mysqli_query($conexion,"UPDATE usuario SET nombre='$nombre', correo='$correo', usuario='$usuario', password='$password', idrol='$rol' WHERE idusuario=$idusuario");
			}
			if ($actua) {
				echo '<script> alert("Se Actualizo con exito")</script>';
			}else{
			echo '<script> alert("fallo la actualizacion")</script>';
			}
		}


	}
	//mysqli_close($conexion);
}

//
if (empty($_GET['id'])) {
	header('Location: mostraruser.php');
	mysqli_close($conexion);	
}
$idusuario=$_GET['id'];
$sql=mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.idrol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r ON u.idrol=r.idrol WHERE idusuario=$idusuario and estado=1");
mysqli_close($conexion);
$resultado=mysqli_num_rows($sql);
if ($resultado==0) {
	header('Location: mostraruser.php');
}else{
	$option='';
	while ($date=mysqli_fetch_array($sql)) {
		$iduser=$date['idusuario'];
		$nombre=$date['nombre'];
		$correo=$date['correo'];
		$usuario=$date['usuario'];
		$idrol=$date['idrol'];
		$rol=$date['rol'];
		if ($idrol==1) {
			$option='<option value="'.$idrol.'" select>'.$rol.'</option>';
		}else if ($idrol==2) {
			$option='<option value="'.$idrol.'" select>'.$rol.'</option>';
		}else if ($idrol==3) {
			$option='<option value="'.$idrol.'" select>'.$rol.'</option>';
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Actualizar usuario</title>
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
		<h1>Actualizar de usuario</h1>
		<form action="" method="POST">
			<input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
			<label for="correo">Correo:</label>
			<input type="gmail" name="correo" id="correo" value="<?php echo $correo; ?>">
			<label for="usuario">Usuario:</label>
			<input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" minlength="4">
			<label for="rol">Tipo de Usuario:</label>
			<?php 
			include "../conexion.php";
			$sql_rol=mysqli_query($conexion,"SELECT * FROM rol");
			mysqli_close($conexion);
			$resul_rol=mysqli_num_rows($sql_rol);			
			?>
			<select name="rol" id="rol" class="notItem">
				<?php 
				echo $option;
				if ($resul_rol>0) {
					while ($rol=mysqli_fetch_array($sql_rol)) {
				?>
					<option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol']; ?></option>
				<?php 
					}
				}

				 ?>
			</select>
			<button type="submit" class="guardar" ><img src="img/update.png" class="save">Actualizar Usuario</button>
			<div class="cancelaredit"><a href="mostraruser.php">Cancelar</a></div>
		</form>

	</div>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
	
</body>
</html>


