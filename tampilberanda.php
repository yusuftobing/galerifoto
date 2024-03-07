<?php
session_start();
include 'db_conn.php';
// error_reporting(0);
if (isset($_SESSION['status']) != 'login') {
     echo "<script> alert('Anda Belum Login') 
     location.href='blog.php';  
     </script>";
} ?>
<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Home Page</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="Assets/css/akuuuuu.css">
     <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
     <script src="jquery-3.7.1.min.js"></script>
     <script src="fe459689b4.js"></script>
</head>

<body>
     <nav class="navbar navbar-expand-xxl bg-body-tertiary fixed-top">
          <div class="container-fluid">
               <a class="navbar-brand" href="blog.php">

                    <b>Gallery <span style="color :#0088FF; ">Photo</span></b>
               </a>
               <button class="navbar-toggler navbar-expand-xxl" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="index.php">Berandan</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="foto/foto.php">Upload</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link" href="album/album.php">Album</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link " href="login.php">Login | Signup</a>
                         </li>
                    </ul>
                    <form class=" d-flex" role="search">
                         <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                         <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
               </div>
          </div>
     </nav>

     <!-- tampilfoto -->
     <div class="container" style="display: flex; align-items: center; justify-content:center; margin-top:60px;  ">
          <div class="card rounded-5" style="max-width:800px;">
               <div class="row g-0">
                    <?php
                    $fotoid = $_GET['fotoid'];
                    $stmt = $conn->prepare("SELECT * FROM foto WHERE fotoid='$fotoid'");
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    foreach ($users as $row) {
                         ?>
                         <div class="col-md-4">
                              <img src="Assets/img/<?= $row['lokasifile'] ?>" class=" img-fluid rounded-start-5"
                                   title="<?= $row['judulfoto'] ?>" style="width:620px;">
                         </div>
                         <div class="col-md-8">
                              <div class="card-body col-12">
                                   <div class="d-flex justify-content-between ">

                                        <a class="btn btn-primary" href="Assets/img/<?= $row['lokasifile'] ?>"
                                             download="hayoloo" role="button"><i class="bi bi-download"></i></a>

                                        <div class="like">
                                             <?php
                                             // $fotoid = $_POST['fotoid'];
                                             $stmt = $conn->prepare("SELECT * FROM likefoto ");
                                             $stmt->execute();
                                             $users = $stmt->fetchAll();
                                             foreach ($users as $row) {
                                                  ?>
                                                  <a href="#" style="text-decoration:none; color:black;"><i class="bi bi-heart"
                                                            class="bi bi-heart " style="font-size:25px;"></i></a>

                                                  <a href="#" style="text-decoration:none; color:black;"><i
                                                            class="bi bi-heartbreak" style="font-size:25px;"></i></a>
                                             <?php } ?>


                                        </div>

                                   </div>
                                   <h3 class="card-text p-5">
                                        <?= $row['judulfoto'] ?>
                                   </h3>
                                   <h5 class="card-text"><small class="text-body-secondary">Komentar :</small>
                                   </h5>
                              </div>
                         </div>
                    <?php } ?>

               </div>
          </div>
     </div>
     <!-- end -->

     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>