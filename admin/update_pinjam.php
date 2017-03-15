<?php 
include 'config.php';
$id=$_POST['id'];
$tgl=$_POST['tgl'];
$nama=$_POST['nama'];
$nama_p=$_POST['nama_p'];
$jumlah=$_POST['jumlah'];

mysqli_query($conn,"update barang_pinjam set tanggal_kembali='$tgl',nama_peminta='$nama_p',nama_barang='$nama',jumlah='$jumlah' where id='$id'");
header("location:edit_pinjam.php?pesan=oke");


?>