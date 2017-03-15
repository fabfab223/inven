<?php 
//mysqli_connect("localhost", "root", "", "inventory_great");

$conn = new mysqli("localhost", "root", "", "inventory_great");
if($conn->connect_errno){
	echo "ada error :" . $connect->connect_error;
}



//mysql_connect("localhost","root","");
//mysql_select_db("malasngoding_kios");
?>