<?php 

include 'config.php';
$tgl=$_POST['tgl2'];
$tgl_kembali=$_POST['tgl3'];
$nama=$_POST['nama'];
$nama_p=$_POST['nama_p'];
$jumlah=$_POST['jumlah'];

$tgl_k= 'null';
$id_status='1';

$dt=mysqli_query($conn,"select * from barang_pinjam where nama='$nama'");
$data=mysqli_fetch_array($dt);


mysqli_query($conn, "insert into barang_pinjam values('','$tgl','$tgl_k','$nama','$nama_p','$jumlah','$id_status','$tgl_kembali')")or die(mysqli_error());
mysqli_query($conn, "update barang set jumlah = jumlah - '$jumlah' where nama='$nama'");

header("location:borrow.php");

?>