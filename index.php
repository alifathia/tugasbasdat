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

function login(){
    $connection = connectDB();

    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];

    $sql = "SELECT * FROM akun";
    $result = pg_query($sql);

    if(pg_num_rows($result) > 0){
        //check output of each row
        while($row = pg_fetch_assoc($result)){
            if($row['username'] == $login_username && $row['password'] == $login_password){
                $_SESSION['username'] = $row['username'];
                if($row['role'] == t){
                    $_SESSION['role'] = "admin";
                    header("Location: ./pages/landing_admin.php");
                }
                else{
                    $_SESSION['role'] = "pelamar";
                    header("Location: ./pages/landing_pelamar.php");
                }
                break;
            }
            else if($row['username'] == $login_username && $row['password'] != $login_password){
                $message = "wrong password!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        pg_close();
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['command'] === 'login'){
        login();
    }
    if($_POST['command'] === 'register'){
        //register();
    }
}
?>

<!DOCTYPE html>
  <html>
    <head>
    <title>SIRIMA</title>
      <!-- Bootstrap scripts -->
      <link rel="stylesheet" href="./bootstrap-3.3.7/css/bootstrap.min.css">
      <script src="./bootstrap-3.3.7/js/jquery.min.js"></script>
      <script src="./bootstrap-3.3.7/js/bootstrap.min.js"></script>
      <script src="./js/modernizr.custom.80028.js"></script>

      <!-- Other scripts -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
      <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <!-- Custom CSS scripts -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/notification.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
      <div class="container">
        <div class="info">
          <h1>SIRIMA</h1>
        </div>
      </div>

      <!-- alerts -->


      <!-- form registrasi jika belum punya akun -->
      <div class="form">
        <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
        <form class="register-form" action="index.php" method="post">
          <span><h2>Registrasi Akun SIRIMA</h2><br></span>
          <br>
          <div class="form-group">
            <span><p>username</p></span>
            <input type="text" class="form-control" id="username" placeholder="username">
          </div>
          <div class="form-group">
            <span><p>password</p></span>
            <input type="password" class="form-control" id="password" placeholder="password">
          </div>
          <div class="form-group">
            <span><p>ulangi password</p></span>
            <input type="password" class="form-control" id="repeatpassword" placeholder="ulangi password">
          </div>
          <div class="form-group">
            <span><p>nama lengkap</p></span>
            <input type="text" class="form-control" id="fullname" placeholder="nama lengkap">
          </div>
          <div class="form-group">
            <span><p>nomor identitas</p></span>
            <input type="text" class="form-control" id="idnumber" placeholder="no. identitas">
          </div>
          <div class="form-group">
            <span><p>jenis kelamin</p></span>
            <select class="form-control" id="jeniskelamin">
              <option value="L">laki-laki</option>
              <option value="P">perempuan</option>
            </select>
          </div>

          <!-- date picker -->
            <div class="form-group">
              <span><p>tanggal lahir</p></span>
              <input class="form-control" id="date" name="date" placeholder="tanggal lahir: MM/DD/YYY" type="date"/>
            </div>

          <div class="form-group">
            <option selected>alamat</option> 
            <textarea class="form-control" id="address" rows="2" placeholder="alamat"></textarea>
          </div>
          <div class="form-group">
            <option selected>alamat e-mail</option>
            <input class="form-control" name="email" type="text" placeholder="alamat e-mail"/>
          </div>
          <div class="form-group">
            <option selected>ulangi alamat e-mail</option>
            <input class="form-control" name="repeatemail" type="text" placeholder="ulangi e-mail"/>
          </div>
          <button type="submit">create account</button>
          <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>

        <!-- form login jika sudah punya akun -->
        <form class="login-form" action="index.php" method="post">
          <span>Login Akun SIRIMA<br></span><br>
          <input name="login_username" type="text" placeholder="username"/>
          <input name="login_password" type="password" placeholder="password"/>
          
          <!-- hidden input -->
          <input type="hidden" id="login-command" name="command" value="login">
          <button type="submit">login</button>
          <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>   
      </div>

      <video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
        <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
      </video>

      <!-- JQuery Script -->
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="js/index.js"></script>
      <script>
        close = document.getElementById("close");
           close.addEventListener('click', function() {
             note = document.getElementById("note");
             note.style.display = 'none';
           }, false);
      </script>
    </body>
  </html>