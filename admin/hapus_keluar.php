<?php 
include 'config.php';
$id=$_GET['id'];
$nama=$_GET['nama_barang'];

$a=mysqli_query($conn,"select jumlah from barang_keluar where id=$id");
$b=mysqli_fetch_array($a);
$jumlah_k=$b['jumlah'];

//$c=mysqli_query($conn,"update barang set jumlah='$kembalikan' where nama='$nama'");

mysqli_query($conn,"UPDATE barang SET jumlah = jumlah + '$jumlah_k' where nama='$nama'");
mysqli_query($conn,"DELETE from barang_keluar where id='$id'" );

header("location:output.php");

 ?>