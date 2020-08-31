<?php 
session_start();
if ($_SESSION['idrol']!=1 && $_SESSION['idrol']!=2) {
	header('Location: principal.php');
}
require_once '../conexion.php';
if (isset($_POST['guardar'])) {
		
		$descripcion 	=$_POST['descripcion'];
		$precio 	=$_POST['precio'];
		$existencia 	=$_POST['existencia'];
		$proveedor 		=$_POST['proveedor'];
		$id_usuario =$_SESSION['idusuario'];
		$foto=$_FILES['foto'];
		$nombrefoto=$foto['name'];
		$type=$foto['type'];
		$urltemp=$foto['tmp_name'];
		$imgproduct='producto.png';

	if (empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['existencia']) || empty($_POST['proveedor']) ) {
		echo '<script> alert("No se permite campos vacios")</script>';
	}else{

		if ($nombrefoto!='') {
			$destino='img/productos/';
			$imgname='img_'.md5(date('m Y H:m:s'));
			$imgproduct=$imgname.'.jpg';
			$src=$destino.$imgproduct;
		}
			$insertar="INSERT INTO producto (descripcion,codproveedor,precio,existencia,idusuario, foto) VALUES('$descripcion','$proveedor','$precio','$existencia',$id_usuario, '$imgproduct')";
			
			$result=mysqli_query($conexion, $insertar);
			if ($result) {
				if ($nombrefoto!='') {
					move_uploaded_file($urltemp, $src);
				}
				echo '<script> alert("Se inserto con exito")</script>';
			}else{
			echo '<script> alert("fallo el registro")</script>';
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
	<title>Registro Producto</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript" src="js/uerys.js"></script>
</head>
<body>
	<?php include('header.php') ?>
	<div class="registro">
		<h1>Registro Producto</h1>
		<form action="" method="POST" enctype="multipart/form-data">
			<label for="descripcion">Producto:</label>
			<input type="text" name="descripcion" id="descripcion" placeholder="Nombre del producto">
			<label for="precio">Precio:</label>
			<input type="number" name="precio" id="precio" placeholder="Precio en soles">
			<label for="existencia">Existencia:</label>
			<input type="number" name="existencia" id="existencia" placeholder="Número de productos">
			<label for="proveedor">Proveedor:</label>
			<?php 
			include "../conexion.php";
			$sql_prov=mysqli_query($conexion,"SELECT codproveedor,proveedor FROM proveedor WHERE estado=1");
			mysqli_close($conexion);
			$resul_prov=mysqli_num_rows($sql_prov);			
			?>
			<select name="proveedor" id="proveedor">
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

			<div>
				<label for="foto">Foto:</label>
				<div class="cargar">
			        <input type="file" name="foto" id="foto">
			    </div>
			</div>
			<button type="submit" class="guardar" name="guardar"><img src="img/save.png" class="save"> Guardar Producto</button>
		</form>

	</div>
	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
</body>
</html>