<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<hr>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
<br/>
<br/>

<!-Validasi Form->
<script language="JavaScript" type="text/javascript">
    function checkform ( form )
    {
      if (form.nama.value == "") {
        alert( "Maaf, Nama Barang tidak boleh dikosongkan !" );
        form.nama.focus();
        return false ;
      }   
		else if (form.jumlah.value == "") {
        alert( "Maaf, Jumlah Barang tidak boleh dikosongkan !" );
        form.jumlah.focus();
        return false ;
      }
      return true ;
    }
	
	
	
</script>
<!-Validasi Form->

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
$per_hal=30;
$jumlah_record=mysqli_query($conn,"SELECT COUNT(*) from barang");
$jum=mysqli_num_rows($jumlah_record);
$halaman=ceil($jum[0] / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-10">
	
	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-4">Nama Barang</th>
		<th class="col-md-1">Stok Sekarang</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysqli_real_escape_string($conn,$_GET['cari']);
		$brg=mysqli_query($conn,"select * from barang where nama like '$cari'");
	}else{
		$brg=mysqli_query($conn,"select * from barang limit $start, $per_hal");
	}
	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['jumlah'] ?></td>
			
			<td>
				<a href="det_barang.php?id=<?php echo $b['id']; ?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id=<?php echo $b['id']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['id']; ?>' }" class="btn btn-danger">Hapus</a>
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
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
			
			
				<form action="tmb_brg_act.php" method="post" name="tamb_barang" onsubmit="return checkform(this);">
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang" id="barang">
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" id="jumlah">
					</div>				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>

<?php 
include 'footer.php';

?>