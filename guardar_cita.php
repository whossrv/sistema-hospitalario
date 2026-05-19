<?php
include("conexion.php");

$paciente_id = $_POST['paciente_id'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];

$sql = "INSERT INTO citas(paciente_id,fecha,hora,motivo)
VALUES('$paciente_id','$fecha','$hora','$motivo')";

mysqli_query($conexion,$sql);

header("Location: citas.php");
?>