<?php 
include 'config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$jumlah=$_POST['jumlah'];

mysqli_query($conn,"update barang set nama='$nama',jumlah='$jumlah' where id='$id'");
header("location:barang.php");

?>