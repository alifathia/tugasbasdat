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

		<div class="container-fluid" id="pilih_jenjang" style="width:500px;height:190px;">
			<h2 class="text-center">Pilih Jenjang</h2>
		</div>
		
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="jenjang">Jenjang</label>
							<!--<div class="form-group">
				              <select class="form-control" id="jenjang" >
				                <option value="S1">S1 (Sarjana)</option>
				                <option value="S2">S2 (Pascasarjana)</option>
				                <option value="S3">S3 (Pascasarjana)</option>
				              </select>
				            </div>
						</div>-->
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Pilih Jenjang<span class="caret"></span></button>
							<ul class="dropdown-menu">
							  <li class="dropdown-header">Sarjana</li>
							  <li><a href="pelamar_daftar_semas_sarjana.php">S1</a></li>
							  <li class="divider"></li>
							  <li class="dropdown-header">Pasca Sarjana</li>
							  <li class="disabled"><a href="#">S2</a></li>
							  <li class="disabled"><a href="#">S3</a></li>
							</ul>
						</div>
						<!--<input type="hidden" id="insert-command" name="command" value="insert">
						<button type="button" class="btn btn-primary">Simpan</button>-->
					</form>
				</div>
			</div>
		</div>


		<!-- More Script -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>