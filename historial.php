<?php
session_start();

if(!isset($_SESSION['rol'])){
header("Location:index.php");
exit();
}

if($_SESSION['rol']!="admin" && $_SESSION['rol']!="doctor"){
header("Location:index.php");
exit();
}

include("conexion.php");

$sql = mysqli_query($conexion,"
SELECT diagnosticos.*, pacientes.nombre, pacientes.apellido
FROM diagnosticos
INNER JOIN pacientes ON diagnosticos.paciente_id = pacientes.id
ORDER BY diagnosticos.id DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Historial Clínico</title>

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

.sidebar .logo{
text-align:center;
font-size:25px;
font-weight:bold;
color:#00f2fe;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#fff;
text-decoration:none;
padding:12px;
margin-bottom:10px;
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
padding:35px;
}

.box{
background:rgba(6,11,25,.88);
border:1px solid #00f2fe;
border-radius:18px;
padding:25px;
box-shadow:0 0 20px rgba(0,242,254,.25);
}

table{
color:#fff !important;
}

thead{
background:#00f2fe;
color:#000;
}

.badge-led{
background:#00f2fe;
color:#000;
padding:8px 12px;
border-radius:20px;
font-weight:bold;
text-decoration:none;
}

.btn-pdf{
background:#ffc107;
color:#000;
font-weight:bold;
border:none;
}

.btn-pdf:hover{
background:#ffca2c;
color:#000;
}
</style>
</head>

<body>

<div class="sidebar">

<div class="logo">HOSPITAL</div>

<?php
if($_SESSION['rol']=="admin"){
echo '<a href="panel_admin.php">🏠 Inicio</a>';
}

if($_SESSION['rol']=="doctor"){
echo '<a href="panel_doctor.php">🏠 Inicio</a>';
}

if($_SESSION['rol']=="recepcion"){
echo '<a href="panel_recepcion.php">🏠 Inicio</a>';
}
?>

<?php if($_SESSION['rol']=="admin"){ ?>
    <a href="pacientes.php">🧑 Pacientes</a>
    <a href="citas.php">📅 Citas</a>
    <a href="diagnostico.php">🩺 Diagnóstico</a>
    <a href="historial.php">📄 Historial</a>
<?php } ?>

<?php if($_SESSION['rol']=="doctor"){ ?>
    <a href="pacientes.php">🧑 Pacientes</a>
    <a href="diagnostico.php">🩺 Diagnóstico</a>
    <a href="historial.php">📄 Historial</a>
<?php } ?>

<?php if($_SESSION['rol']=="recepcion"){ ?>
    <a href="pacientes.php">🧑 Pacientes</a>
    <a href="citas.php">📅 Citas</a>
<?php } ?>

<a href="logout.php">🚪 Cerrar Sesión</a>

</div>

<div class="main">

<div class="box">

<div class="d-flex justify-content-between align-items-center mb-4">
<h3>Historial Clínico</h3>

<a href="pdf_historial.php" target="_blank" class="badge-led">
📄 Exportar PDF General
</a>
</div>

<table class="table table-bordered table-hover text-center">

<thead>
<tr>
<th>ID</th>
<th>Paciente</th>
<th>Fecha</th>
<th>Diagnóstico</th>
<th>Tratamiento</th>
<th>Observaciones</th>
<th>Acciones</th>
</tr>
</thead>

<tbody>

<?php while($fila=mysqli_fetch_assoc($sql)){ ?>

<tr>

<td><?php echo $fila['id']; ?></td>

<td>
<?php echo $fila['nombre']." ".$fila['apellido']; ?>
</td>

<td><?php echo $fila['fecha']; ?></td>

<td><?php echo $fila['diagnostico']; ?></td>

<td><?php echo $fila['tratamiento']; ?></td>

<td><?php echo $fila['observaciones']; ?></td>

<td>
<a href="pdf_diagnostico.php?id=<?php echo $fila['id']; ?>"
target="_blank"
class="btn btn-pdf btn-sm">
📄 PDF Individual
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>