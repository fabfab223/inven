<?php 
include 'config.php';
$id=$_GET['id'];
$nama_barang=$_POST['nama_barang'];


$a=mysqli_query($conn,"select jumlah from barang_pinjam where id=$id");
$b=mysqli_fetch_array($a);
$jumlah=$b['jumlah'];


//$c=mysqli_query($conn,"update barang set jumlah='$kembalikan' where nama='$nama'");
mysqli_query($conn,"delete from barang_pinjam where id='$id'");
mysqli_query($conn,"update barang set jumlah = jumlah + ['$jumlah'] where nama='$nama_barang'");


header("location:borrow.php");

 ?>