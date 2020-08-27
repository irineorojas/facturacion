<?php 
require_once 'conexion.php';
session_start();
if (!empty($_SESSION['active'])) {
    header('Location: plan/principal.php');
}else{
    if (!empty($_POST)) {

    if(empty($_POST['usuario']) || empty($_POST['password']))
    {
        echo '<script> alert("Ingrese su usuario y su Contraseña")</script>';

    }else{
        $usuario =mysqli_real_escape_string($conexion, $_POST['usuario']);
        $password =md5(mysqli_real_escape_string($conexion, $_POST['password']));
        $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario='$usuario' AND password='$password'");
        mysqli_close($conexion);
        $result = mysqli_num_rows($query);
        if ($result>0){
            $data=mysqli_fetch_array($query);
            $_SESSION['active']=true;
            $_SESSION['idUser']=$data['idusario'];
            $_SESSION['nombre']=$data['nombre'];
            $_SESSION['email']=$data['email'];
            $_SESSION['user']=$data['usuario'];
            $_SESSION['rol']=$data['rol'];

            header('Location: plan/principal.php');
            
        }else{
        echo '<script> alert("CORREO O LA CONTRASEÑA INCORECTA")</script>'; 
        session_destroy();
        }
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
        <img src="img/img_avatar.png" alt="" width="200px">
        <input type="usuario" name="usuario" placeholder="Usuario">
        <input type="password" name="password" placeholder="Contraseña">
        <p class="alert"></p>
        <input type="submit" value="INGRESAR">
        <br><br>
        </form>
       
   </nav>
	
</body>
</html>