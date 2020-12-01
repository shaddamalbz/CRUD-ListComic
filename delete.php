<?php
  include './connection.php';
  $table_name = 'comic';

  // menyimpan data yang diinputkan kedalam variabel
  // get id dari url
  $id = $_GET['id'];

  // query sql untuk insert data
  $query = "DELETE FROM $table_name WHERE id='$id'";
  $result = mysqli_query($connection, $query);

  if(!$result){
    die('ERROR : gagal menghapus comic : '.mysqli_error($connection));
  }
  echo("<script>alert('Data berhasil dihapus');</script>");
  header('refresh: 0; url= dashboard.php');
?>