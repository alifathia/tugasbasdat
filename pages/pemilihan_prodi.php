<!DOCTYPE html>
<html>
	<head>
		<title>SIRIMA</title>
		<link rel="stylesheet" type="text/css" href="../css/drpdwn.css">
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
	$connection = pg_connect ("host=localhost dbname=sirima user=postgres password=postgres");
	
    unset($_SESSION["pemilihan_prodi"]);
	unset($_SESSION["nomor"]);
	unset($_SESSION["tahun"]);
	unset($_SESSION["jenjang"]);
	unset($_SESSION["jenis_kelas"]);
	unset($_SESSION["jurusan"]);
	unset($_SESSION["current_page_pelamar_diterima"]);
	
	if($_SESSION['role'] != "admin"){
		//echo $_SESSION['role'];
		//$message = "Sorry, you're not an admin.";
        //echo "<script type='text/javascript'>alert('$message');</script>";
		header("Location: ./landing_pelamar.php");
    }
	
	/*
	if($connection) {
    echo 'connected';
    } else {
    echo 'there has been an error connecting';
    } 
	*/
	
	$query = "SET search_path to SIRIMA";
	$result = pg_query($query);
	//$row = pg_fetch_assoc($result);
	//while ($row){
	//echo "<option value=\"owner1\">" . $row['username'] . "</option>";
	//}
	?>
	<div class="container-fluid">
	<h1>Form Pemilihan Prodi</h1>
	<p>Silahkan pilih periode dan prodi yang ingin anda lihat.</p>
	
	<p></p>
	<div class="row">
		<div class="col-xs-6 col-sm-3">
		<form method="post" action="pelamar_diterima.php">
			<div class="div-inline">Periode: 
			<select class="form-control" name="periode_select" id="periode_select">
				<?php
				$query = "select * from periode_penerimaan";
				$result = pg_query($query);
				
				while ($row = pg_fetch_assoc($result)){
				echo "<option name='". htmlspecialchars($row['nomor']) ."'>" . htmlspecialchars($row['nomor']) . " - " . htmlspecialchars($row['tahun']) . "</option>";
				}
				?>
			</select>
			</div>
			<p></p>
			<div class="div-inline">Prodi: 
			<select class="form-control" name="prodi_select" id="prodi_select">
				<?php
				$query2 = "select * from program_studi";
				$result2 = pg_query($query2);
				
				while ($row = pg_fetch_assoc($result2)){
				echo "<option name='". htmlspecialchars($row['jenjang']) ."'>" . htmlspecialchars($row['jenjang']) . " " . htmlspecialchars($row['nama']) . " " . htmlspecialchars($row['jenis_kelas']) ."</option>";
				}
				?>
			</select>
			</div>
			<p></p>
			<input class="btn btn-default" type="submit" name="submit" value="Submit">
		</form>
		</div>
	</div>
	</body>
</html> 