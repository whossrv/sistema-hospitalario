<?php
session_start();

if(!isset($_SESSION['rol'])){
header("Location:index.php");
exit();
}

include("conexion.php");

/* Guardar paciente */
if(isset($_POST['guardar'])){

$nombre     = $_POST['nombre'];
$apellido   = $_POST['apellido'];
$edad       = $_POST['edad'];
$sexo       = $_POST['sexo'];

mysqli_query($conexion,"
INSERT INTO pacientes(nombre,apellido,edad,sexo)
VALUES('$nombre','$apellido','$edad','$sexo')
");
header("Location: pacientes.php");
exit();
}

/* Listar */
$sql = mysqli_query($conexion,"SELECT * FROM pacientes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pacientes</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
text-shadow:0 0 15px #00f2fe;
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
margin-bottom:25px;
}

input,select{
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
<h3 class="mb-4">Registrar Paciente</h3>

<form method="POST">

<div class="row g-3">
<div class="col-md-6">
<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
</div>

<div class="col-md-6">
<input type="text" name="apellido" class="form-control" placeholder="Apellido" required>
</div>

<div class="col-md-6">
<input type="number" name="edad" class="form-control" placeholder="Edad" required>
</div>

<div class="col-md-6">
<select name="sexo" class="form-control" required>
<option value="">Sexo</option>
<option>Masculino</option>
<option>Femenino</option>
</select>
</div>

<div class="col-12">
<button type="submit" name="guardar" class="btn btn-led w-100">
💾 Guardar Paciente
</button>
</div>
</div>

</form>
</div>

<div class="box">
<h3 class="mb-4">Lista de Pacientes</h3>

<table class="table table-bordered table-hover text-center">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Edad</th>
<th>Sexo</th>
<th>Acciones</th>
</tr>
</thead>

<tbody>

<?php while($fila=mysqli_fetch_assoc($sql)){ ?>

<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['apellido']; ?></td>
<td><?php echo $fila['edad']; ?></td>
<td><?php echo $fila['sexo']; ?></td>

<td>
<a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>

<a href="eliminar.php?id=<?php echo $fila['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar paciente?')">
Eliminar
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