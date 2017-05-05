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
                        <a href="index.html">Logout</a>
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
	$current_page = isset($_GET["p"]) ? $_GET["p"] : 1;
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
	$limit = 20;
	
	//$row = pg_fetch_assoc($result);
	//while ($row){
	//echo "<option value=\"owner1\">" . $row['username'] . "</option>";
	//}
	?>
	<div class="container-fluid">
	<h1>LIHAT PELAMAR DITERIMA</h1>
	<p>This is a paragraph.</p>
	
	<p></p>
	<?php
		$nomor_periode = $_POST['periode_select']; //nomor dan periode (cth. 2-2016)
		$pemilihan_prodi = $_POST['prodi_select'];
		
		$arr = explode(" - ", $nomor_periode);
		$nomor = $arr[0];
		$tahun = $arr[1];
		
		$arr2 = explode(" ", $pemilihan_prodi);
		$jenjang = $arr2[0]; //ambil jenjang (s1, s2, s3)
		$jenis_kelas = end($arr2); //ambil yang terakhir, keluar reguler, paralel, atau internasional
		end($arr2);
		$jurusan = prev($arr2); //ambil elemen sebelum terakhir, biar dapet jurusan
		
		/*
		echo $tahun . " + " . $pemilihan_prodi;
		echo "<p></p>";
		echo $jenis_kelas . " " . $jurusan . " " . $jenjang;
		echo "<p></p>";
		*/
		echo "Pemilihan Prodi: " . $pemilihan_prodi;
		echo "<p></p>";
		echo "<div class=pagination>";
		$query2 = "SELECT count(*)
		FROM pelamar pel, pendaftaran pend, penerimaan_prodi penprod, program_studi progstud, periode_penerimaan perpen
		WHERE pend.nomor_periode='" . $nomor . "' AND pend.tahun_periode='" . $tahun . "' AND progstud.nama LIKE '%" . $jurusan . "' 
		AND progstud.jenjang = '" . $jenjang . "' AND penprod.kode_prodi = progstud.kode
		AND pend.pelamar = pel.username AND pend.status_lulus = true
		AND penprod.tahun_periode = perpen.tahun AND perpen.tahun = pend.tahun_periode;";
		$result2 = pg_query($query2);
		$page_count = ceil(pg_fetch_assoc($result2)["count"] / $limit);
		if($page_count > 1){
			for($i=1; $i <= $page_count; $i++){
				if($i == $current_page){
					echo "<li class=\"page-item active\"><a class =\"page-link\" href=\"pelamar_diterima.php?p=$i\">$i</a></li>";
				} else {
					echo "<li class=\"page-item\"><a class =\"page-link\" href=\"pelamar_diterima.php?p=$i\">$i</a></li>";
				}
			}
		}
		echo "</div>";
	?>
	
	
	<div class="table-responsive">
	<table class ="table table-striped table-hover">
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
	
		$query = "SELECT DISTINCT progstud.nama, pend.id, pel.nama_lengkap, pel.alamat, pel.jenis_kelamin, pel.tanggal_lahir, pel.no_ktp, pel.email
		FROM pelamar pel, pendaftaran pend, penerimaan_prodi penprod, program_studi progstud, periode_penerimaan perpen
		WHERE pend.nomor_periode='" . $nomor . "' AND pend.tahun_periode='" . $tahun . "' AND progstud.nama LIKE '%" . $jurusan . "' 
		AND progstud.jenjang = '" . $jenjang . "' AND penprod.kode_prodi = progstud.kode
		AND pend.pelamar = pel.username AND pend.status_lulus = true
		AND penprod.tahun_periode = perpen.tahun AND perpen.tahun = pend.tahun_periode
		ORDER BY pend.id;";
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
			echo "<td>{$row['nama']}</td>";
			echo "</tr>";
		}
	
	?>	
	</tbody>
	</table>
	</div>
	</div>
	</body>
</html> 