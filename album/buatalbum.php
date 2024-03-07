<?php
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
               <a class="navbar-brand" href="index.php">
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
                              <a class="nav-link active" aria-current="page" href="album.php">Album</a>
                         </li>
                    </ul>
               </div>
          </div>
     </nav>

     <!-- start -->
     <div class="container" style="margin-top: 15px;">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">
                    <a href="album.php">Home</a>
               </li>
               <li class="breadcrumb-item active">Album</li>
          </ol>

          <h3>Buat Album</h3>
          <hr />
          <div class="row">
               <section class="col-md-12">
                    <?php
                    if (isset($_SESSION['Message'])): ?>
                    <?php ?>
                    <h5 class="alert alert-success">
                         <?= $_SESSION['Message']; ?>
                    </h5>
                    <?php
                         unset($_SESSION['Message']);
                    endif; ?>
                    <form action="../php/album.php" method="post" enctype="multipart/form-data">
                         <div class="form-group">
                              <label>Nama Album : </label>
                              <input class="form-control" type="text" name="namaalbum" placeholder="Masukan nama album">

                         </div>
                         <br>
                         <div class="form-group">
                              <label>Keterangan : </label>
                              <input class="form-control" type="text" name="deskripsi" placeholder="Masukan keterangan">

                         </div>
                         <br>

                         <button class="btn btn-primary" type="submit" name="simpan"> Simpan</button>
                    </form>
               </section>

          </div>

     </div>
     <!-- end -->
     <script src="../Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>