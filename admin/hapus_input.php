<?php 
include 'config.php';
$id=$_GET['id'];
mysqli_query($conn,"delete from barang_masuk where id='$id'");
header("location:input.php");

?>