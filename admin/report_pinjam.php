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
<script language="JavaScript" type="text/javascript">
    function checkform ( form )
    {
      if (form.tgl.value == "") {
        alert( "Maaf, Tanggal 1 tidak boleh dikosongkan !" );
        form.tgl.focus();
        return false ;
      }   
		else if (form.tgl2.value == "") {
        alert( "Maaf, Tanggal 2 tidak boleh dikosongkan !" );
        form.tgl2.focus();
        return false ;
      }
      return true ;
    }
	
	
	
</script>

<h3><span class="glyphicon glyphicon-briefcase"></span> Laporan Peminjaman Per Periode</h3>
<hr>
                <form action="cetak_periode_pinjam.php" method="post" onsubmit = "return checkform(this);">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4">Tanggal 1</label>
							<div class="col-md-8">
								<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
							</div>
						</div>	
					</div>	
					</div>
				<div class="row"><p>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4">Tanggal 2</label>
							<div class="col-md-8">
								<input name="tgl2" type="text" class="form-control" id="tgl2" autocomplete="off">
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

<!-- modal input -->



<script type="text/javascript">
    $(document).ready(function () {
        $("#tgl").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tgl2").datepicker({dateFormat: 'yy-mm-dd'});
    });
</script>