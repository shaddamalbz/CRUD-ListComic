<?php
  include './connection.php';
  $table_name = 'comic';
  
  if(isset($_GET['search'])){
    $key = $_GET['search'];
    $query = "SELECT * FROM $table_name WHERE judul = '$key'";
    $result = mysqli_query($connection, $query);				
	}else{
    $query = "SELECT * FROM $table_name";
		$result = mysqli_query($connection, $query);	
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MANGA LIBRARY</title>
  <!-- CDN Bootstrap v5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <!-- As a heading -->
  <nav class="navbar navbar-light bg-white container">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h1">MANGA LIBRARY</span>
    </div>
  </nav>
  <div class="container">
      <form class="d-flex mt-3 mb-3" action="dashboardUser.php" method="get">
        <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      <!-- Start Table-->
    <table class="table table-striped">
    <?php
      if(!$result){
        die('ERROR : gagal mengambil data tabel : '.mysqli_error($connection));
      }
      echo '
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Pengarang</th>
            <th scope="col">Studio</th>
            <th scope="col">Genre</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
      ';
      while ($row = mysqli_fetch_array($result))
      {
        ?>
        <tr>
          <th scope="row"><?php echo $row['id'] ?></th>
          <td><?php echo $row['judul'] ?></td>
          <td><?php echo $row['pengarang'] ?></td>
          <td><?php echo $row['studio'] ?></td>
          <td><?php echo $row['genre'] ?></td>
        </tr>
      <?php               
      } 
      ?>
      </tbody>
    </table>
    <!-- End Table -->
  </div>
  <footer>
    <p>Created with love by shaddam</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
</body>
</html>