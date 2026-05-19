<?php
session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$sql = mysqli_query($conexion,"
SELECT * FROM usuarios
WHERE usuario='$usuario'
AND clave='$clave'
");

if(mysqli_num_rows($sql)>0){

$fila = mysqli_fetch_assoc($sql);

$_SESSION['usuario'] = $fila['usuario'];
$_SESSION['rol'] = $fila['rol'];

if($fila['rol']=="admin"){
header("Location: panel_admin.php");
exit();
}

if($fila['rol']=="doctor"){
header("Location: panel_doctor.php");
exit();
}

if($fila['rol']=="recepcion"){
header("Location: panel_recepcion.php");
exit();
}

}else{

header("Location:index.php?error=1");
exit();

}
?>