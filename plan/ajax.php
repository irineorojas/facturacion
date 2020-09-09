<?php 
include "../conexion.php";
//print_r($_POST); exit;
session_start();
if (!empty($_POST)) {

	/*buscar cliente*/
	if ($_POST['accion']=='clientes') {
		if (!empty($_POST['cliente'])) {
			$dni=$_POST['cliente'];

			$query=mysqli_query($conexion,"SELECT * FROM clinete WHERE dni like '$dni' AND estado=1");
			mysqli_close($conexion);
			$result=mysqli_num_rows($query);
			$data='';
			if ($result>0) {
				$data=mysqli_fetch_assoc($query);
			}else{
				$data=0;
			}
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}
		exit;
	}

	///agregar cliente

	if ($_POST['accion']=='addcliente'){
		print_r($_POST);

		$dni=$_POST['dniclie'];
		$nombre=$_POST['nombreclie'];
		$telefono=$_POST['telefonoclie'];
		$direccion=$_POST['direccionclie'];
		$id_usuario =$_SESSION['idusuario'];

		$insertar=mysqli_query($conexion,"INSERT INTO clinete (dni,nombre,telefono,direccion, idusuario) VALUES('$dni','$nombre','$telefono','$direccion', $id_usuario)");
		if ($insertar) {
			$idcliente=mysqli_insert_id($conexion);
			$mensa=$idcliente;
		}else{
			$mensa='error';
		}
		//mysqli_close($conexion);
		echo $mensa;
		exit;
	}
	
}
exit;
 ?>