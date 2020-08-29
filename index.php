<?php 
include "conexion.php";
session_start();
if (!empty($_SESSION['active'])) {
    header('Location: plan/principal.php');
}else{
    if (isset($_POST['usuario']) && isset($conexion, $_POST['password']) && isset($_POST['rol'])) {
        $usuario=mysqli_real_escape_string($conexion, $_POST['usuario']);
        $password=md5(mysqli_real_escape_string($conexion, $_POST['password']));
        $rol=mysqli_real_escape_string($conexion, $_POST['rol']);
        $sql=mysqli_query($conexion,"SELECT *FROM usuario WHERE usuario='$usuario' AND password='$password' AND idrol='$rol'");

        $result=mysqli_num_rows($sql);
        if ($result>0) {
            $data=mysqli_fetch_array($sql);
            $_SESSION['active']=true;
            $_SESSION['idusuario']=$data['idusuario'];
            $_SESSION['nombre']=$data['nombre'];
            $_SESSION['correo']=$data['correo'];
            $_SESSION['usuario']=$data['usuario'];
            $_SESSION['idrol']=$data['idrol'];

            header('Location: plan/principal.php');
        }else{
            echo '<script> alert("LOS DATOS DEL USUARIO NO COINCIDEN")</script>'; 
        session_destroy();
        }
    }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login de facturacion</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<nav>
       <h3>Login</h3>
        <form  action="" method="post">
        <img src="img/img_avatar.png" alt="" width="150px">
        <input type="usuario" name="usuario" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <select name="rol">
                <option value="1">Administrador</option>
                <option value="2">Supervisor</option>
                <option value="3">Vendedor</option>
        </select>      
        <input type="submit" value="INGRESAR">
        <br><br>
        </form>
       
   </nav>
	
</body>
</html>