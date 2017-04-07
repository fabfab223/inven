<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<hr>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah </button>
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
 
include 'config.php';
 
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


<table class="table">

<tr>
<th class="col-md-1">No</th>
<th class="col-md-3">Nama Barang</th>
<th class="col-md-2">Stok Sekarang</th>
<th class="col-md-3">Opsi</th>
</tr>

 
<?php
	$batas = 10;
	$pg = isset( $_GET['pg'] ) ? $_GET['pg'] : "";
 
	if ( empty( $pg ) ) {
		$posisi = 0;
		$pg = 1;
	} else {
		$posisi = ( $pg - 1 ) * $batas;
	}

	if (isset($_GET['cari'])){
		$cari=mysqli_real_escape_string($conn,$_GET['cari']);
		//$brg=mysqli_query($conn,"select * from barang where nama='$cari'");
		$sql = mysqli_query($conn,"SELECT * FROM barang where nama='$cari' limit $posisi, $batas");
	}else{
		//$brg=mysqli_query($conn,"select * from barang limit $batas");
		$sql = mysqli_query($conn,"SELECT * FROM barang limit $posisi, $batas");
	}
 
	$no = 1+$posisi;
	while ( $r = mysqli_fetch_array( $sql ) ) {		
		?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $r['nama']; ?></td>
			<td><?= $r['jumlah']; ?></td>
			<td width="">		
				<a href="det_barang.php?id=<?php echo $r['id'];?>" class="btn btn-info">Detail</a>
				<a href="edit.php?id=<?php echo $r['id'];?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $r['id']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php
			$no++;
		}
		?>
		<tr>
			<td colspan="3">
			<?php
				if (isset($_GET['cari'])){
					$cari=mysqli_real_escape_string($conn,$_GET['cari']);
					//$sql = mysqli_query($conn,"SELECT * FROM barang where nama='$cari' limit $posisi, $batas");
					$jml_data = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM barang where nama='$cari'"));
				}else{
					//$sql = mysqli_query($conn,"SELECT * FROM barang limit $posisi, $batas");
					$jml_data = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM barang"));
				}
				//hitung jumlah data
				//Jumlah halaman
				$JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
			 
				//Navigasi ke sebelumnya
				if ( $pg > 1 ) {
					$link = $pg-1;
					$prev = "<a href='?pg=$link'><< </a>";
				} else {
					$prev = "<< ";
				}
				//Navigasi nomor
				$nmr = '';
				for ( $i = 1; $i<= $JmlHalaman; $i++ ){
					if ( $i == $pg ) {
						$nmr .= $i . " ";
					} else {
						$nmr .= "<a href='?pg=$i'>$i</a> ";
					}
				}
				 
				//Navigasi ke selanjutnya
				if ( $pg < $JmlHalaman ) {
					$link = $pg + 1;
					$next = " <a href='?pg=$link'>>></a>";
				} else {
					$next = " >>";
				}
				//Tampilkan navigasi
				echo $prev . $nmr . $next;
				?>
			</td>
		</tr>
	</table>
	<br />
	Total Data Anda adalah :<b> <?php echo $jml_data; ?> </b>
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