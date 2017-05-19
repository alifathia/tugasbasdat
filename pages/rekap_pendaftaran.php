<!DOCTYPE html>
<html>
	<head>
		<title>SIRIMA</title>
		<link rel="stylesheet" type="text/css" href="css/drpdwn.css">
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
    
	unset($_SESSION["current_page_jenjang"]);
	unset($_SESSION["jenjang_j"]);
	unset($_SESSION["nomor_j"]);
	unset($_SESSION["periode_j"]);
	
	if($_SESSION['role'] != "admin"){
		//$message = "Sorry, you're not an admin!";
		//echo "<script type='text/javascript'>alert('$message');</script>";
        /*echo "<script>alert('$messages');
		window.location.href='./landing_pelamar.php'
		</script>";
		*/
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
	<h2 class="text-center">Form Pemilihan Jenjang</h2>
	<p class="text-center">Silahkan pilih periode dan jenjang yang ingin anda lihat.</p>
	</div>
	
	<p></p>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
					<form method="post" action="jenjang.php">
							<div class="form-group">
							Periode: 
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
							<div class="form-group">
							Jenjang: 
								<select class="form-control" name="jenjang_select" id="jenjang_select">
									<?php
									$query2 = "select * from jenjang";
									$result2 = pg_query($query2);
									
									while ($row = pg_fetch_assoc($result2)){
									echo "<option name='". htmlspecialchars($row['nama']) ."'>" . htmlspecialchars($row['nama']) . "</option>";
									}
									?>
								</select>
							</div>
					
						<p></p>
						<input class="btn btn-default" type="submit" name="submit" value="Submit">
					</form>
				
			</div>
		</div>
	</div>
	
	</body>
</html> 