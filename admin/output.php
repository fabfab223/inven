<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Permintaan Barang</h3>
<hr>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>


<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<input placeholder="Cetak Output Berdasarkan Tanggal" name="tanggal" class="form-control" id="tgl" onchange="this.form.submit()">
		</input>
	</div>

</form>
<br/>
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
	$tg="lap_barang_keluar.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_barang_keluar.php";
}
?>

<br/>
<?php 
if(isset($_GET['tanggal'])){
	echo "<h4> Data Output Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Nama Barang</th>
		<th>Nama Peminta </th>
		<th>Jumlah</th>					
		<th>Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['tanggal'])){
		$tanggal=mysqli_real_escape_string($conn,$_GET['tanggal']);
		$brg=mysqli_query($conn,"select * from barang_keluar where tanggal like '$tanggal' order by tanggal desc");
	}else{
		$brg=mysqli_query($conn,"select * from barang_keluar order by tanggal desc");
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
			<td>		
				<a href="edit_keluar.php?id=<?php echo $b['id']; ?>&&nama==<?php echo $b['nama_barang']; ?>" class="btn btn-warning">Edit</a>
<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_keluar.php?id=<?php echo $b['id']; ?>&nama_barang=<?php echo $b['nama_barang'];?> ' }" class="btn btn-danger">Hapus</a>
				<a href="receipt.php?nama_peminta=<?php echo $b['nama_peminta']; ?>" class="btn btn-info">Print</a>
			</td>
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
				<h4 class="modal-title">Tambah Barang Keluar
				</div>
				<div class="modal-body">				
					<form action="barang_keluar_act.php" method="POST">
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tgl2" type="text" class="form-control" id="tgl2" autocomplete="off">
						</div>	
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
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl2").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>