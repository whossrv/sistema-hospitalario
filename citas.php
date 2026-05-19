<?php
session_start();

if(!isset($_SESSION['rol'])){
header("Location:index.php");
exit();
}

if($_SESSION['rol']!="admin" && $_SESSION['rol']!="recepcion"){
header("Location:index.php");
exit();
}

include("conexion.php");

/* Guardar cita */
if(isset($_POST['guardar'])){

$paciente_id = $_POST['paciente_id'];
$fecha       = $_POST['fecha'];
$hora        = $_POST['hora'];
$motivo      = $_POST['motivo'];

mysqli_query($conexion,"
INSERT INTO citas(paciente_id,fecha,hora,motivo)
VALUES('$paciente_id','$fecha','$hora','$motivo')
");

header("Location:citas.php");
exit();
}

/* Pacientes */
$pacientes = mysqli_query($conexion,"SELECT * FROM pacientes ORDER BY nombre ASC");

/* Citas */
$sql = mysqli_query($conexion,"
SELECT citas.*, pacientes.nombre, pacientes.apellido
FROM citas
INNER JOIN pacientes ON citas.paciente_id = pacientes.id
ORDER BY citas.id DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Citas Médicas</title>

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
margin-bottom:25px;
box-shadow:0 0 20px hsla(183, 100%, 50%, 0.25);
}

input,select,textarea{
background:#0d1b2a !important;
border:1px solid #00f2fe !important;
color:#fff !important;
}

table{
color:#fff !important;
}

thead{
background:#00f2fe;
color:#000;
}

.btn-led{
border:1px solid #00f2fe;
color:#fff;
}

.btn-led:hover{
background:#00f2fe;
color:#000;
}

/* calendario claro*/
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg);
    cursor: pointer;
}

/* reloj claro */
input[type="time"]::-webkit-calendar-picker-indicator {
    filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg);
    cursor: pointer;
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
<h3 class="mb-4">Registrar Nueva Cita</h3>

<form method="POST">

<div class="row g-3">

<div class="col-md-6">
<select name="paciente_id" class="form-control" required>
<option value="">Seleccionar Paciente</option>

<?php while($p=mysqli_fetch_assoc($pacientes)){ ?>
<option value="<?php echo $p['id']; ?>">
<?php echo $p['nombre']." ".$p['apellido']; ?>
</option>
<?php } ?>

</select>
</div>

<div class="col-md-3">
<input type="date" name="fecha" class="form-control" required>
</div>

<div class="col-md-3">
<input type="time" name="hora" class="form-control" required>
</div>

<div class="col-12">
<textarea name="motivo" class="form-control" placeholder="Motivo de la cita" required></textarea>
</div>

<div class="col-12">
<button type="submit" name="guardar" class="btn btn-led w-100">
💾 Guardar Cita
</button>
</div>

</div>

</form>
</div>

<div class="box">
<h3 class="mb-4">Listado de Citas</h3>

<table class="table table-bordered table-hover text-center">
<thead>
<tr>
<th>ID</th>
<th>Paciente</th>
<th>Fecha</th>
<th>Hora</th>
<th>Motivo</th>
</tr>
</thead>

<tbody>

<?php while($fila=mysqli_fetch_assoc($sql)){ ?>

<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']." ".$fila['apellido']; ?></td>
<td><?php echo $fila['fecha']; ?></td>
<td><?php echo $fila['hora']; ?></td>
<td><?php echo $fila['motivo']; ?></td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

</div>

</body>
</html>