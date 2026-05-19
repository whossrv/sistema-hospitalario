<?php
include("conexion.php");

$id = $_GET['id'];

/* borrar citas del paciente */
mysqli_query($conexion,"DELETE FROM citas WHERE paciente_id='$id'");

/* borrar diagnósticos del paciente */
mysqli_query($conexion,"DELETE FROM diagnosticos WHERE paciente_id='$id'");

/* borrar paciente */
mysqli_query($conexion,"DELETE FROM pacientes WHERE id='$id'");

header("Location: pacientes.php");
?>