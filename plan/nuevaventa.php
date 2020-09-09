<?php 
session_start();
include "../conexion.php";

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Agregar Ventas</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
	<?php include "header.php" ?>
	<div class="form-inline top">
	  <div class="form-group mb-2">
	    <h2>Nueva Venta</h2>
	  </div>
	  <a href="" class="newuser btncliente"><img src="img/plus.png"> Nuevo Cliente</a>
	</div>
	<div class="contener">
		<form id="formnewcliente" name="formnewcliente">
			<input type="hidden" name="newcliente" value="addcliente">
			<input type="hidden" name="idcliente" id="idcliente" required>
			<div class="form-group"  style="margin: auto; width: 200px">
		    	<span class="text" id="validatedInputGroupPrepend">DNI :</span>
		      	<input type="number" class="form-control" name="dniclie" id="dniclie">
		    </div>
		  <div>
		    <div class="" style=" width: 250px">
		        	<span class="text" id="validatedInputGroupPrepend">NOMBRE:</span>
		      	<input type="text" class="form-control" name="nombreclie" id="nombreclie" disabled required>
		    </div>
		    <div class="" style=" width: 250px">
				<span class="text" id="validatedInputGroupPrepend">TELEFONO:</span>
		      	<input type="number" class="form-control " name="telefonoclie" id="telefonoclie" disabled required>
		    </div>
		    <div class="mb-2">
		        <span class="text" id="validatedInputGroupPrepend">DIRECCION:</span>
		      	<input type="text" class="form-control " name="direccionclie" id="direccionclie" disabled required>
		    </div>
		  </div>
		   <a href="" class="btn btn-primary btn-lg mt-3" id="saves"><img src="img/save.png">Guardar</a>
		</form>
	</div>
	<div class="medio">
		<form class="form-row " style="display: flex; justify-content: space-between;">
			<div>
				<h3>Vendedor</h3>
				<p>Nombre del vendedor</p>
			</div>
			<div>
				<a href="" class="btn btn-secondary btn-sml m-2" id="btnanular">Anular</a>
				<a href="" class="btn btn-primary btn-sml m-2" id="btnproceso">Pocesar</a>
			</div>
		</form>
	</div>
	
	<div class="tabless">
		<table class="table">
			<thead class="thead-light">
				<tr>
			      <th width="100px" scope="col">Codigo</th>
			      <th scope="col">Descripcion</th>
			      <th scope="col">Existencia</th>
			      <th scope="col">Cantidad</th>
			      <th scope="col">Precio</th>
			      <th scope="col">Precio Total</th>
			      <th scope="col" >Accion</th>
			    </tr>
			    <tr>
			      <td><input type="text" name="codproduct" id="codproduct" placeholder="Codigo" style="width: 100px"></td>
			      <td>--</td>
			      <td>--</td>
			      <td> <input type="number" name="cantproduct" id="cantproduct" placeholder="Cantidad" style="width: 80px" disabled></td>
			      <td>00.00</td>
			      <td>00.0</td>
			      <td><a href="" class="btn btn-success btn-sm">Agregar</a></td>

			    </tr>
			    <thead class="thead-light">
				<tr>
				      <th scope="col">Codigo</th>
				      <th scope="col" colspan="2">Descripcion</th>
				      <th scope="col">Cantidad</th>
				      <th scope="col">Precio</th>
				      <th scope="col">Precio Total</th>
				      <th scope="col">Accion</th>
				</tr>
				</thead>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td colspan="2">Manzana</td>
					<td scope="col">1</td>
					<td scope="col">200.0</td>
					<td scope="col">300.0</td>
					<td scope="col">
						<a href="" class="btn btn-danger btn-sm m-2" >Eliminar</a>
					</td>
				</tr>
				<tr>
					<td>1</td>
					<td colspan="2">Manzana</td>
					<td scope="col">1</td>
					<td scope="col">200.0</td>
					<td scope="col">300.0</td>
					<td scope="col">
						<a href="" class="btn btn-danger btn-sm m-2">Eliminar</a>
					</td>
				</tr>
			</tbody>
		    <tfoot>
		    	<tr>
		    		<td colspan="5">SUBTOTAL Q.</td>
		    		<td>1000.0</td>
		    	</tr>
		    	<tr>
		    		<td colspan="5">IVA (18%)</td>
		    		<td>180</td>
		    	</tr>
		    	<tr>
		    		<td colspan="5">TOTAL Q.</td>
		    		<td>10000.0</td>
		    	</tr>
		    </tfoot>
		</table>
	</div>	

	<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
	<script src="js/querys.js"></script>
	
	
	
</body>
</html>