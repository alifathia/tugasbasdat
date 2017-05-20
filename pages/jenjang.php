<!DOCTYPE html>
<html>
	<head>
		<title>SIRIMA</title>
		<link rel="stylesheet" type="text/css" href="../css/style_pagination.css">
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
	
	if(!isset($_SESSION["current_page_jenjang"]) && empty($_SESSION["current_page_jenjang"])){
		
		$nomor_periode = $_POST['periode_select']; //nomor dan periode (cth. 2-2016)
		$jenjang = $_POST['jenjang_select'];
		
		$_SESSION["jenjang_j"] = $jenjang;
		
		$arr = explode(" - ", $nomor_periode);
		$_SESSION["nomor_j"] = $arr[0];
		$_SESSION["tahunperiode_j"] = $arr[1];
		
	}
	
	$_SESSION["current_page_jenjang"] = isset($_GET["p"]) ? $_GET["p"] : 1;
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
	<h2 class="text-center">REKAP PENDAFTARAN</h2>
	<br>
	<p></p>
	<?php
		/*
		$nomor_periode = $_POST['periode_select']; //nomor dan periode (cth. 2-2016)
		$jenjang = $_POST['jenjang_select'];
		
		$arr = explode(" - ", $nomor_periode);
		$nomor = $arr[0];
		$periode = $arr[1];
		
		ini buat ngecek, apus aja
		echo $periode . " + " . $jenjang;
		echo "<p></p>";
		*/
		echo "Jenjang: " . $_SESSION["jenjang_j"];
		echo "<p></p>";
		
		
		echo "<div class=pagination>";
		$query2 = "SELECT count(*)
		FROM penerimaan_prodi pp, program_studi ps 
		WHERE pp.nomor_periode='" . $_SESSION["nomor_j"] . "' 
		AND ps.jenjang='" . $_SESSION["jenjang_j"] . "' 
		AND pp.kode_prodi = ps.kode;";
		$result2 = pg_query($query2);
		$page_count = ceil(pg_fetch_assoc($result2)["count"] / $limit);
		if($page_count > 1){
			for($i=1; $i <= $page_count; $i++){
				if($i == $_SESSION["current_page_jenjang"]){
					echo "<li class=\"page-item active\"><a class =\"page-link\" href=\"jenjang.php?p=$i\">$i</a></li>";
				} else {
					echo "<li class=\"page-item\"><a class =\"page-link\" href=\"jenjang.php?p=$i\">$i</a></li>";
				}
			}
		}
		echo "</div>";
	?>
	
	<div class="table-responsive">
	<table class ="table table-striped table-hover">
	<thead>
	<tr> <th>Nama Prodi</th> 
			<th>Jenis Kelas</th> 
			<th>Nama Fakultas</th>
			<th>Kuota</th>
			<th>Jumlah Pelamar</th>
			<th>Jumlah Diterima</th>
	</tr>
	</thead>
	
	<tbody>
	<?php
		$counter = $_SESSION["current_page_jenjang"] - 1;
		$query = "SELECT DISTINCT ps.nama, ps.jenis_kelas, ps.nama_fakultas, pp.kuota, pp.jumlah_pelamar, pp.jumlah_diterima
		FROM penerimaan_prodi pp, program_studi ps 
		WHERE pp.nomor_periode='" . $_SESSION["nomor_j"] . "' 
		AND ps.jenjang='" . $_SESSION["jenjang_j"] . "' 
		AND pp.kode_prodi = ps.kode
		AND pp.tahun_periode='". $_SESSION["tahunperiode_j"] ."'
		ORDER BY ps.jenis_kelas DESC
		LIMIT $limit OFFSET ($counter * $limit);";
		$result = pg_query($query);
		while ($row = pg_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>{$row['nama']}</td>";
			echo "<td>{$row['jenis_kelas']}</td>";
			echo "<td>{$row['nama_fakultas']}</td>";
			echo "<td>{$row['kuota']}</td>";
			echo "<td>{$row['jumlah_pelamar']}</td>";
			echo "<td>{$row['jumlah_diterima']}</td>";
			echo "</tr>";
		}
	?>	
	</tbody>
	</table>
	</div>
	</div>
	</body>
</html> 