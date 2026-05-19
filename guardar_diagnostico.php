<?php
include("conexion.php");

$paciente_id = $_POST['paciente_id'];
$fecha = $_POST['fecha'];
$sintomas = $_POST['sintomas'];
$diagnostico = $_POST['diagnostico'];
$tratamiento = $_POST['tratamiento'];
$observaciones = $_POST['observaciones'];

$sql = "INSERT INTO diagnosticos
(paciente_id,fecha,sintomas,diagnostico,tratamiento,observaciones)
VALUES
('$paciente_id','$fecha','$sintomas','$diagnostico','$tratamiento','$observaciones')";

mysqli_query($conexion,$sql);

header("Location: diagnostico.php");
?>