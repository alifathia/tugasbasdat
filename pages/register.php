<?php
// function register(){
//   $username = $_POST['username'];
//   $password = $_POST['password'];
//   $repeatpassword = $_POST['repeatpassword'];
//   $fullname = $_POST['fullname'];
//   $idnumber = $_POST['idnumber'];
//   $gender = $_POST['gender'];
//   $date = $_POST['date'];
//   $address = $_POST['address'];
//   $email = $_POST['email'];
//   $repeatemail = $_POST['repeatemail'];

?>

<html>
	<head>
		<meta charset="UTF-8">

		 <!-- Bootstrap scripts -->
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<title>Register</title>
	</head>

	<body>
		<style>
			@import url('https://fonts.google.com/specimen/Roboto');

			body{
				font-family: Lato;

			}
			.alert{
				color: red;
				display: inline;
			}
			.form-labels-on-top{
			    box-sizing: border-box;
			    max-width: 700px;
			    margin: 0 auto;
			    padding: 55px;

			    background-color:  #ffffff;
			    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
			}
			.button-container{
				text-align: center;
			}
			.message{
				text-align: center;
			}
		</style>

		<div class="container">
			<form class="form-labels-on-top" action="register.php" method="post">
				<div class="form">
			        <span><h2 id="header">Registrasi Akun SIRIMA</h2><br></span>
			        <br>
			        <div class="form-group">
				        <label for="username">Username </label><span><p id="alert-username" class="alert"></p></span>
				        <input type="text" class="form-control" id="username" placeholder="username" >
				        <span class="help-block">Username hanya boleh berisi huruf, angka dan tanda titik (.)</span>
				  
			        </div>
			        <div class="form-group">
			        	<label for="password">Password</label >
			        	<input type="password" class="form-control" id="password" placeholder="password">
			        	<span class="help-block">Password minimal terdiri dari 6 karakter dan bersifat case sensitive</span>
			        </div>
			        <div class="form-group">
			          <label for="repeatpassword">Ulangi Password</label >
			          <input type="password" class="form-control" id="repeatpassword" placeholder="ulangi password">
			        	
			        </div>
			        <div class="form-group">
			          <label for="fullname">Nama Lengkap</label >
			          <input type="text" class="form-control" id="fullname" placeholder="nama lengkap">
			        </div>
			        <div class="form-group">
			         	<label for="idnumber">Nomor Identitas</label >
			         	<input type="text" class="form-control" id="idnumber" placeholder="no. identitas">
			        	<span class="help-block">Nomor identitas hanya boleh berisi 16 digit angka</span>
			        </div>
			        <div class="form-group">
			          <label for="gender">Jenis Kelamin</label >
			          <select class="form-control" id="gender">
			            <option value="L">laki-laki</option>
			            <option value="P">perempuan</option>
			          </select>
			        </div>
			        <!-- date picker -->
			        <div class="form-group">
			            <label for="date">Tanggal Lahir</label >
			            <input class="form-control" id="date" name="date" placeholder="tanggal lahir: MM/DD/YYY" type="date"/>
			        </div>
			        <div class="form-group">
			          <label for="address">Alamat</label >
			          <textarea class="form-control" id="address" rows="2" placeholder="alamat"></textarea>
			        </div>
			        <div class="form-group">
			          <label for="email">E-mail</label >
			          <input class="form-control" name="email" type="text" placeholder="alamat e-mail"/>
			        </div>
			        <div class="form-group">
			          <label for="repeatemail">Ulangi E-mail</label >
			          <input class="form-control" name="repeatemail" type="text" placeholder="ulangi e-mail"/>
			        </div>
			        <input type="hidden" id="register-command" name="command" value="register">
			        <div class="button-container">
			        	<button class="btn btn-danger"  onclick="validate()">create account</button>
			        </div>
			        <br><p class="message">Already registered? <a href="./index.php">Sign In</a></p>
			</form>
		</div>

		<!-- More Scripts -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

		<script>
		function validate(){
			var flag = true;
			var check_username = document.getElementById("username").value;
			var messages ="";

			if(!/^[a-zA-Z0-9]$/.test(check_username)){ //innerhtml gabisa
				document.getElementById("alert-username").innerHTML = "Format username tidak sesuai";
				document.getElementById("header").innerHTML = "Format username tidak sesuai";
				flag = false;
				messages += "+1 \n";
				messages += "+2";
				// alert("format uname salah");
				// alert(check_username);
			}

			document.getElementById("header").innerHTML = "Format username tidak sesuai";

			if(!flag){
				alert(messages);
			}
		}
		</script>

	</body>
</html>