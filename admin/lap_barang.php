<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../logo/kallyas_icon.png',1.5,0.7,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'Greatsoft Solusi Indonesia',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telp : (031) 5945000',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
//$pdf->MultiCell(19.5,0.5,'JL. KIOS MALASNGODING',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Website : www.thegreatsoft.com' ,0,'L');
$pdf->SetX(4);
$pdf->MultiCell(26.5,0.5,'Email : info@thegreatsoft.comm',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(11, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(11, 0.8, 'Jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($conn,"select * from barang");
while($lihat=mysqli_fetch_array($query))

{
	$pdf->Cell(2, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(11, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(11, 0.8, $lihat['jumlah'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

