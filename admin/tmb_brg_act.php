<?php 
include 'config.php';
$nama=$_POST['nama'];
$jumlah=$_POST['jumlah'];


mysqli_query($conn,"insert into barang values('','$nama','$jumlah')");
header("location:barang.php");

 ?>