<?php
session_start();

if(isset($_SESSION['usuario'])){
    header("Location: panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Hospital - Acceso</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
body{
background:#020612;
background-image:
linear-gradient(rgba(0,242,254,.12) 1px, transparent 1px),
linear-gradient(90deg, rgba(0,242,254,.12) 1px, transparent 1px),
radial-gradient(circle at center,#0a192f 0%,#000 100%);
background-size:80px 80px,80px 80px,100% 100%;
min-height:100vh;
font-family:Segoe UI,sans-serif;
color:#fff;
}

.login-card{
background:rgba(6,11,25,.88);
border:2px solid #00f2fe;
border-radius:18px;
box-shadow:0 0 35px rgba(0,242,254,.35);
}

.titulo{
text-shadow:0 0 15px #00f2fe;
font-weight:bold;
}

.form-control{
background:#0f172a;
border:1px solid #00f2fe;
color:#fff;
}

.form-control:focus{
background:#000;
color:#fff;
border-color:#00f2fe;
box-shadow:0 0 20px #00f2fe;
}

.btn-led{
border:2px solid #00f2fe;
color:#fff;
font-weight:bold;
background:transparent;
}

.btn-led:hover{
background:#00f2fe;
color:#000;
}

.error-box{
background:rgba(255,0,0,.1);
border:1px solid #ff4d4d;
color:#ff4d4d;
padding:10px;
border-radius:8px;
}
</style>
</head>

<body class="d-flex align-items-center">

<div class="container">
<div class="row justify-content-center">
<div class="col-md-5">

<div class="text-center mb-4">
<i class="fas fa-hospital fa-4x text-info"></i>
</div>

<div class="card login-card">
<div class="card-body p-5"> 

<h2 class="text-center titulo mb-3">REGISTRO HOSPITALARIO</h2>
<p class="text-center text-info mb-4">Acceso al Sistema</p>

<form method="POST" action="login.php">

<?php if(isset($_GET['error'])){ ?>
<div class="error-box text-center mb-4">
<i class="fas fa-exclamation-triangle me-2"></i>
Usuario o contraseña incorrectos
</div>
<?php } ?>

<div class="mb-3">
<label class="mb-2 text-info">
<i class="fas fa-user me-1"></i> Usuario
</label>

<input
type="text"
name="usuario"
class="form-control"
required
placeholder="Ingrese usuario">
</div>

<div class="mb-4">
<label class="mb-2 text-info">
<i class="fas fa-lock me-1"></i> Contraseña
</label>

<input
type="password"
name="clave"
class="form-control"
required
placeholder="********">
</div>

<div class="d-grid">
<button type="submit" class="btn btn-led py-3">
<i class="fas fa-sign-in-alt me-2"></i>
Ingresar
</button>
</div>

</form>

</div>
</div>

</div>
</div>
</div>

</body>
</html>