<?php
include("conexion.php");

$id = $_GET['id'];

mysqli_query($conexion,"DELETE FROM citas WHERE id='$id'");

header("Location: citas.php");
?>