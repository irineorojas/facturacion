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

	///mostrar producto

	if ($_POST['accion']=='infproductos'){
		$producto=$_POST['producto'];
		$query=mysqli_query($conexion,"SELECT codproducto, descripcion, existencia, precio FROM producto WHERE codproducto=$producto AND estado=1");
		$resulta=mysqli_num_rows($query);
		if ($resulta>0) {
			$data=mysqli_fetch_assoc($query);
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			exit;
			
		}
		
		echo 'error';
		exit;
	}

//agregar porducto
	if ($_POST['accion']=='agregaProducto') {
		if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
			echo "errorr";
		}else{
			$codproducto=$_POST['producto'];
			$cantidad=$_POST['cantidad'];
			$token=md5($_SESSION['idusuario']);
			
			$querytemp=mysqli_query($conexion, "CALL add_detalletemp($codproducto, $cantidad, '$token')");
			$resul=mysqli_num_rows($querytemp);

			$table='';
			$subTotal=0;
			$total=0;
			$arrayd=array();
			if ($resul>0) {
				while ($data=mysqli_fetch_assoc($querytemp)) {
					$preciot=round($data['cantidad']*$data['precio'],2);
					$subTotal=round($subTotal+$preciot, 2);
					$total=round($total+$preciot,2);

					$table .='<tr>
								<td>'.$data['codproducto'].'</td>
								<td colspan="2">'.$data['descripcion'].'</td>
								<td scope="col">'.$data['cantidad'].'</td>
								<td scope="col">'.$data['precio'].'</td>
								<td scope="col">'.$preciot.'</td>
								<td scope="col">
									<a href="" class="btn btn-danger btn-sm m-2" onclick="event.preventDefault(); aliminarprod('.$data['codproducto'].');">Eliminar</a>
								</td>
							</tr>';

				}

				$impuesto=round($subTotal*(18/100),2);
				$totaliva=round($subTotal-$impuesto,2);
				$total =round($totaliva+$impuesto,2);

				$detaltotal='<tr>
					    		<td colspan="5">SUBTOTAL Q.</td>
					    		<td>'.$totaliva.'</td>
					    	</tr>
					    	<tr>
					    		<td colspan="5">IVA (18%)</td>
					    		<td>'.$impuesto.'</td>
					    	</tr>
					    	<tr>
					    		<td colspan="5">TOTAL Q.</td>
					    		<td>'.$total.'</td>
					    	</tr>';

				$arrayd['detalle']=$table;
				$arrayd['totales']=$detaltotal;

				echo json_encode($arrayd,JSON_UNESCAPED_UNICODE);
			}else{
				echo "error";
			}
			//mysqli_close($conexion);
		}
		exit;
	}
	

	//mostrar detalle de producto
	if ($_POST['accion']=='mostDetalle') {
		if (empty($_POST['user'])) {
			echo "errorr";
		}else{
			$token=md5($_SESSION['idusuario']);

			$querys=mysqli_query($conexion, "SELECT tmp.correlativo, tmp.token,tmp.cantidad, tmp.precio, p.codproducto, p.descripcion FROM detalletemp tmp inner join producto p on tmp.codproducto=p.codproducto WHERE token = '$token'");
			
			$resul=mysqli_num_rows($querys);

			$table='';
			$subTotal=0;
			$total=0;
			$arrayd=array();
			if ($resul>0) {
				while ($data=mysqli_fetch_assoc($querys)) {
					$preciot=round($data['cantidad']*$data['precio'],2);
					$subTotal=round($subTotal+$preciot, 2);
					$total=round($total+$preciot,2);

					$table .='<tr>
								<td>'.$data['codproducto'].'</td>
								<td colspan="2">'.$data['descripcion'].'</td>
								<td scope="col">'.$data['cantidad'].'</td>
								<td scope="col">'.$data['precio'].'</td>
								<td scope="col">'.$preciot.'</td>
								<td scope="col">
									<a href="" class="btn btn-danger btn-sm m-2" onclick="event.preventDefault(); aliminarprod('.$data['codproducto'].');">Eliminar</a>
								</td>
							</tr>';

				}

				$impuesto=round($subTotal*(18/100),2);
				$totaliva=round($subTotal-$impuesto,2);
				$total =round($totaliva+$impuesto,2);

				$detaltotal='<tr>
					    		<td colspan="5">SUBTOTAL Q.</td>
					    		<td>'.$totaliva.'</td>
					    	</tr>
					    	<tr>
					    		<td colspan="5">IVA (18%)</td>
					    		<td>'.$impuesto.'</td>
					    	</tr>
					    	<tr>
					    		<td colspan="5">TOTAL Q.</td>
					    		<td>'.$total.'</td>
					    	</tr>';

				$arrayd['detalle']=$table;
				$arrayd['totales']=$detaltotal;

				echo json_encode($arrayd,JSON_UNESCAPED_UNICODE);
			}else{
				echo "error";
			}
			//mysqli_close($conexion);
		}
		exit;
	}
	
}
exit;
 ?>