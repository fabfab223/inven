<?php 
//mysqli_connect("localhost", "root", "", "inventory_great");

// Koneksi PostgeSQL
//pg_connect("host=localhost dbname=publishing user=www password=foo") or die('Could not connect: ' . pg_last_error());

$conn = new mysqli("localhost", "root", "", "inventory_great");
if($conn->connect_errno){
	echo "ada error :" . $connect->connect_error;
}



//mysql_connect("localhost","root","");
//mysql_select_db("malasngoding_kios");
?>