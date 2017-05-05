<!doctype html>
<html>
	<head>
		<title>SIRIMA</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Lato');

			body{
				font-family: Lato;
			}
		</style>

		<nav class="navbar navbar-default">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="landing_pelamar.html">SIRIMA</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href=#>#namaPelamar</a></li>
		        <li><a href="../index.html">LOGOUT</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="container-fluid">
			<h2 class="text-center">Pendaftaran SEMAS Sarjana</h2>
		</div>

		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="asal">Asal Sekolah</label>
							<input type="text" class="form-control" id="insert-asalSekolah" name="asalSekolah" placeholder="Contoh: SMA N 1 Jakarta">
						</div>
						<div class="form-group">
							<label for="jenis">Jenis SMA</label>
							<div class="form-group">
				              <select class="form-control" id="jenisSMA" >
				              	<option selected>--Pilih jenis SMA--</option>
				                <option value="IPA">IPA</option>
				                <option value="IPS">IPS</option>
				                <option value="Bahasa">Bahasa</option>
				              </select>
				            </div>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat Sekolah</label>
							<input type="text" class="form-control" id="insert-alamatSekolah" name="alamatSekolah" placeholder="Alamat Sekolah">
						</div>
						<div class="form-group">
							<label for="nisn">NISN</label>
							<input type="text" class="form-control" id="insert-nisn" name="nisn" placeholder="NISN">
						</div>
							<div class="form-group">
							<label for="tanggal-lulus">Tanggal Lulus</label>
							<input class="form-control" id="date" nama="date" type="date">
						</div>
						<div class="form-group">
							<label for="uan">Nilai UAN</label>
							<input type="text" class="form-control" id="insert-uan" name="nilaiuan" placeholder="Contoh: 4.60">
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 1</label>
							<div class="form-group">
				              <select class="form-control" id="prodi1">
				              	<option selected>--Pilih Program Studi--</option>
				                <option value="Kedokteran">Kedokteran</option>
				                <option value="Matematika">Matematika</option>
				                <option value="Teknik Sipil">Biologi</option>
				                <option value="Teknik Sipil">Teknik Sipil</option>
				                <option value="Teknik Sipil">Teknik Industri</option>
				                <option value="Teknik Sipil">Ilmu Komputer</option>
				              </select>
				            </div>
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 2</label>
							<div class="form-group">
				              <select class="form-control" id="prodi2">
				              	<option selected>--Pilih Program Studi--</option>
				                <option value="Kedokteran">Kedokteran</option>
				                <option value="Matematika">Matematika</option>
				                <option value="Teknik Sipil">Biologi</option>
				                <option value="Teknik Sipil">Teknik Sipil</option>
				                <option value="Teknik Sipil">Teknik Industri</option>
				                <option value="Teknik Sipil">Ilmu Komputer</option>
				              </select>
				            </div>
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 3</label>
							<div class="form-group">
				              <select class="form-control" id="prodi3">
				              	<option selected>--Pilih Program Studi--</option>
				                <option value="Kedokteran">Kedokteran</option>
				                <option value="Matematika">Matematika</option>
				                <option value="Teknik Sipil">Biologi</option>
				                <option value="Teknik Sipil">Teknik Sipil</option>
				                <option value="Teknik Sipil">Teknik Industri</option>
				                <option value="Teknik Sipil">Ilmu Komputer</option>
				              </select>
				            </div>
						</div>				
						<div class="form-group">
							<label for="kota">Lokasi Kota Ujian</label>
							<select id="Kota" class="form-control" role="listbox">
							  <option value="0" selected="selected">--Pilih Lokasi Kota--</option>
							  <option value="Depok">Depok</option>
							  <option value="Serang">Serang</option>
							  <option value="Jakarta">Jakarta</option>
							  <option value="Bandung">Bandung</option>
							  <option value="Kuta">Kuta</option>
							  <option value="Tanggerang">Tanggerang</option>
							  <option value="Bogor">Bogor</option>
							  <option value="Balikpapan">Balikpapan</option>
							  <option value="Aceh">Aceh</option>
							</select>
						</div>
						<div class="form-group">
							<label for="tempat">Lokasi Tempat Ujian</label>
							<select id="second" class="form-control" role="listbox">
							  <option value="0" selected="selected">--Pilih Lokasi Tempat--</option>
							  <option value="1">Option 1</option>
							  <option value="2">Option 2</option>
							  <option value="3">Option 3</option>
							  <option value="4">Option 4</option>
							</select>
						</div>
						<input type="hidden" id="insert-command" name="command" value="insert">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bayarModal">Simpan</button>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="bayarModal" role="document">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
		          		<button type="button" class="close" data-dismiss="modal">&times;</button>
		          		<h3 class="modal-title">Pembayaran</h3>
		        	</div>
					<div class="modal-body">
						<form action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="idDaftar">ID Pendaftaran :</label>
							</div>
							<div class="form-group">
								<label for="biaya">Biaya :</label>
							</div>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#suksesModal">Bayar</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="suksesModal" role="dialog">
		    <div class="modal-dialog">
		      	<div class="modal-content">
		        	<div class="modal-header">
		          		<h3 class="modal-title">Pendaftaran Sukses</h3>
		        	</div>
		        	<div class="modal-body">
		          		<p class="text-center">Selamat pembayaran berhasil dilakukan</p>
		          		<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="idDaftar">ID Pendaftaran :</label>
						</div>
						<div class="form-group">
							<label for="biaya">ID Pembayaran :</label>
						</div>
						<div class="form-group">
							<label for="kartu">Nomor Kartu Ujian :</label>
						</div>
					</form>
		        	</div>
		        	<div class="modal-footer">
		          		<button type="button" class="btn btn-success"><a href="pelamar-pilih-jenjang.php">Selesai</a></button>
		        	</div>
		      	</div>
		    </div>
		</div>


		<!-- More Script -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="script.js"></script>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

		<style type="text/css">
	</body>
</html>