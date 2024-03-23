<?php
include 'db_conn.php';
?>

<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Home Page</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="Assets/css/akuuuuu.css">
     <link rel="stylesheet" href="css/fitur.css">
     <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
</head>

<body>
     <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
          <div class="container-fluid fitur">
               <a class="navbar-brand" href="index.php">

                    <b>Gallery <span style="color :#0088FF; ">Photo</span></b>
               </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 satu">
                         <li class="nav-item dua">
                              <a class="nav-link active" aria-current="page" href="dasboard.php">Dashboard</a>
                         </li>
                         <li class="nav-item dua">
                              <a class="nav-link" href="foto/foto.php">Upload</a>
                         </li>
                         <li class="nav-item dua">
                              <a class="nav-link" href="album/album.php">Album</a>
                         </li>
                         <li class="nav-item dua">
                              <a class="nav-link " href="login.php">Login | Register</a>
                         </li>
                         <li class="nav-item dua">
                              <a class="nav-link " href="logout.php">Logout</a>
                         </li>
                    </ul>
                    <div class="nav-item d-flex tiga">
                         <a class="nav-link" href="editprofil.php" style="font-size:30px;"><i
                                   class="bi bi-person-circle"></i>
                         </a>
                    </div>
               </div>
          </div>
     </nav>

     <div class="main" style="margin-top:70px;">
          <div class="gallery">
               <?php
               $stmt = $conn->prepare("SELECT * FROM foto INNER JOIN user ON foto.userid = user.userid  ORDER BY foto.userid ASC");
               $stmt->execute();
               $users = $stmt->fetchAll();
               foreach ($users as $row) {
                    unset($_GET['image']);
                    $url = http_build_query($_GET);
                    ?>
                    <div class="img">
                         <a href="tampilberanda.php?fotoid=<?= $row['fotoid']; ?>">
                              <img src="Assets/img/<?= $row['lokasifile'] ?>" title="<?= $row['judulfoto'] ?>"
                                   style="width:300px">
                         </a>
                         <div class="yee">
                              <a href="tampilberanda.php?fotoid=<?= $row['fotoid']; ?>">
                                   <?= $row['judulfoto'] ?>
                              </a>
                              <div class="username">
                                   <a href="tampilberanda.php?fotoid=<?= $row['fotoid']; ?>">
                                        <img src=" image_profil/<?= $row['image'] ?>" class=" rounded-circle"
                                             style="width:30px;">
                                        <?= $row['username'] ?>
                                   </a>
                              </div>
                         </div>
                    </div>


               <?php } ?>
          </div>
     </div>


     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>