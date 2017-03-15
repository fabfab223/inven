<?php
session_start();
include 'cek.php';
include 'config.php';
require('../assets/pdf/fpdf.php');
header('');
$pdf = new FPDF("L","cm","A5");
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
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Website : www.thegreatsoft.com' ,0,'L');
$pdf->SetX(4);
$pdf->MultiCell(26.5,0.5,'Email : info@thegreatsoft.comm',0,'L');
$pdf->Line(1,3.1,20,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,20,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(16.5,0.7,"Bukti Cetak",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di Cetak Pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Peminjaman', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Tanggal Kembali', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama Peminjam', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Jumlah', 1, 1, 'C');


$pdf->SetFont('Arial','',10);
$no=1;
$nama=$_GET['nama_peminta'];
$query=mysqli_query($conn,"select * from barang_pinjam where nama_peminta ='$nama'");
while($lihat=mysqli_fetch_array($query))

{
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['tanggal'],1, 0, 'C');
	$pdf->Cell(3.5, 0.8, $lihat['tanggal_kembali'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['nama_barang'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['nama_peminta'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['jumlah'], 1, 1,'C');
	
	$no++;
}

$pdf->ln(0.5);
$pdf->Cell(8, 0.8, 'Admin', 0, 0, 'C');
$pdf->Cell(1, 0.8, '', 0, 0, 'C');
$pdf->Cell(8, 0.8, 'Penerima', 0, 1, 'C');
$pdf->ln(1.5);
$pdf->Cell(8, 0.8, '('. $_SESSION['uname'] .')', 0, 0, 'C');
$pdf->Cell(1, 0.8, '', 0, 0, 'C');
$pdf->Cell(8.5, 0.8, '(................................)', 0, 1, 'C');
$pdf->Output("pinjam_print.pdf","I");

?>

