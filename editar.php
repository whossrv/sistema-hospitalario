<?php
include("conexion.php");

$id = $_GET['id'];

$sql = mysqli_query($conexion,"SELECT * FROM pacientes WHERE id='$id'");
$paciente = mysqli_fetch_assoc($sql);

if(isset($_POST['actualizar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];

    mysqli_query($conexion,"
    UPDATE pacientes SET
    nombre='$nombre',
    apellido='$apellido',
    edad='$edad'
    WHERE id='$id'
    ");

    header("Location: pacientes.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Paciente</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#020612;
color:#fff;
font-family:Segoe UI,sans-serif;
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

.card-futuro{
background:rgba(6,11,25,.9);
border:2px solid #00f2fe;
border-radius:20px;
box-shadow:0 0 25px rgba(0,242,254,.4);
padding:30px;
}

.titulo{
text-align:center;
color:#00f2fe;
text-shadow:0 0 15px #00f2fe;
margin-bottom:25px;
}

.form-control{
background:#0f172a;
border:1px solid #00f2fe;
color:#fff;
}

.form-control:focus{
background:#000;
border-color:#00f2fe;
box-shadow:0 0 15px #00f2fe;
color:#fff;
}

.btn-futuro{
border:2px solid #00f2fe;
color:#fff;
background:transparent;
font-weight:bold;
}

.btn-futuro:hover{
background:#00f2fe;
color:#000;
}
</style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="col-md-5">

<div class="card-futuro">

<h2 class="titulo">✏️ Editar Paciente</h2>

<form method="POST">

<div class="mb-3">
<label>Nombre</label>
<input type="text" name="nombre" class="form-control" value="<?php echo $paciente['nombre']; ?>" required>
</div>

<div class="mb-3">
<label>Apellido</label>
<input type="text" name="apellido" class="form-control" value="<?php echo $paciente['apellido']; ?>" required>
</div>

<div class="mb-4">
<label>Edad</label>
<input type="number" name="edad" class="form-control" value="<?php echo $paciente['edad']; ?>" required>
</div>

<div class="d-grid">
<button type="submit" name="actualizar" class="btn btn-futuro py-2">
💾 Guardar Cambios
</button>
</div>

</form>

</div>

</div>

</body>
</html>