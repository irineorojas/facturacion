<?php 
include "../conexion.php";
//print_r($_POST); exit;
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
	
}
exit;
 ?>