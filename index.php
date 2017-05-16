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
	
  	$query1 = "SET search_path to SIRIMA";
  	$result1 = pg_query($query1);

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
}
?>

<!DOCTYPE html>
  <html>
    <head>
    <title>SIRIMA</title>
      <!-- Bootstrap scripts -->
      <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
      <script src="bootstrap-3.3.7/js/jquery.min.js"></script>
      <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
      
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

      <div class="form">
        <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
 
        <form class="login-form" action="index.php" method="post">
          <span>Login Akun SIRIMA<br></span><br>
          <input name="login_username" type="text" placeholder="username"/>
          <input name="login_password" type="password" placeholder="password"/>
          
          <!-- hidden input -->
          <input type="hidden" id="login-command" name="command" value="login">
          <button type="submit">login</button>
          <p class="message">Not registered? <a href="pages/register.php">Create an account</a></p>
        </form>   
      </div>

      <!-- JQuery Script -->
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="js/index.js"></script>
    </body>
  </html>