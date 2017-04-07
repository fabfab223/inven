<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
	include 'cek.php';
	include 'config.php';
	?>
	<title>Aplikasi Inventori || GreatSoft Solusi Indonesia</title>
	<link rel="icon" type="image/png" href="http://thegreatsoft.com/assets/user/images/kallyas_icon.png">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>	
	<link rel="stylesheet" type="text/css" href="assets/dropdown.css">
	<!--link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"></link-->
	<!--link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.min.css" rel="stylesheet"></link-->
	<link href="../assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet"></link>
	
	
	</head>
	<body>

	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="http://www.thegreatsoft.com" class="navbar-brand">GreatSoft Solusi Indonesia</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse">				
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>&nbsp;&nbsp;Notification</a></li>
					<li>
						<a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Welcome , <?php echo $_SESSION['uname']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Pesan Notification</h4>
				</div>
				
				<div class="modal-body">
					<?php 
					
						$periksa=mysqli_query($conn,"select * from barang where jumlah <=5");
						while($q=mysqli_fetch_array($periksa)){	
						
							if($q['jumlah']<=5) {			
								echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok <a style='color:red' href='./barang.php?cari=".$q['nama']."'>". $q['nama']."</a> yang tersisa sudah kurang dari 5 . Silahkan pesan lagi !!</div>";	
							}
						
						}
						
						$periksa_tgl_kmbli=mysqli_query($conn,"select * from barang_pinjam where date(tanggal_kembali)<=date(now()) and tgl_kembali is null");
						while($r=mysqli_fetch_array($periksa_tgl_kmbli)){	
						
							if($r['tanggal_kembali'] <= date('Y-m-d')+1) {			
								echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Barang <a style='color:red' href='./borrow.php'>". $r['nama_barang']."</a> di pinjam oleh <a style='color:red'>". $r['nama_peminta']."</a> tanggal <a style='color:red'>". date_format(date_create($r['tanggal_kembali']),'d-M-Y')."</a> belum dikembalikan</div>";	
							}
						
						}
					
					?>
				</div>
				
				<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
				
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="row">
						<?php 
						
						$use=$_SESSION['uname'];
						$fo= mysqli_query($conn,"select foto from admin where uname='$use'");
						while($f=mysqli_fetch_array($fo)){
					
					
						?>				

			<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
					<img class="img-responsive" src="foto/<?php echo $f['foto']; ?>"></a>
			</div>
			
						<?php 
			}
						?>		
		</div>

		<div class="row"></div>
		
		</li>
		<ul class="nav nav-pills nav-stacked navbar-collapse">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li><a href="barang.php"><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</a></li>
			<li><a href="#.php"><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Output</a>
			<ul>
			<li><a href="borrow.php">Peminjaman Barang</a>
			<li><a href="output.php">Permintaan Barang</a>
			</li>
			</ul></li>
			<li><a href="input.php"><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Input</a>
			</li>
			<li><a href="#"><span class="glyphicon glyphicon-briefcase"></span>  Laporan Permintaan Barang</a>
			<ul class="">
			<li><a href="report.php">Per Periode</a></li>
			<li><a href="rep_user.php">Per User </a></li>
			<li><a href="rep_barang.php">Per Barang</a> </li>
			</ul>
			</li>
			<li><a href="#"><span class="glyphicon glyphicon-briefcase"></span>  Laporan Peminjaman Barang</a>
			<ul class="">
			<li><a href="report_pinjam.php">Per Periode</a></li>
			<li><a href="rep_user_pinjam.php">Per User </a></li>
			<li><a href="rep_barang_pinjam.php">Per Barang</a> </li>
			</ul>
			</li>
			
			<li><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>			
		</ul>
		
	
	</div>
	<div class="col-md-10">