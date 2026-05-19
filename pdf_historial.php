<?php
require('fpdf/fpdf.php');
include("conexion.php");

$sql = mysqli_query($conexion,"
SELECT diagnosticos.*, pacientes.nombre, pacientes.apellido
FROM diagnosticos
INNER JOIN pacientes ON diagnosticos.paciente_id = pacientes.id
ORDER BY diagnosticos.id DESC
");

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

/* Título */
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,102,204);
$pdf->Cell(277,10,'CENTRO HOSPITALARIO',0,1,'C');

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(277,8,'Reporte General de Historial Clinico',0,1,'C');

$pdf->Cell(277,8,'Fecha: '.date('d/m/Y'),0,1,'R');

$pdf->Ln(5);

/* Encabezados */
$pdf->SetFont('Arial','B',10);

$pdf->Cell(15,10,'ID',1,0,'C');
$pdf->Cell(45,10,'Paciente',1,0,'C');
$pdf->Cell(25,10,'Fecha',1,0,'C');
$pdf->Cell(70,10,'Diagnostico',1,0,'C');
$pdf->Cell(70,10,'Tratamiento',1,0,'C');
$pdf->Cell(52,10,'Observaciones',1,1,'C');

/* Datos */
$pdf->SetFont('Arial','',9);

while($fila=mysqli_fetch_assoc($sql)){

$pdf->Cell(15,10,$fila['id'],1,0,'C');
$pdf->Cell(45,10,$fila['nombre'].' '.$fila['apellido'],1,0);
$pdf->Cell(25,10,$fila['fecha'],1,0);
$pdf->Cell(70,10,utf8_decode(substr($fila['diagnostico'],0,35)),1,0);
$pdf->Cell(70,10,utf8_decode(substr($fila['tratamiento'],0,35)),1,0);
$pdf->Cell(52,10,utf8_decode(substr($fila['observaciones'],0,25)),1,1);

}

$pdf->Output();
?>