<?php 
include "../conexion.php";
if (!empty($_POST)) {
	if ($_POST['accion']=='infoProducto') {
		$codproducto=$_POST['producto'];
		$query =mysqli_query($conexion, "SELECT codproducto, descripcion FROM producto WHERE codproducto=$codproducto AND estado=1");
		mysqli_close($conexion);
		$result=mysqli_num_rows($query);
		if ($result>0) {
			$dato=mysqli_fetch_array($query);
	    	echo json_encode($dato, JSON_UNESCAPED_UNICODE);
			exit;
		}
		echo 'error';
		exit;	
	}
}
exit;
 ?>