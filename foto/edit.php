<?php
include '../db_conn.php';
session_start();
if ($_SESSION['status'] != 'login') {
     echo "<script> alert('Anda Belum Login') 
     location.href='../index.php';
     </script>";
} ?>

<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Home Page</title>
     <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
     <!-- <link rel="stylesheet" href="Assets/css/style.css"> -->
</head>

<body>
     <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
               <a class="navbar-brand" href="../blog.php">
                    <b>Gallery <span style="color :#0088FF; ">Photo</span></b>
               </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="foto.php">Foto</a>
                         </li>
                    </ul>
                    <!-- <a class="btn btn-primary" href="../logout.php" type="button">Keluar</a> -->
               </div>
          </div>
     </nav>

     <!-- start -->
     <div class="container" style="margin-top: 15px;">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">
                    <a href="foto.php">Home</a>
               </li>
               <li class="breadcrumb-item active">Foto</li>
          </ol>

          <h3>Edit Foto</h3>
          <hr />
          <div class="row">
               <section class="col-md-12">
                    <?php
                    if (isset ($_SESSION['Message'])): ?>
                         <?php ?>
                         <h5 class="alert alert-success">
                              <?= $_SESSION['Message']; ?>
                         </h5>
                         <?php
                         unset($_SESSION['Message']);
                    endif; ?>

                    <form action="../php/foto.php" method="post" enctype="multipart/form-data">
                         <?php error_reporting(0); ?>
                         <input type="hidden" name="fotoid" value="<?= $_GET['Fotoid'] ?>">
                         <div class="form-group">
                              <label>Judul Foto : </label>
                              <input class="form-control" type="text" name="judulfoto" placeholder="Masukan Nama Album"
                                   value="<?= $_GET['JudulFoto'] ?>">

                         </div>
                         <br>
                         <div class="form-group">
                              <label>Keterangan : </label>
                              <input class="form-control" type="text" name="deskripsifoto"
                                   placeholder="Masukan keterangan" value="<?= $_GET['DeskripsiFoto'] ?>">

                         </div>
                         <br>
                         <label class="form-label">Foto :</label>
                         <div class="row">
                              <div class="col-md-4">
                                   <img src="../Assets/img/<?= $_GET['LokasiFile'] ?>" width="100">
                              </div>
                              <div class="col-md-8">
                                   <label class="form-label"> Ganti File :</label>
                                   <input type="file" class="form-control" name="lokasifile">
                              </div>
                         </div>

                         <br>

                         <button class="btn btn-primary" type="submit" name="update"> Update</button>
                    </form>
               </section>

          </div>

     </div>
     <!-- end -->
     <script src="../Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>