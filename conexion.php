<?php
$host ='localhost';
$user='root';
$password='';
$bd='facturacion';

$conexion = new mysqli($host, $user, $password, $bd);

        if ($conexion->connect_error) die ("Fatal error");

        

?>