<?php
include"config.php";
include"header.php";
?>
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
<h3><span class="glyphicon glyphicon-briefcase"></span> Laporan Per Barang</h3>
<hr>
                <form action="cetak_barang.php" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4">Nama Barang</label>
							<div class="col-md-8">
							<select class="form-control" name="nama_barang">
								<?php 
								$brg=mysqli_query($conn,"select nama from barang");
								while($b=mysqli_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama']; ?>"><?php echo $b['nama'] ?></option>
									<?php 
								}
								?>
							</select><br>
								
							</div>
							<div class="form-group">
							<label class="col-md-4">Tanggal 1</label>
							<div class="col-md-8">
							<input name="tanggal1" type="text" class="form-control" id="tanggal1" autocomplete="off">
								
							</select><p>
								
							</div>
							</div><br><br>	
							<div class="form-group">
							<label class="col-md-4">Tanggal 2</label>
							<div class="col-md-8">
							<input name="tanggal2" type="text" class="form-control" id="tanggal2" autocomplete="off">
								
							</input>
								
							</div>
						</div>
						</div>	
					</div>	
					</div>	
            <br><br><br>
			
            <div class="container">
                <input type="reset" class="btn btn-danger" value="Reset">												
                <input type="submit" class="btn btn-primary" value="Cetak" name="cetak">
            </div>
            </form>
        </div>
    </div>
</div>


<br/>
</table>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tanggal1").datepicker({dateFormat : 'yy-mm-dd'});							
		});
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#tanggal2").datepicker({dateFormat : 'yy-mm-dd'});							
		});
</script>
