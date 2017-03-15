<?php 

include 'config.php';
$tgl=$_POST['tgl2'];
$nama=$_POST['nama'];
$nama_p=$_POST['nama_p'];
$jumlah=$_POST['jumlah'];

$jml_brng=mysqli_query($conn,"select * from barang where nama='$nama'");
$dt_jml=mysqli_fetch_array($jml_brng);
$jml = $dt_jml['jumlah'];

if($jumlah <= $jml){
	mysqli_query($conn, "insert into barang_keluar values('','$tgl','$nama','$nama_p','$jumlah')")or die(mysqli_error());
	mysqli_query($conn, "update barang set jumlah = jumlah - '$jumlah' where nama='$nama'");
	header("location:output.php");
} else {
	echo '<script language="javascript">';
	echo 'alert("Jumlah yang dimasukkan kurang dari Master Barang yang ada");
			window.history.back();';
	echo '</script>';
}

?>