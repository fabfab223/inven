<?php 
include 'config.php';
$id=$_POST['id'];
$tgl=$_POST['tgl'];
$nama=$_POST['nama'];
$jumlah=$_POST['jumlah'];

mysqli_query($conn,"update barang_masuk set tanggal='$tgl',nama_barang='$nama',jumlah='$jumlah' where id='$id'");
header("location:edit_masuk.php?pesan=oke");


?>