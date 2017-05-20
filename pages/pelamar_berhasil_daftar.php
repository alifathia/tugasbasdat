<?php
	session_start();
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
		//$row = pg_fetch_assoc($result);
		//while ($row){
		//echo "<option value=\"owner1\">" . $row['username'] . "</option>";
		//}
		?>

		<div class="container-fluid" id="berhasil" style="width:500px;height:190px;">
			<h2 class="text-center">Pendaftaran Sukses</h2>
		</div>
		
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<p class="text-center">Selamat pembayaran berhasil dilakukan!</p>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="id_pd">Id Pendaftaran	: <?php
								$query_id = "SELECT * FROM PENDAFTARAN WHERE id = (SELECT MAX(id) FROM PENDAFTARAN)";
								$result_id = pg_query($query_id);
								$row_id = pg_fetch_assoc($result_id);
								//$id_pendaftaran
								$id_pendaftaran = $row_id['id'];
								echo "$id_pendaftaran";
							?></label>
						</div>
						<div class="form-group">
							<label for="id_pd">Id Pembayaran	: <?php
								$query_id = "SELECT * FROM PEMBAYARAN WHERE id = (SELECT MAX(id) FROM PENDAFTARAN)";
								$result_id = pg_query($query_id);
								$row_id = pg_fetch_assoc($result_id);
								$id_pembayaran = $row_id['id'];
								echo "$id_pembayaran";
							?></label>
						</div>
						<div class="form-group">
							<label for="id_pd">Nomor Kartu Ujian	: <?php
								$query_id = "SELECT * FROM PENDAFTARAN_SEMAS WHERE id = (SELECT MAX(id) FROM PENDAFTARAN)";
								$result_id = pg_query($query_id);
								$row_id = pg_fetch_assoc($result_id);
								$no_kartu = $row_id['no_kartu_ujian'];
								echo "$no_kartu";
							?></label>
						</div>
					</form>
				</div>
			</div>
		</div>


		<!-- More Script -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>