 <?php 
	if (empty($_SESSION['active'])) {
	    header('Location: ../');
	}
	 ?>
<header class="headerr">
		<h1>Sistema de facturación</h1>
		<div class="banner">
			<span class="usuario"><?php echo $_SESSION['nombre'].'-'.$_SESSION['idrol']; ?></span>
			<img class="foto" src="img/user.png">
			<a href="cerrar.php"><img class="cerrar" src="img/salir.png" alt="Salir de la pagina" title="Salir"></a>
		</div>

</header>
	<header>
		<span id="button-menu" class="fa fa-bars"></span>	
		<nav class="navegacion">
			<ul class="menu">
				<li class="title-menu">MENÚ</li>

				<li><a href="principal.php"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
				<?php if ($_SESSION['idrol']==1) {
				?>
				<li class="item-submenu" menu="1">
					<a href="#"><img src="img/users.png" class="icono" alt="">Usuario</a>
					<ul class="submenu">
						<li class="go-back">Atras</li>

						<li><a href="registrouser.php">Nuevo Usuario</a></li>
						<li><a href="mostraruser.php">Mostrar Usuario</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="item-submenu" menu="2">
					<a href="#"><img src="img/cliente.png" class="icono" alt="">Cliente</a>
					<ul class="submenu">
						<li class="go-back">Atras</li>
						<li><a href="registrocliente.php">Nuevo Cliente</a></li>
						<li><a href="mostrarcliente.php">Mostrar Cliente</a></li>
					</ul>
				</li>
				<?php if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2) {
				?>
				<li class="item-submenu" menu="3">
					<a href="#"><img src="img/prov.png" class="icono" alt="">Proveedor</a>
					<ul class="submenu">
						<li class="go-back">Atras</li>

						<li><a href="registroproveedor.php">Nuevo proveedor</a></li>
						<li><a href="mostrarproveedor.php">Mostrar Proveedor</a></li>
					</ul>
				</li>
			<?php } ?>

				<li class="item-submenu" menu="4">
					<a href="#"><img src="img/producto.png" class="icono" alt="">Producto</a>
					<ul class="submenu">
						<li class="go-back">Atras</li>
						<?php if ($_SESSION['idrol']==1 || $_SESSION['idrol']==2) {
						?>
						<li><a href="registroproducto.php">Nuevo Producto</a></li>
					<?php } ?>
						<li><a href="mostrarproducto.php">Mostrar Producto</a></li>
					</ul>
				</li>
				<li class="item-submenu" menu="5">
					<a href="#"><img src="img/fac.png" class="icono" alt="">Venta</a>
					<ul class="submenu">
						<li class="go-back">Atras</li>

						<li><a href="nuevaventa.php">Nuevo Ventas</a></li>
						<li><a href="#">Mostrar Ventas</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
