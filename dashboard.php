<?php
  include './connection.php';
  $table_name = 'comic';
  
  if(isset($_GET['search'])){
    $key = $_GET['search'];
    $query = "SELECT * FROM $table_name WHERE judul = '$key'";
    $result = mysqli_query($connection, $query);				
  } else{
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
    <form class="d-flex mt-3" action="dashboard.php" method="get">
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
          <td class="row-button">
            <button type="button" class="btn btn-danger">
              <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </button>
            <!-- Button Modal Edit/Update-->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editComicModal<?php echo $row['id']; ?>">
              <a href="#">Edit</a>
            </button>
          </td>
        </tr>
        <!-- Edit Comic Modal -->
        <div class="modal fade" id="editComicModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORM EDIT COMIC</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="edit.php" method="POST">
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                  <div class="mb-3">
                    <label for="editJudul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="editJudul" aria-describedby="emailHelp" name="judul" value="<?php echo $row['judul']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="editPengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="editPengarang" name="pengarang" value="<?php echo $row['pengarang']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="editStudio" class="form-label">Studio</label>
                    <input type="text" class="form-control" id="editStudio" name="studio" value="<?php echo $row['studio']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="editGenre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="editGenre" name="genre" value="<?php echo $row['genre']; ?>">
                  </div>
                  <button type="submit" class="btn btn-success">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Edit Comic Modal -->
      <?php               
      } 
      ?>
      </tbody>
    </table>
    <!-- End Table -->
    <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#addComicModal">Add New Comic</button>
    <!-- Form Add Comic Modal -->
    <div class="modal fade" id="addComicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">FORM COMIC</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="add.php" method="POST">
              <div class="mb-3">
                <label for="addJudul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="addJudul" aria-describedby="emailHelp" name="judul" value>
              </div>
              <div class="mb-3">
                <label for="addPengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="addPengarang" name="pengarang">
              </div>
              <div class="mb-3">
                <label for="addStudio" class="form-label">Studio</label>
                <input type="text" class="form-control" id="addStudio" name="studio">
              </div>
              <div class="mb-3">
                <label for="addGenre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="addGenre" name="genre">
              </div>
              <button type="submit" class="btn btn-success">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Form Comic Modal -->
  </div>
  <footer>
    <p>Created with love by shaddam</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous"></script>
</body>
</html>