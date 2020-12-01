<?php
  include './connection.php';
  $table_name = 'comic';

  // menyimpan data yang diinputkan kedalam variabel
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $studio = $_POST['studio'];
  $genre = $_POST['genre'];

  // query sql untuk insert data
  $query = "INSERT INTO $table_name SET judul = '$judul', pengarang = '$pengarang', studio = '$studio', genre = '$genre';";
  $result = mysqli_query($connection, $query);

  if(!$result){
    die('ERROR : gagal menambahkan comic : '.mysqli_error($connection));
  }
  echo("<script>alert('Comic Berhasil ditambahkan \n!');</script>");
  header('refresh: 0; url= dashboard.php');
?>