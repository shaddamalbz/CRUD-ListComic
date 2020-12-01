<?php
  include './connection.php';
  $table_name = 'user';

  // menyimpan data yang diinputkan kedalam variabel
  $username = $_POST['name'];
  $email = $_POST['email'];
  $password = md5($_POST['pwd']);

  // query sql untuk insert data
  $query = "INSERT INTO $table_name SET username = '$username', email = '$email', password = '$password', privilege = 'user' ;";
  $result = mysqli_query($connection, $query);

  if(!$result){
    die('ERROR : gagal register : '.mysqli_error($connection));
  }
  echo ("Berhasil Register \n");
  echo ('You will be redirected in about 10 secs to homepage. If not, click <a href="index.html">here</a>.');
  header('refresh: 10; url= index.html');
?>