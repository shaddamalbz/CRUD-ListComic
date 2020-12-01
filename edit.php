<?php
  include './connection.php';
  $table_name = 'comic';

  // menyimpan data yang diinputkan kedalam variabel
  $id = $_POST['id'];
  $judul = $_POST['judul'];
  $pengarang = $_POST['pengarang'];
  $studio = $_POST['studio'];
  $genre = $_POST['genre'];

  // query sql untuk insert data
  $query = "UPDATE comic SET  judul = '$judul', pengarang='$pengarang', studio ='$studio', genre ='$genre' WHERE id = '$id' ";
  $result = mysqli_query($connection, $query);

  if(!$result){
    die('ERROR : gagal mengedit comic : '.mysqli_error($connection));
  }
  echo("<script>alert('Comic Berhasil diedit \n!');</script>");
  header('refresh: 0; url= dashboard.php');
?>