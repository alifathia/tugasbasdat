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
			.salah{
				color: red;
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
		
		<?php
	
		$connection = pg_connect ("host=localhost dbname=sirima user=postgres password=postgres");
		
		if($connection) {
		echo 'connected';
		} else {
		echo 'there has been an error connecting';
		} 
		
		$query = "SET search_path to SIRIMA";
		$result = pg_query($query);
		//$row = pg_fetch_assoc($result);
		//while ($row){
		//echo "<option value=\"owner1\">" . $row['username'] . "</option>";
		//}
		?>

		<div class="container-fluid">
			<h2 class="text-center">Pendaftaran SEMAS Sarjana</h2>
		</div>

		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<form id="daftar" action="pelamar_daftar_semas_sarjana.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="asal">Asal Sekolah</label>
							<input type="text" class="form-control" id="insert-asalSekolah" name="asalSekolah" placeholder="Contoh: SMA N 1 Jakarta" required>
						</div>
						<div class="form-group">
							<label for="jenis">Jenis SMA</label>
							<div class="form-group">
				              <select class="form-control" id="jenisSMA" required>
				                <option value="IPA">IPA</option>
				                <option value="IPS">IPS</option>
				                <option value="Bahasa">Bahasa</option>
				              </select>
				            </div>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat Sekolah</label>
							<input type="text" class="form-control" id="insert-alamatSekolah" name="alamatSekolah" placeholder="Alamat Sekolah" required>
						</div>
						<div class="form-group">
							<label for="nisn">NISN</label>
							<input type="text" class="form-control" id="insert-nisn" name="nisn" placeholder="NISN" max="10" required>
							<p id="alert_nisn" class="salah"></p>
							<span class="help-block">maksimal 10 karakter angka</span>
						</div>
							<div class="form-group">
							<label for="tanggal-lulus">Tanggal Lulus</label>
							<input class="form-control" id="date" nama="date" type="date" required>
						</div>
						<div class="form-group">
							<label for="uan">Nilai UAN</label>
							<input type="text" class="form-control" id="insert-uan" name="nilaiuan" placeholder="Contoh: 40.60" required>
							<p id="alert_uan" class="salah"></p>
							<span class="help-block">Nilai dalam bentuk angka (bisa desimal)</span>
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 1</label>
							<div class="form-group">
				              <select class="form-control" name="prodi1" id="prodi1" required>
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP
										WHERE PP.nomor_periode='3' and PP.tahun_periode='2017' and PP.kode_prodi=PS.kode";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc ($result)){
									echo "<option name='". htmlspecialchars($row['nama']) ."'>" . htmlspecialchars($row['nama']) . "</option>";
								}
								?>
				              </select>
				            </div>
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 2</label>
							<div class="form-group">
				              <select class="form-control" name="prodi2" id="prodi2">
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP
										WHERE PP.nomor_periode='3' and PP.tahun_periode='2017' and PP.kode_prodi=PS.kode";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc ($result)){
									echo "<option name='". htmlspecialchars($row['nama']) ."'>" . htmlspecialchars($row['nama']) . "</option>";
								}
								?>
				              </select>
							  <span class="help-block">Harap diisi berbeda dengan prodi pilihan 1</span>
				            </div>
						</div>
						<div class="form-group">
							<label for="prodi1">Prodi Pilihan 3</label>
							<div class="form-group">
				              <select class="form-control" name="prodi3" id="prodi3">
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP
										WHERE PP.nomor_periode='3' and PP.tahun_periode='2017' and PP.kode_prodi=PS.kode";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc ($result)){
									echo "<option name='". htmlspecialchars($row['nama']) ."'>" . htmlspecialchars($row['nama']) . "</option>";
								}
								?>
				              </select>
							  <span class="help-block">Harap diisi berbeda dengan prodi pilihan 1 dan 2</span>
				            </div>
						</div>				
						<div class="form-group">
							<label for="kota">Lokasi Kota Ujian</label>
							<select id="Kota" class="form-control" role="listbox" required>
								<?php
								$query = "SELECT kota
										FROM LOKASI_JADWAL
										WHERE nomor_periode='3' and tahun_periode='2017' and jenjang='S1'";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc($result)){
									echo "<option name='". htmlspecialchars($row['kota']) ."'>" . htmlspecialchars($row['kota']) . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="tempat">Lokasi Tempat Ujian</label>
							<select id="second" class="form-control" role="listbox">
							</select>
						</div>
						<input type="hidden" id="daftar-command" name="command" value="daftar">
						<button type="submit" class="btn btn-primary" onclick="myFunction()">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		
		<script>
		function myFunction() {
			var nisn, nilaiuan, text;
			var isValid = true;

			// Get the value of the input field
			nisn = document.getElementById("insert-nisn").value;
			nilaiuan = document.getElementById("insert-uan").value;

			if (isNaN(nisn) || nisn > 9999999999) {
				text = "Input harus berupa angka dan tidak boleh lebih dari 10 angka";
				document.getElementById("alert_nisn").innerHTML = text;
				isValid = false;
			}
			
			if (isNaN(nilaiuan)) {
				text = "Input harus berupa angka";
				document.getElementById("alert_uan").innerHTML = text;
				isValid = false;
			}
			
		}
		</script>
		
		

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

<?php
function daftar(){

    $prodi1 = $_POST['prodi1'];
	$prodi2 = $_POST['prodi2'];
	$prodi3 = $_POST['prodi3'];
	
	if($prodi1 = $prodi2 = $prodi3 || $prodi1 = $prodi2 || $prodi1 = $prodi3 || $prodi2 = $prodi3){
		$message = "Prodi pilihan 1, 2, dan 3 tidak boleh sama!";
	} else {
		//header("Location: pelamar_bayar.php");
	}
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['command'] === 'daftar'){
        daftar();
    }
}
?>