<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class='btn' href='output.php'><span class='glyphicon glyphicon-arrow-left'></span>  Kembali</a>
<?php 
$periksa=mysqli_query($conn,"select * from barang where jumlah <=5");
while($q=mysqli_fetch_array($periksa)){	
	if($q['jumlah']<=5){	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
			});
		</script>
		<?php
	}
}

$periksa_tgl=mysqli_query($conn,"select * from barang_pinjam where date(tanggal_kembali)<=date(now()) and tgl_kembali is null");
while($r=mysqli_fetch_array($periksa_tgl)){	
	if($r['tanggal_kembali'] <= date('Y-m-d')+1) {	
		?>	
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
			});
		</script>
		<?php
	}
}
?>
<?php
if(isset($_GET['pesan'])){
	$pesan=mysqli_real_escape_string($conn,$_GET['pesan']);
	if($pesan=="oke"){
		echo "<div class='alert alert-success'>Barang Sukses Diupdate  !!</div>";
		echo "<a class='btn' href='output.php'><span class='glyphicon glyphicon-arrow-left'></span>  Kembali</a>";
	}
		
}
	
	
$id_brg = (isset($_GET['id']) ? $_GET['id'] : '');

$det=mysqli_query($conn,"select * from barang_keluar where id='$id_brg'")or die(mysql_error());
while($d=mysqli_fetch_array($det)){
	?>					
	<form action="update_keluar.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>

			<tr>
				<td>Tanggal</td>
				<td><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $d['tanggal'] ?>"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>
					<select class="form-control" name="nama">
						<?php 
						$brg=mysqli_query($conn,"select * from barang");
						while($b=mysqli_fetch_array($brg)){
							?>	
							<option <?php if($b['nama']){echo "selected"; } ?> value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
							<?php 
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
 <script type="text/javascript">
        $(document).ready(function(){

            $('#tgl').datepicker({dateFormat: 'yy/mm/dd'});

        });
    </script>
<?php 
include 'footer.php';

?>