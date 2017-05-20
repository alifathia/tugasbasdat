<!DOCTYPE html>
<html>
	<head>
		<title>SIRIMA</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/drpdwn.js"></script>
		<link rel="stylesheet" href="../bootstrap-3.3.7/css/bootstrap.min.css">
		<script src="../bootstrap-3.3.7/js/jquery.min.js"></script>
		<script src="../bootstrap-3.3.7/js/bootstrap.min.js"></script>	
	</head>
	<body>
	 <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand topnav" href="#"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="rekap_pendaftaran.php">Rekap Pendaftaran</a>
                    </li>
                    <li>
                        <a href="pemilihan_prodi.php">Daftar Pelamar Diterima</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<br>
	<br>
	<br>
	
	<?php
	session_start();
	
	if(!isset($_SESSION["current_page_pelamar_diterima"]) && empty($_SESSION["current_page_pelamar_diterima"])){
			//echo "masuk sini";
			$nomor_periode = $_POST['periode_select'];
			$pemilihan_prodi = $_POST['prodi_select'];
			$_SESSION["pemilihan_prodi"] = $pemilihan_prodi;
			$arr = explode(" - ", $nomor_periode);
			$_SESSION["nomor"] = $arr[0];
			
			$_SESSION["tahun"] = $arr[1];
		
			$arr2 = explode(" ", $pemilihan_prodi);
			$_SESSION["jenjang"] = $arr2[0]; //ambil jenjang (s1, s2, s3)
			$_SESSION["jenis_kelas"] = end($arr2); //ambil yang terakhir, keluar reguler, paralel, atau internasional
			end($arr2);
			$_SESSION["jurusan"] = prev($arr2); //ambil elemen sebelum terakhir, biar dapet jurusan
			
			/*
			echo $_SESSION["nomor"];
			echo "<p>";
			echo $_SESSION["tahun"];
			echo "<p>";
			echo $_SESSION["jenjang"];
			echo "<p>";
			echo $_SESSION["jenis_kelas"];
			echo "<p>";
			echo $_SESSION["jurusan"];
			*/
		}
	
	$_SESSION["current_page_pelamar_diterima"] = isset($_GET["p"]) ? $_GET["p"] : 1;
	$connection = pg_connect ("host=localhost dbname=sirima user=postgres password=postgres");
    /*
	if($connection) {
    echo 'connected';
    } else {
    echo 'there has been an error connecting';
    } 
	*/
	
	$query = "SET search_path to SIRIMA";
	$result = pg_query($query);
	$limit = 10;
	
	//$row = pg_fetch_assoc($result);
	//while ($row){
	//echo "<option value=\"owner1\">" . $row['username'] . "</option>";
	//}
	?>
	<div class="container-fluid">
	<h2 class="text-center">LIHAT PELAMAR DITERIMA</h2>
	<br>
	
	<p></p>
	<?php
				
		echo "<p> Pemilihan Prodi: " . $_SESSION["pemilihan_prodi"] . "</p>";
		echo "<p></p>";
		echo "<div class=pagination>";
		/*
		$query2 = "SELECT count(DISTINCT pend.id)
		FROM pelamar pel, pendaftaran pend, penerimaan_prodi penprod, program_studi progstud, periode_penerimaan perpen
		WHERE pend.nomor_periode='" . $_SESSION["nomor"] . "' AND pend.tahun_periode='" . $_SESSION["tahun"] . "' AND progstud.nama LIKE '%" . $_SESSION["jurusan"] . "' 
		AND progstud.jenjang = '" . $_SESSION["jenjang"] . "' AND penprod.kode_prodi = progstud.kode
		AND pend.pelamar = pel.username AND pend.status_lulus = true
		AND penprod.tahun_periode = perpen.tahun AND perpen.tahun = pend.tahun_periode;";
		*/
		$query2 = "SELECT count(pen.id)
			FROM pendaftaran_prodi penprod, pendaftaran pen, pelamar pel, program_studi progstud
			WHERE penprod.id_pendaftaran = pen.id 
			AND pen.pelamar = pel.username 
			AND penprod.kode_prodi = progstud.kode 
			AND penprod.status_lulus = TRUE 
			AND progstud.jenjang = '" . $_SESSION["jenjang"] . "' 
			AND progstud.nama LIKE '%" . $_SESSION["jurusan"] . "' 
			AND progstud.jenis_kelas = '" . $_SESSION["jenis_kelas"] . "' 
			AND pen.tahun_periode = '" . $_SESSION["tahun"] . "';
		";
		$result2 = pg_query($query2);
		$page_count = ceil(pg_fetch_assoc($result2)["count"] / $limit);
		if($page_count > 1){
			for($i=1; $i <= $page_count; $i++){
				if($i == $_SESSION["current_page_pelamar_diterima"]){
					echo "<li class=\"page-item active\"><a class =\"page-link\" href=\"pelamar_diterima.php?p=$i\">$i</a></li>";
				} else {
					echo "<li class=\"page-item\"><a class =\"page-link\" href=\"pelamar_diterima.php?p=$i\">$i</a></li>";
				}
			}
		}
		echo "</div>";
	?>
	
	
	<div class="table-responsive">
	<table class ="table table-striped table-hover ">
	<thead>
	<tr> <th>Id Pendaftaran</th> 
			<th>Nama Lengkap</th> 
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
			<th>Tanggal Lahir</th>
			<th>No KTP</th>
			<th>Email</th>
	</tr>
	</thead>
	
	<tbody>
	<?php
		$counter = $_SESSION['current_page_pelamar_diterima'] - 1;
		/*
		$query = "SELECT DISTINCT progstud.nama, pend.id, pel.nama_lengkap, pel.alamat, pel.jenis_kelamin, pel.tanggal_lahir, pel.no_ktp, pel.email
		FROM pelamar pel, pendaftaran pend, penerimaan_prodi penprod, program_studi progstud, periode_penerimaan perpen
		WHERE pend.nomor_periode='" . $_SESSION["nomor"] . "' AND pend.tahun_periode='" . $_SESSION["tahun"] . "' AND progstud.nama LIKE '%" . $_SESSION["jurusan"] . "' 
		AND progstud.jenjang = '" . $_SESSION["jenjang"] . "' AND penprod.kode_prodi = progstud.kode
		AND pend.pelamar = pel.username AND pend.status_lulus = true
		AND penprod.tahun_periode = perpen.tahun AND perpen.tahun = pend.tahun_periode
		ORDER BY pend.id
		LIMIT $limit OFFSET ($counter * $limit) ;";
		*/
		$query = "SELECT pen.id, pel.nama_lengkap, pel.alamat, pel.jenis_kelamin, pel.tanggal_lahir, pel.no_ktp, pel.email
			FROM pendaftaran_prodi penprod, pendaftaran pen, pelamar pel, program_studi progstud
			WHERE penprod.id_pendaftaran = pen.id 
			AND pen.pelamar = pel.username 
			AND penprod.kode_prodi = progstud.kode 
			AND penprod.status_lulus = TRUE 
			AND progstud.jenjang = '" . $_SESSION["jenjang"] . "' 
			AND progstud.nama LIKE '%" . $_SESSION["jurusan"] . "' 
			AND progstud.jenis_kelas = '" . $_SESSION["jenis_kelas"] . "' 
			AND pen.tahun_periode = '" . $_SESSION["tahun"] . "'
			LIMIT $limit OFFSET ($counter * $limit);";
		$result = pg_query($query);
		while ($row = pg_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>{$row['id']}</td>";
			echo "<td>{$row['nama_lengkap']}</td>";
			echo "<td>{$row['alamat']}</td>";
			echo "<td>{$row['jenis_kelamin']}</td>";
			echo "<td>{$row['tanggal_lahir']}</td>";
			echo "<td>{$row['no_ktp']}</td>";
			echo "<td>{$row['email']}</td>";
			//echo "<td>{$row['nama']}</td>";
			echo "</tr>";
		}
	
	?>	
	</tbody>
	</table>
	</div>
	</div>
	</body>
</html> 