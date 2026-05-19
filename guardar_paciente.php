<?php
include("conexion.php");

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$edad=$_POST['edad'];
$sexo=$_POST['sexo'];
$telefono=$_POST['telefono'];
$direccion=$_POST['direccion'];

$sql="INSERT INTO pacientes(nombre,apellido,edad,sexo,telefono,direccion)
VALUES('$nombre','$apellido','$edad','$sexo','$telefono','$direccion')";

mysqli_query($conexion,$sql);

header("Location: pacientes.php");
?>