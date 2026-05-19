<?php
require('fpdf/fpdf.php');
include("conexion.php");

$id = $_GET['id'];

$sql = mysqli_query($conexion,"
SELECT diagnosticos.*, pacientes.nombre, pacientes.apellido, pacientes.edad, pacientes.sexo
FROM diagnosticos
INNER JOIN pacientes ON diagnosticos.paciente_id = pacientes.id
WHERE diagnosticos.id='$id'
");

$fila = mysqli_fetch_assoc($sql);

$pdf = new FPDF();
$pdf->AddPage();

/* Título */
$pdf->SetFont('Arial','B',18);
$pdf->SetTextColor(0,102,204);
$pdf->Cell(190,10,'CENTRO HOSPITALARIO',0,1,'C');

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(190,8,'Reporte Clinico Individual',0,1,'C');

$pdf->Ln(8);

/* Datos paciente */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,'DATOS DEL PACIENTE',1,1,'L');

$pdf->SetFont('Arial','',11);
$pdf->Cell(95,8,'Nombre: '.$fila['nombre'].' '.$fila['apellido'],1,0);
$pdf->Cell(95,8,'Edad: '.$fila['edad'],1,1);

$pdf->Cell(95,8,'Sexo: '.$fila['sexo'],1,0);
$pdf->Cell(95,8,'Fecha: '.$fila['fecha'],1,1);

$pdf->Ln(8);

/* Diagnóstico */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,'DIAGNOSTICO',1,1);

$pdf->SetFont('Arial','',11);
$pdf->MultiCell(190,8,$fila['diagnostico'],1);

$pdf->Ln(5);

/* Tratamiento */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,'TRATAMIENTO',1,1);

$pdf->SetFont('Arial','',11);
$pdf->MultiCell(190,8,$fila['tratamiento'],1);

$pdf->Ln(5);

/* Observaciones */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,8,'OBSERVACIONES',1,1);

$pdf->SetFont('Arial','',11);
$pdf->MultiCell(190,8,$fila['observaciones'],1);

$pdf->Ln(20);

/* Firma */
$pdf->Cell(190,8,'_____________________________',0,1,'R');
$pdf->Cell(190,8,'Firma Medico Responsable',0,1,'R');

$pdf->Output();
?>