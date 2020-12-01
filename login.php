<?php
  include './connection.php';
  $table_name = 'user';

  session_start();
  // menyimpan data yang diinputkan kedalam variabel
  $email = $_POST['email'];
  $password = md5($_POST['pwd']);

  // query sql untuk autentifikasi
  $query = "SELECT `email`, `password`, `privilege` FROM `user` where email='$email' AND password='$password';";
  $result = mysqli_query($connection, $query);

  if(mysqli_num_rows($result))
	{
    if($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
      $_SESSION['email']=$row['email'];
      $_SESSION['password']=$row['password'];
      if($row['privilege'] == 'user'){
        echo ("Successfull Login as User <br>");
        echo ('You will be redirected in about 3 secs to Dashboard. If not, click <a href="dashboardUser.php">here</a>.');
        header('refresh: 3; url= dashboardUser.php');
      } else {
        echo ("Successfull Login as Admin <br>");
        echo ('You will be redirected in about 3 secs to Dashboard. If not, click <a href="dashboard.php">here</a>.');
        header('refresh: 3; url= dashboard.php');
      }
    } 
	}
	else{
    echo("<script>alert('Invalid Username or Password. Try Again!');</script>");
    header('refresh: 0; url= index.html');
  }
?>