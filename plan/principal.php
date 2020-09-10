<?php session_start(); 
	if (empty($_SESSION['active'])) {
	    header('Location: ../');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de facturacion</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<?php include "meses.php"; ?>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<header class="headerr">
		<h1>Sistema de facturación</h1>
		<div class="banner">
			<span class="usuario"><?php echo $_SESSION['nombre'].'-'.$_SESSION['idrol']; ?></span>
			<img class="foto" src="img/user.png">
			<a href="cerrar.php"><img class="cerrar" src="img/salir.png" alt="Salir de la pagina" title="Salir"></a>
		</div>

	</header>
	<h1>Bienvenido a sistema de facturacion</h1>
	<div class="form-inline" style="padding: 20px;">
		<?php 
		if ($_SESSION['idrol']==1) {		
		 ?>
		<div class="card m-2" style="width: 18rem;">
		  <img src="img/produc.jpg" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">USUARIO</h5>
		    <div class="form-inline">
		    	<a href="registrouser.php" class="btn btn-primary m-1">New User</a>
		    	<a href="mostraruser.php" class="btn btn-success m-1">Mostrar</a>
		    </div>
		  </div>
		</div>
		<?php } ?>
		<div class="card m-2" style="width: 18rem;">
		  <img src="img/produc.jpg" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">CLIENTE</h5>
		    <div class="form-inline">
		    	<a href="registrocliente.php" class="btn btn-primary m-1">New Cliente</a>
		    	<a href="mostrarcliente.php" class="btn btn-success m-1">Mostrar</a>
		    </div>
		  </div>
		</div>
		<?php 
		if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2) {		
		 ?>
		<div class="card m-2" style="width: 18rem;">
		  <img src="img/produc.jpg" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">PROVEEDOR</h5>
		    <div class="form-inline">
		    	<a href="registroproveedor.php" class="btn btn-primary m-1">New Porveedor</a>
		    	<a href="mostrarproveedor.php" class="btn btn-success m-1">Mostrar</a>
		    </div>
		  </div>
		</div>
	<?php } ?>
		<div class="card m-2" style="width: 18rem;">
		  <img src="img/produc.jpg" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">PRODUCTO</h5>
		    <div class="form-inline">
		    	<?php 
					if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2){		
		 		?>
		    	<a href="registroproducto.php" class="btn btn-primary m-1">New Porducto</a>
		    <?php } ?>
		    	<a href="mostrarproducto.php" class="btn btn-success m-1">Mostrar</a>
		    </div>
		  </div>
		</div>

		<div class="card m-2" style="width: 18rem;">
		  <img src="img/produc.jpg" class="card-img-top" alt="...">
		  <div class="card-body">
		    <h5 class="card-title">VENTAS</h5>
		    <div class="form-inline">
		    	<a href="nuevaventa.php" class="btn btn-primary m-1">New Ventas</a>
		    	<a href="#" class="btn btn-success m-1">Mostrar</a>
		    </div>
		  </div>
		</div>
	</div>
		<footer>
		<p>Perú, <?php echo fecha(); ?></p>
	</footer>
</body>
</html>