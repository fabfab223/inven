<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang Pinjaman</h3>
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
		echo "<a class='btn' href='borrow.php'><span class='glyphicon glyphicon-arrow-left'></span>  Kembali</a>";
	}
	else{
		echo "<div class='alert alert-danger'>Barang Gagal Diupdate  !!</div>";
	}
		
}
	
	
$id_brg = (isset($_GET['id']) ? $_GET['id'] : '');

$det=mysqli_query($conn,"select * from barang_pinjam where id='$id_brg'")or die(mysql_error());
while($d=mysqli_fetch_array($det)){
	?>					
	<form action="update_pinjam.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
			</tr>

			
			<tr>
				<td>Nama Barang</td>
				<td>
					<select class="form-control" class="col-md-12" name="nama">
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
				<td>Nama Peminjam</td>
				<td><input name="nama_p" class="col-md-12" type="text" class="form-control" autocomplete="off" value="<?php echo $d['nama_peminta'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" class="col-md-12" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
			</tr>
			<tr>
			
			<tr>
				<td>Tanggal Kembali</td>
				<td><div class="form-group">
						<div class='input-group date' class="col-md-12"><input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $d['tanggal_kembali'] ?>"></td>
			</tr>
		</table>
	
	<input type="submit" class="btn btn-info" value="Simpan"></input>
	</form>
	
	<?php 
}
?>
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
	
	
	<script type="text/javascript">
	$(function () {
	$('#tgl').datetimepicker({
	format: 'YYYY-MM-DD HH:mm:00',
	});
  
	$('#datepicker').datetimepicker({
	format: 'DD MMMM YYYY',
	});
  
	$('#timepicker').datetimepicker({
	format: 'HH:mm'
	});
	});
	</script>
 <script type="text/javascript">
        $(document).ready(function(){

            $('#tgl').datepicker({dateFormat: 'yy/mm/dd'});

        });
    </script>
<?php 
include 'footer.php';

?>