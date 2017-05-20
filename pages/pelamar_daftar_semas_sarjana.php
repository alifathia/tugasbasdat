<?php
	session_start();
	
	function connectDB(){
		//create connection
		$connection = pg_connect("host=localhost dbname=sirima user=postgres password=postgres");

		//check connection
		if(!$connection) {
			echo 'there has been an error connecting';
		}
		return $connection;
	}

	function daftar(){
		
		$prodi1 = $_POST['prodi1'];
		$prodi2 = $_POST['prodi2'];
		$prodi3 = $_POST['prodi3'];
		
		if((($prodi1 == $prodi2)&&($prodi1 == $prodi3)&&($prodi2 == $prodi3)) || $prodi1 == $prodi2 || $prodi1 == $prodi3 || $prodi2 == $prodi3){
			$message = "Prodi pilihan 1, 2, dan 3 tidak boleh sama!";
		} else {
			insertDaftar();
		}
	}
	
	function insertDaftar(){
		$conn = connectDB();
		
		$query = "SET search_path to SIRIMA";
		$result = pg_query($query);
		
		//get pelamar username
		$pelamar = $_SESSION['username'];
		
		//get periode aktif
		$query_periode = "SELECT * FROM PERIODE_PENERIMAAN WHERE status_aktif = 'true'";
		$result_periode = pg_query($query_periode);
		$row_periode = pg_fetch_assoc($result_periode);
		//$nomor_periode
		$nomor_periode = $row_periode['nomor'];
		//$tahun_periode
		$tahun_periode = $row_periode['tahun'];
		
		$asalSekolah = $_POST['asalSekolah'];
		$jenisSMA = $_POST['jenisSMA'];
		$alamatSekolah = $_POST['alamatSekolah'];
		$nisn = $_POST['nisn'];
		$tanggalLulus = $_POST['tanggalLulus'];
		$nilaiuan = $_POST['nilaiuan'];
		$prodi1 = $_POST['prodi1'];
		$prodi2 = $_POST['prodi2'];
		$prodi3 = $_POST['prodi3'];
		$kotaUjian = $_POST['kotaUjian'];
		
		//get tempat ujian yang sesuai dengan lokasi
		$query_tempat = "SELECT * FROM LOKASI_UJIAN WHERE kota = '$kotaUjian'";
		$result_tempat = pg_query($query_tempat);
		$row_tempat = pg_fetch_assoc($result_tempat);
		//$tempatUjian
		$tempatUjian = $row_tempat['tempat'];
		
		//get id_pendaftaran, get last result
		$query_id = "SELECT * FROM PENDAFTARAN WHERE id = (SELECT MAX(id) FROM PENDAFTARAN)";
		$result_id = pg_query($query_id);
		$row_id = pg_fetch_assoc($result_id);
		//$id_pendaftaran
		$id_pendaftaran = 1 + $row_id['id'];
		
		
		
		$query1 = "INSERT INTO PENDAFTARAN (id, status_lulus, status_verifikasi, npm, pelamar, nomor_periode, tahun_periode) VALUES ('$id_pendaftaran', 'false', 'TRUE', 'NULL', '$pelamar', '$nomor_periode', '$tahun_periode')";
		$insert1 = pg_query($query1);
		if($insert1){
			echo "<script type='text/javascript'>alert('masuk pendaftaran');</script>";
		} else {
			echo "<script type='text/javascript'>alert('ga masuk pendaftaran');</script>";
		}
		
		$query2 = "INSERT INTO PENDAFTARAN_SEMAS (id_pendaftaran, status_hadir, nilai_ujian, no_kartu_ujian, lokasi_kota, lokasi_tempat) VALUES ('$id_pendaftaran', 'false', 'null', 'null', '$kotaUjian', '$tempatUjian')";
		$insert2 = pg_query($query2);
		
		$query3 = "INSERT INTO PENDAFTARAN_SEMAS_SARJANA (id_pendaftaran, asal_sekolah, jenis_sma, alamat_sekolah, nisn, tgl_lulus, nilai_uan) VALUES ('$id_pendaftaran', '$asalSekolah', '$jenisSMA', '$alamatSekolah', '$nisn', '$tanggalLulus', '$nilaiuan')";
		$insert3 = pg_query($query3);
		
		
		//get kode_prodi 1
		$query_prodi = "SELECT * FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP WHERE PS.nama = '$prodi1' AND PS.kode = PP.kode_prodi AND PP.nomor_periode = '$nomor_periode' AND PP.tahun_periode = '$tahun_periode'";
		$result_prodi = pg_query($query_prodi);
		$row_prodi = pg_fetch_assoc($result_prodi);
		$kode_prodi1 = $row_prodi['kode'];
		$query4 = "INSERT INTO PENDAFTARAN_PRODI (id_pendaftaran, kode_prodi, status_lulus) VALUES ('$id_pendaftaran', '$kode_prodi1', 'false')";
		$insert4 = pg_query($query4);
		
		if($prodi2 != "Pilih Prodi"){
			$query_prodi = "SELECT * FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP WHERE PS.nama = '$prodi2' AND PS.kode = PP.kode_prodi AND PP.nomor_periode = '$nomor_periode' AND PP.tahun_periode = '$tahun_periode'";
			$result_prodi = pg_query($query_prodi);
			$row_prodi = pg_fetch_assoc($result_prodi);
			$kode_prodi2 = $row_prodi['kode'];
			$query4 = "INSERT INTO PENDAFTARAN_PRODI (id_pendaftaran, kode_prodi, status_lulus) VALUES ('$id_pendaftaran', '$kode_prodi2', 'false')";
			$insert4 = pg_query($query4);
		}
		
		if($prodi3 != "Pilih Prodi"){
			$query_prodi = "SELECT * FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP WHERE PS.nama = '$prodi3' AND PS.kode = PP.kode_prodi AND PP.nomor_periode = '$nomor_periode' AND PP.tahun_periode = '$tahun_periode'";
			$result_prodi = pg_query($query_prodi);
			$row_prodi = pg_fetch_assoc($result_prodi);
			$kode_prodi3 = $row_prodi['kode'];
			$query4 = "INSERT INTO PENDAFTARAN_PRODI (id_pendaftaran, kode_prodi, status_lulus) VALUES ('$id_pendaftaran', '$kode_prodi3', 'false')";
			$insert4 = pg_query($query4);
		}
		
		pg_close();
		//header("Location: pelamar_bayar.php");
	}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['command'] === 'bayar'){
		daftar();
    }
}
?>

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
		      <a class="navbar-brand" href="landing_pelamar.php">SIRIMA</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="logout.php">LOGOUT</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		
		<?php
		
		$connection = pg_connect("host=localhost dbname=sirima user=postgres password=postgres");
		
		if($connection) {
		echo 'connected';
		} else {
		echo 'there has been an error connecting';
		} 
		
		$query = "SET search_path to SIRIMA";
		$result = pg_query($query);
		
		?>

		<div class="container-fluid">
			<h2 class="text-center">Pendaftaran SEMAS Sarjana</h2>
		</div>

		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<form id="daftar" action="pelamar_daftar_semas_sarjana.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
						<div class="form-group">
							<label for="asal">Asal Sekolah</label>
							<input type="text" class="form-control" id="insert-asalSekolah" name="asalSekolah" placeholder="Contoh: SMA N 1 Jakarta" required>
						</div>
						<div class="form-group">
							<label for="jenis">Jenis SMA</label>
							<div class="form-group">
				              <select class="form-control" name="jenisSMA" id="jenisSMA" required>
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
							<input class="form-control" id="date" name="tanggalLulus" type="date" required>
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
				              <select class="form-control" name="prodi1" id="prodi1" >
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP, PERIODE_PENERIMAAN PP2
										WHERE PP2.status_aktif = 'true' and PP2.nomor=PP.nomor_periode and PP2.tahun=PP.tahun_periode  and PP.kode_prodi=PS.kode";
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
								<option selected>Pilih Prodi Pilihan 2</option>
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP, PERIODE_PENERIMAAN PP2
										WHERE PP2.status_aktif = 'true' and PP2.nomor=PP.nomor_periode and PP2.tahun=PP.tahun_periode  and PP.kode_prodi=PS.kode";
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
								<option selected>Pilih Prodi Pilihan 3</option>
								<?php
								$query = "SELECT PS.nama
										FROM PROGRAM_STUDI PS, PENERIMAAN_PRODI PP, PERIODE_PENERIMAAN PP2
										WHERE PP2.status_aktif = 'true' and PP2.nomor=PP.nomor_periode and PP2.tahun=PP.tahun_periode  and PP.kode_prodi=PS.kode";
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
							<select id="Kota" name="kotaUjian" class="form-control" role="listbox" >
								<?php
								$query = "SELECT kota
										FROM LOKASI_JADWAL LJ, PERIODE_PENERIMAAN PP
										WHERE PP.status_aktif = 'true' and PP.nomor=LJ.nomor_periode and PP.tahun=LJ.tahun_periode  and LJ.jenjang='S1'";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc($result)){
									echo "<option name='". htmlspecialchars($row['kota']) ."'>" . htmlspecialchars($row['kota']) . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="tempat">Lokasi Tempat Ujian</label>
							<select id="tempat" name="tempatUjian" class="form-control" role="listbox">
								<?php
								$query = "SELECT tempat
										FROM LOKASI_JADWAL LJ, PERIODE_PENERIMAAN PP
										WHERE PP.status_aktif = 'true' and PP.nomor=LJ.nomor_periode and PP.tahun=LJ.tahun_periode  and LJ.jenjang='S1'";
								$result = pg_query($query);
								
								while ($row = pg_fetch_assoc($result)){
									echo "<option name='". htmlspecialchars($row['tempat']) ."'>" . htmlspecialchars($row['tempat']) . "</option>";
								}
								?>
							</select>
						</div>
						<input type="hidden" id="bayar-command" name="command" value="bayar">
						<button type="submit" class="btn btn-danger">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		
		<script>
		
		function validate(){
			var flag = true;
			var message = "";
			var cek_nisn = nisn = document.getElementById("insert-nisn").value;
			var cek_uan = nilaiuan = document.getElementById("insert-uan").value;
			
			if(isNaN(cek_nisn)){
				flag = false;
				message += "NISN harus berupa angka\n";
			}
			
			if(cek_nisn.length > 10){
				flag = false;
				message += "NISN tidak boleh lebih dari 10 karakter angka\n";
			}
			
			if(isNaN(cek_uan)){
				flag = false;
				message += "Nilai UAN harus berupa angka \n";
			}
			
			if(!flag){
				alert(message);
			}
			
			return flag;
		}
		</script>
		
		

		<!-- More Script -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

		<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

		<style type="text/css">
	</body>
</html>

