<?php
session_start();

if(!isset($_SESSION['usuario'])){
header("Location:index.php");
exit();
}

include("conexion.php");

$p1 = mysqli_fetch_row(mysqli_query($conexion,"SELECT COUNT(*) FROM pacientes"))[0];
$p2 = mysqli_fetch_row(mysqli_query($conexion,"SELECT COUNT(*) FROM citas"))[0];
$p3 = mysqli_fetch_row(mysqli_query($conexion,"SELECT COUNT(*) FROM diagnosticos"))[0];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Panel Hospitalario</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
body{
margin:0;
font-family:Segoe UI, sans-serif;
background:#020612;
color:#fff;
overflow-x:hidden;
}

/* Fondo */
body::before{
content:"";
position:fixed;
top:0;
left:0;
right:0;
bottom:0;
background:
linear-gradient(rgba(0,242,254,.08) 1px, transparent 1px),
linear-gradient(90deg, rgba(0,242,254,.08) 1px, transparent 1px),
radial-gradient(circle at center,#0a192f 0%,#000 100%);
background-size:60px 60px,60px 60px,100% 100%;
z-index:-2;
}

/* Sidebar */
.sidebar{
width:260px;
height:100vh;
position:fixed;
left:0;
top:0;
background:rgba(6,11,25,.92);
border-right:2px solid #00f2fe;
padding:25px;
box-shadow:0 0 25px rgba(0,242,254,.3);
}

.logo{
text-align:center;
font-size:26px;
margin-bottom:35px;
color:#00f2fe;
font-weight:bold;
text-shadow:0 0 15px #00f2fe;
}

.sidebar a{
display:block;
color:#fff;
text-decoration:none;
padding:12px 15px;
margin-bottom:10px;
border:1px solid rgba(0,242,254,.25);
border-radius:10px;
transition:.3s;
}

.sidebar a:hover{
background:#00f2fe;
color:#000;
transform:translateX(5px);
box-shadow:0 0 18px #00f2fe;
}

/* Main */
.main{
margin-left:260px;
padding:35px;
}

.title{
font-size:34px;
font-weight:bold;
margin-bottom:25px;
color:#fff;
text-shadow:0 0 15px #00f2fe;
}

/* Cards */
.card-led{
background:rgba(6,11,25,.88);
border:2px solid #00f2fe;
border-radius:18px;
padding:25px;
text-align:center;
box-shadow:0 0 20px rgba(0,242,254,.25);
transition:.3s;
height:100%;
}

.card-led:hover{
transform:translateY(-8px);
box-shadow:0 0 30px rgba(0,242,254,.65);
}

.icon{
font-size:42px;
color:#00f2fe;
margin-bottom:12px;
}

.num{
font-size:38px;
font-weight:bold;
}

.txt{
font-size:17px;
opacity:.9;
}

.welcome{
margin-top:35px;
background:rgba(6,11,25,.88);
border:1px solid #00f2fe;
border-radius:15px;
padding:25px;
box-shadow:0 0 15px rgba(0,242,254,.25);
}
</style>
</head>

<body>

<div class="sidebar">
<div class="logo">
<i class="fas fa-heartbeat"></i><br>
HOSPITAL
</div>

<a href="panel.php"><i class="fas fa-home me-2"></i> Inicio</a>
<a href="pacientes.php"><i class="fas fa-user-injured me-2"></i> Pacientes</a>
<a href="citas.php"><i class="fas fa-calendar-check me-2"></i> Citas</a>
<a href="diagnostico.php"><i class="fas fa-stethoscope me-2"></i> Diagnóstico</a>
<a href="historial.php"><i class="fas fa-file-medical me-2"></i> Historial</a>
<a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
</div>

<div class="main">

<div class="title">
Bienvenido, <?php echo $_SESSION['usuario']; ?>
</div>

<div class="row g-4">

<div class="col-md-4">
<div class="card-led">
<div class="icon"><i class="fas fa-user-injured"></i></div>
<div class="num"><?php echo $p1; ?></div>
<div class="txt">Pacientes</div>
</div>
</div>

<div class="col-md-4">
<div class="card-led">
<div class="icon"><i class="fas fa-calendar-check"></i></div>
<div class="num"><?php echo $p2; ?></div>
<div class="txt">Citas Médicas</div>
</div>
</div>

<div class="col-md-4">
<div class="card-led">
<div class="icon"><i class="fas fa-stethoscope"></i></div>
<div class="num"><?php echo $p3; ?></div>
<div class="txt">Diagnósticos</div>
</div>
</div>

</div>

<div class="welcome mt-4">
<h4 class="mb-3">Sistema Hospitalario Inteligente</h4>
<p>
Administra pacientes, citas médicas, diagnósticos clínicos e historial en un solo lugar.
Sistema desarrollado en PHP + MySQL.
</p>
</div>

</div>

</body>
</html>