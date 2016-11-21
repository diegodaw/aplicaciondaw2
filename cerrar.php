<?php
session_start();
if(isset($_SESSION['usuario'])){
session_destroy();
$salida="No hay sesion abierta";
}
header("location: login2.php");
?>

