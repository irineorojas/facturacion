<?php 
include "../conexion.php";
if (!empty($_POST)) {
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['rol'])) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{
		$nombre=$_POST['nombre'];
		$correo=$_POST['correo'];
		$usuario=$_POST['usuario'];
		$password=md5($_POST['password']);
		$rol=$_POST['rol'];

		$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario='$usuario' or  correo='$correo'");
		$resul=mysqli_fetch_array($query);
		if ($resul>0) {
			echo '<script> alert("El usuario o el correo ya existe")</script>';
		}else{
			$insert=mysqli_query($conexion, "INSERT INTO usuario(nombre,correo,usuario,password,rol)
											VALUES('$nombre','$correo','$usuario','$password','$rol')");
			if ($insert) {
				echo '<script> alert("Se inserto con exito")</script>';
			}else{
			echo '<script> alert("fallo el registro")</script>';
			}
		}


	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Registro usuario</title>
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
		<h1>Registro de usuario</h1>
		<form action="" method="POST">
			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre">
			<label for="correo">Correo:</label>
			<input type="gmail" name="correo" id="correo">
			<label for="usuario">Usuario:</label>
			<input type="text" name="usuario" id="usuario">
			<label for="password">Contraseña:</label>
			<input type="password" name="password" id="password" minlength="4">
			<label for="rol">Tipo de Usuario:</label>
			<?php 
			$sql_rol=mysqli_query($conexion,"SELECT * FROM rol");
			$resul_rol=mysqli_num_rows($sql_rol);			
			?>
			<select name="rol" id="rol">
				<?php 
				if ($resul_rol>0) {
					while ($rol=mysqli_fetch_array($sql_rol)) {
				?>
					<option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol']; ?></option>
				<?php 
					}
				}

				 ?>
				 
			</select>
			<input type="submit" name="" value="Guardar Usuario" class="guardar"> 
		</form>

	</div>
	
</body>
</html>


