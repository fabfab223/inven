<?php 
include 'config.php';
$id=$_GET['id'];

mysqli_query($conn,"update barang_pinjam set id_status=2, tgl_kembali=date(now()) where id='$id'");

header("location:borrow.php");

 ?>