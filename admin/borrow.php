<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Peminjaman Barang</h3>
<hr>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>


<br/>


<!– Validasi Form –>
<script language="JavaScript" type="text/javascript">
    function checkform ( form )
    {
      if (form.nama_p.value == "") {
        alert( "Maaf, Nama Peminta tidak boleh dikosongkan !" );
        form.nama_p.focus();
        return false ;
      }   
		else if (form.jumlah.value == "") {
        alert( "Maaf, Jumlah Barang tidak boleh dikosongkan !" );
        form.jumlah.focus();
        return false ;
      }
	  else if (form.tgl2.value == "") {
        alert( "Maaf, Tanggal Pinjam Barang tidak boleh dikosongkan !" );
        form.tgl2.focus();
        return false ;
      }
	  else if (form.tgl3.value <=0 ) {
        alert( "Maaf, Tanggal Kembali Barang Dengan Tepat !" );
        form.tgl3.focus();
        return false ;
      }
      return true ;
    }
	
	
	
</script>
<!–End Of Validasi Form –>



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
if(isset($_GET['tanggal'])){
	$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
	$tg="lap_barang_pinjam.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="	";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Pinjam Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal Pinjam</th>
		<th>Nama Barang</th>
		<th>Nama Peminta </th>
		<th>Jumlah</th>	
		<th>Tanggal Kembali</th>
		<th>Status</th>
		<th>Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
		$brg=mysqli_query($conn,"select * from barang_pinjam where tanggal like '$tanggal' order by tanggal desc");
	}else{
		$brg=mysqli_query($conn,"select * from barang_pinjam order by tanggal desc");
	}
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo $b['nama_barang'] ?></td>
			<td><?php echo $b['nama_peminta'] ?></td>
			<td><?php echo $b['jumlah'] ?></td>
			<td><?php echo $b['tanggal_kembali'] ?></td>
			<td><?php 
			if($b['id_status'] == 1){
				echo "Di Pinjam";
			} else {
				echo "Dikembalikan";
			}  ?></td>
			<td>
			<?php
			if($b['id_status'] == 1) { ?>
				<a href="edit_pinjam.php?id=<?php echo $b['id']; ?>&&nama==<?php echo $b['nama_barang']; ?>" class="btn btn-warning">Edit</a>
				<a href="kembali_pinjam.php?id=<?php echo $b['id']; ?>&&nama==<?php echo $b['nama_barang']; ?>" class="btn btn-success">Kembali</a>
				<a href="pinjam-r.php?nama_peminta=<?php echo $b['nama_peminta']; ?>" class="btn btn-info">Print</a>
			<?php } else { 
				if($b['tgl_kembali'] == date('Y-m-d')) {?>
				<a href="cancel_kembali.php?id=<?php echo $b['id']; ?>&&nama==<?php echo $b['nama_barang']; ?>" class="btn btn-danger">Cancel</a>
			
				<?php }}
			?></td>
		</tr>

		<?php 
	}
	?>
	
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Barang Pinjam
				</div>
				<div class="modal-body">				
					<form action="barang_pinjam_act.php" method="POST" onsubmit="return checkform(this);">
						
						<div class="form-group">
							<label>Nama Barang</label>								
							<select class="form-control" name="nama">
								<?php 
								$brg=mysqli_query($conn,"select * from barang");
								while($b=mysqli_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
									<?php 
								}
								?>
							</select>

						</div>	
							<div class="form-group">
							<label>Nama Peminta</label>
							<input name="nama_p" type="text" class="form-control" placeholder="Nama Peminta" autocomplete="off">
						</div>						
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="number" class="form-control" placeholder="Jumlah" autocomplete="off">
						</div>	
						<label>Tanggal Pinjam</label>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker'>
						<input type='text' class="form-control" name="tgl2"/>
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
						</div>
						<label>Tanggal Kembali</label>
						<div class="form-group">
						<div class='input-group date' id='datetimepicker2'>
						<input type='text' class="form-control" name="tgl3"/>
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
						</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/js/bootstrap-datetimepicker.min.js"></script>
	
	
	<script type="text/javascript">
	$(function () {
	$('#datetimepicker').datetimepicker({
	format: 'YY-MM-DD HH:mm:00',
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
	$(function () {
	$('#datetimepicker2').datetimepicker({
	format: 'YY-MM-DD HH:mm:00',
	});
  
	$('#datepicker2').datetimepicker({
	format: 'DD MMMM YYYY',
	});
  
	$('#timepicker2').datetimepicker({
	format: 'HH:mm'
	});
	});
	</script>



	<?php include 'footer.php'; ?>