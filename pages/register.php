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

function register(){
	$connection = connectDB();

	$sql = "SET search_path to SIRIMA";
  	$path = pg_query($sql);

	$username = $_POST['username'];
	$password = $_POST['password'];
	$repeatpassword = $_POST['repeatpassword'];
	$fullname = $_POST['fullname'];
	$idnumber = $_POST['idnumber'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$repeatemail = $_POST['repeatemail'];

	//check if there is username duplicate
	$check_duplicate = "SELECT username FROM AKUN WHERE username = '$username' ";
	$result = pg_query($check_duplicate);

	//if new username doesn't exists
	if(pg_num_rows($result) == 0){
		$insert_pelamar = "INSERT INTO PELAMAR (username, nama_lengkap, alamat, jenis_kelamin, tanggal_lahir, no_ktp, email) VALUES ('$username','$fullname','$address','$gender','$birthdate','$idnumber','$email')";
		$insert_akun = "INSERT INTO AKUN (username, role, password) VALUES ('$username', FALSE, '$password')";

		$insert1 = pg_query($insert_akun);
		$insert2 = pg_query($insert_pelamar);

		$_SESSION["username"] = $username;
		$_SESSION["newuser"] = true;
		$_SESSION["role"] = "pelamar";
		header("Location: landing_pelamar.php");
	}

	else{
		$message = "Username already exists in database!";
        echo "<script type='text/javascript'>alert('$message');</script>";	
	}
 }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['command'] === 'register'){
        register();
    }
}

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
			    max-width: 550px;
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
			<form class="form-labels-on-top" action="register.php" method="post" onsubmit="return validate()" enctype="multipart/form-data">
				<div class="form">
			        <span><h2 id="header">Registrasi Akun SIRIMA</h2><br></span>
			        <br>
			        <div class="form-group">
				        <label for="username">Username </label><span><p id="alert-username" class="alert"></p></span>
				        <input type="text" class="form-control" name="username" id="username" placeholder="username" >
				        <span class="help-block">Username hanya boleh berisi huruf, angka dan tanda titik (.)</span>
				  
			        </div>
			        <div class="form-group">
			        	<label for="password">Password</label >
			        	<input type="password" class="form-control" name="password" id="password" placeholder="password">
			        	<span class="help-block">Password minimal terdiri dari 6 karakter dan bersifat case sensitive</span>
			        </div>
			        <div class="form-group">
			          <label for="repeatpassword">Ulangi Password</label >
			          <input type="password" class="form-control" name="repeatpassword" id="repeatpassword" placeholder="ulangi password">
			          <span class="help-block">Masukkan kembali password</span>
			        </div>
			        <div class="form-group">
			          <label for="fullname">Nama Lengkap</label >
			          <input type="text" class="form-control" name="fullname" id="fullname" placeholder="nama lengkap">
			        </div>
			        <div class="form-group">
			         	<label for="idnumber">Nomor Identitas</label >
			         	<input type="text" class="form-control" name="idnumber" id="idnumber" placeholder="no. identitas">
			        	<span class="help-block">Nomor identitas hanya boleh berisi 16 digit angka</span>
			        </div>
			        <div class="form-group">
			          <label for="gender">Jenis Kelamin</label >
			          <select class="form-control" name="gender" id="gender">
			          	<option value="option">Pilih Jenis Kelamin</option>
			            <option value="L">laki-laki</option>
			            <option value="P">perempuan</option>
			          </select>
			        </div>
			        <!-- date picker -->
			        <div class="form-group">
			            <label for="birthdate">Tanggal Lahir</label >
			            <input class="form-control" id="birthdate" name="birthdate" placeholder="tanggal lahir: MM/DD/YYY" type="date"/>
			        </div>
			        <div class="form-group">
			          <label for="address">Alamat</label >
			          <textarea class="form-control" name="address" id="address" rows="2" placeholder="alamat"></textarea>
			        </div>
			        <div class="form-group">
			          <label for="email">E-mail</label >
			          <input class="form-control" name="email" id="email" type="text" placeholder="alamat e-mail"/>
			          <span class="help-block">Contoh: abc@xyz.com</span>
			        </div>
			        <div class="form-group">
			          <label for="repeatemail">Ulangi E-mail</label >
			          <input class="form-control" name="repeatemail" id="repeatemail" type="text" placeholder="ulangi e-mail"/>
			          <span class="help-block">Masukkan kembali alamat e-mail</span>
			        </div>
			        <input type="hidden" id="register-command" name="command" value="register">
			        <div class="button-container">
			        	<button type="submit" class="btn btn-danger">create account</button>			        
			        </div>
			        <br><p class="message">Already registered? <a href="../index.php">Sign In</a></p>
			</form>
		</div>

		<!-- More Scripts -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

		<script>
		function validate(){
			var flag = true;
			var messages ="";
			var check_username = document.getElementById("username").value;
			var check_password = document.getElementById("password").value;
			var check_repeatpass = document.getElementById("repeatpassword").value;
			var check_idnumber = document.getElementById("idnumber").value;
			var check_fullname = document.getElementById("fullname").value;
			var check_gender = document.getElementById("gender").value;
			var check_birthdate = document.getElementById("birthdate").value;
			var check_address = document.getElementById("address").value;
			var check_email = document.getElementById("email").value;
			var check_repeatemail = document.getElementById("repeatemail").value;
			var regex_username = /^[a-zA-Z0-9.]{1,20}$/;
			var regex_idnumber = /^[0-9]{16}$/;
			var regex_email = /\S+@\S+\.\S+/;

			//jika kolom tidak diisi
			if(check_username.length == 0){
				flag = false;
				messages += "Harap isi kolom Username \n";
			}

			if(check_password.length == 0){
				flag = false;
				messages += "Harap isi kolom Password \n";
			}

			if(check_repeatpass.length == 0){
				flag = false;
				messages += "Harap isi kolom Ulangi Password \n";
			}

			if(check_fullname.length == 0){
				flag = false;
				messages += "Harap isi kolom Nama Lengkap \n";
			}

			if(check_idnumber.length == 0){
				flag = false;
				messages += "Harap isi kolom Nomor Identitas \n";
			}

			if(check_address.length == 0){
				flag = false;
				messages += "Harap isi kolom Alamat \n";
			}

			if(check_email.length == 0){
				flag = false;
				messages += "Harap isi kolom Alamat E-mail \n";
			}

			if(check_repeatemail.length == 0){
				flag = false;
				messages += "Harap isi kolom Ulangi Alamat E-mail \n";
			}

			// if(check_gender =! "P" || check_gender =! "P"){
			// 	flag = false;
			// 	messages += "Jenis kelamin harus diisi \n";
			// }

			// if(check_birthdate == "option"){
			// 	flag = false;
			// 	messages += "Tanggal lahir harus diisi \n";
			// }

			//jika format salah
			if(!regex_username.test(check_username) && check_username.length > 0){ 
				flag = false;
				messages += "\nFormat username tidak sesuai";
			}

			if(check_password.length < 6 && check_password.length > 0){
				flag = false;
				messages += "\nPassword harus lebih dari 6 karakter";
			}

			if(check_password != check_repeatpass){
				flag = false;
				messages += "\nPassword tidak sama";
			}

			if(!regex_idnumber.test(check_idnumber) && check_idnumber.length > 0){
				flag = false;
				messages += "\nFormat nomor identitas tidak sesuai";
			}

			if(!regex_email.test(check_email) && check_email.length > 0){
				flag = false;
				messages += "\nFormat e-mail tidak sesuai";
			}

			if(check_email != check_repeatemail){
				flag = false;
				messages += "\nE-mail tidak sama";
			}

			if(!flag){
				alert(messages);
			}

			return flag;
		}
		</script>

	</body>
</html>