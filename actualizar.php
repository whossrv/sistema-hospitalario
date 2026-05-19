<?php
include("conexion.php");

$id=$_POST['id'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$edad=$_POST['edad'];

mysqli_query($conexion,"UPDATE pacientes SET
nombre='$nombre',
apellido='$apellido',
edad='$edad'
WHERE id='$id'");

header("Location: pacientes.php");
?>