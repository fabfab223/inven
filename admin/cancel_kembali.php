<?php 
include 'config.php';
$id=$_GET['id'];

mysqli_query($conn,"update barang_pinjam set id_status=1, tgl_kembali=null where id='$id'");

header("location:borrow.php");

 ?>