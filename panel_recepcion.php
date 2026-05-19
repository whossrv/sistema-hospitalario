<?php
session_start();

if(!isset($_SESSION['rol'])){
header("Location:index.php");
exit();
}

if($_SESSION['rol']!="recepcion"){
header("Location:index.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel Recepción</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:Segoe UI,sans-serif;
background:#020612;
color:#fff;
}

body::before{
content:"";
position:fixed;
inset:0;
background:
linear-gradient(rgba(0,242,254,.08) 1px, transparent 1px),
linear-gradient(90deg, rgba(0,242,254,.08) 1px, transparent 1px),
radial-gradient(circle at center,#0a192f 0%,#000 100%);
background-size:60px 60px,60px 60px,100% 100%;
z-index:-1;
}

.sidebar{
width:260px;
height:100vh;
position:fixed;
left:0;
top:0;
background:rgba(6,11,25,.92);
border-right:2px solid #00f2fe;
padding:25px;
}

.logo{
text-align:center;
font-size:24px;
font-weight:bold;
color:#00f2fe;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#fff;
text-decoration:none;
padding:12px;
margin-bottom:12px;
border:1px solid rgba(0,242,254,.25);
border-radius:10px;
transition:.3s;
}

.sidebar a:hover{
background:#00f2fe;
color:#000;
transform:translateX(5px);
}

.main{
margin-left:260px;
padding:40px;
}

.card-box{
background:rgba(6,11,25,.88);
border:1px solid #00f2fe;
padding:25px;
border-radius:18px;
box-shadow:0 0 20px rgba(0,242,254,.25);
transition:.3s;
}

.card-box:hover{
transform:scale(1.05);
cursor:pointer;
box-shadow:0 0 30px #00f2fe;
}
</style>
</head>

<body>

<div class="sidebar">

<div class="logo">HOSPITAL</div>

<a href="panel_recepcion.php">🏠 Inicio</a>
<a href="pacientes.php">🧑 Pacientes</a>
<a href="citas.php">📅 Citas</a>
<a href="logout.php">🚪 Cerrar Sesión</a>

</div>

<div class="main">

<?php
include("conexion.php");

$pacientes = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM pacientes"));
$citas = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM citas"));
?>

<div class="row justify-content-center mb-4">

<div class="col-md-4">
<a href="pacientes.php" style="text-decoration:none; color:white;">
<div class="card-box text-center">
<h4><i class="fa-sharp fa-solid fa-people" style="color: rgb(0, 242, 254);"></i> Pacientes</h4>
<h2><?php echo $pacientes; ?></h2>
</div>
</a>
</div>

<div class="col-md-4">
<a href="citas.php" style="text-decoration:none; color:white;">
<div class="card-box text-center">
<h4>📅 Citas</h4>
<h2><?php echo $citas; ?></h2>
</div>
</a>
</div>

</div>

<div class="card-box">
<h1>Bienvenido Recepción 🧑‍💼</h1>
<p>Gestiona pacientes y agenda citas de forma rápida y eficiente.</p>
</div>

</div>

</body>
</html>