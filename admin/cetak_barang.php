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
$pdf->Cell(25.5,0.7,"Laporan Pengeluaran Barang Per User",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di Cetak Pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'Nama Peminta', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$nama=$_POST['nama_barang'];
$tanggal1=$_POST['tanggal1'];
$tanggal2=$_POST['tanggal2'];
$query=mysqli_query($conn,"select * from barang_keluar where nama_barang ='$nama' AND tanggal>='$tanggal1' AND tanggal<='$tanggal2'");
while($lihat=mysqli_fetch_array($query))

{
	$pdf->Cell(2, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['tanggal'],1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama_barang'],1, 0, 'C');
	$pdf->Cell(8, 0.8, $lihat['nama_peminta'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['jumlah'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_keluar.pdf","I");

?>

