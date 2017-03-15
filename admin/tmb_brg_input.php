<?php 

include 'config.php';
$tgl=$_POST['tgl2'];
$nama=$_POST['nama'];
$jumlah=$_POST['jumlah'];

$dt=mysqli_query($conn,"select * from barang_masuk where nama='$nama'");
$data=mysqli_fetch_array($dt);


mysqli_query($conn, "insert into barang_masuk values('','$tgl','$nama','$jumlah')")or die(mysqli_error());
mysqli_query($conn, "update barang set jumlah = jumlah + '$jumlah' where nama='$nama'");

header("location:input.php");

?>