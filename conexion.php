<?php
$host ='localhost';
$user='root';
$password='';
$bd='bdfacturacion';

$conexion = new mysqli($host, $user, $password, $bd);

        if ($conexion->connect_error) die ("Fatal error");

        

?>