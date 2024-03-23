<?php
session_start();
include 'db_conn.php';
if (isset ($_SESSION['status']) != 'login') {
     echo "<script> alert('Anda Belum Login') 
     location.href='index.php';  
     </script>";
} ?>
<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Home Page</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="Assets/css/tampildata.css">
     <link rel="stylesheet" href="css/fitur.css">
     <link rel="stylesheet" href="bootstrap-icons/font/bootstrap-icons.min.css">
     <script src="jquery-3.7.1.min.js"></script>
     <script src="fe459689b4.js"></script>
</head>

<body>
     <nav class="navbar navbar-expand-xxl bg-body-tertiary fixed-top">
          <div class="container-fluid fitur">
               <a class="navbar-brand" href="index.php">

                    <b>Gallery <span style="color :#0088FF; ">Photo</span></b>
               </a>
               <button class="navbar-toggler navbar-expand-xxl" type="button" data-bs-toggle="collapse"
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
                              <a class="nav-link " href="login.php">Login | Signup</a>
                         </li>
                    </ul>
               </div>
          </div>
     </nav>

     <!-- tampilfoto -->
     <div class="container" style="display: flex; align-items: center; justify-content:center; margin-top:60px;  ">
          <div class="card rounded-5" style="max-width:1000px;">
               <div class="row  g-0">
                    <?php
                    $fotoid = $_GET['fotoid'];
                    $stmt = $conn->prepare("SELECT * FROM foto WHERE fotoid='$fotoid'");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                    $users = $stmt->fetchAll();
                    foreach ($users as $row) {
                         if ($stmt->rowCount() == 1) {
                              $getid = $_GET['fotoid'];

                              $like = $conn->prepare('SELECT fotoid FROM likefoto WHERE fotoid = ?');
                              $like->execute(array($getid));
                              $like = $like->rowCount();

                              $dislike = $conn->prepare('SELECT fotoid FROM dislikefoto WHERE fotoid = ?');
                              $dislike->execute(array($getid));
                              $dislike = $dislike->rowCount();
                         }
                         ?>
                         <div class="col p-2 ">
                              <img src="Assets/img/<?= $row['lokasifile'] ?>" class=" img-fluid rounded-5"
                                   title="<?= $row['judulfoto'] ?>" style="width:620px;">
                         </div>
                         <div class="col-md-7 ini">
                              <div class="card-body col-12">
                                   <div class="d-flex justify-content-between ">

                                        <!-- dowload -->
                                        <a class="btn btn-primary mb-5" href="Assets/img/<?= $row['lokasifile'] ?>"
                                             download="GaleriFoto#By_Yusuf" role="button"><i class="bi bi-download"></i></a>
                                        <!-- end -->

                                        <div class="like d-flex">
                                             <a href="php/like.php?t=1&fotoid=<?= $row['fotoid'] ?>"
                                                  style="text-decoration:none; color:black;"><i
                                                       class="bi bi-hand-thumbs-up-fill" style="font-size:25px; "></i>
                                                  <?= $like ?>
                                             </a>

                                             &thinsp;

                                             <a href="php/like.php?t=2&fotoid=<?= $row['fotoid'] ?>"
                                                  style="text-decoration:none; color:black;"><i
                                                       class="bi bi-hand-thumbs-down-fill" style="font-size:25px;"></i>
                                                  <?= $dislike ?>
                                             </a>
                                        </div>


                                   </div>

                                   <h3 class="card-text py-4">
                                        <?= $row['judulfoto'] ?>
                                   </h3>
                                   <p class="card-text ">
                                        <?= $row['deskripsifoto'] ?>
                                   </p>


                                   <div class="mb-3">
                                        <h5 class="card-text">
                                             <small class="">Komentar :</small>
                                        </h5>
                                   </div>

                                   <div class="row" style="max-height: 250px; overflow: auto; margin-bottom:50px;">
                                        <?php
                                        $fotoid = $_GET['fotoid'];
                                        $komentar = "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'";
                                        $stmt = $conn->prepare($komentar);
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        if ($users) {
                                             foreach ($users as $row) {
                                                  ?>
                                                  <div class="row">
                                                       <div class="col-auto">
                                                            <strong>
                                                                 <img src="image_profil/<?= $row['image'] ?>" class=" rounded-circle"
                                                                      style="width:40px;">
                                                            </strong>
                                                       </div>
                                                       <div class="col p-2">
                                                            <div class="bg-light  py-1">
                                                                 <div class="row">
                                                                      <div class="col d-flex">
                                                                           <p class="fw-bold">
                                                                                <?= $row['username'] ?>
                                                                           </p>
                                                                           &nbsp;
                                                                           <p class=" text-body-secondary">
                                                                                <?= $row['isikomentar'] ?>
                                                                           </p>
                                                                      </div>
                                                                      <div class="col-auto">
                                                                           <small class="text-muted">
                                                                                <?= $row['tanggalkomentar'] ?>
                                                                           </small>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <br>
                                                  <?php
                                             }
                                        } else {
                                             ?>
                                             <div class="mb-3">
                                                  <p class="card-text text-body-secondary">
                                                       Belum ada komentar! Tambahkan satu untuk
                                                       memulai percakapan.
                                                  </p>
                                             </div>
                                        <?php } ?>
                                   </div>
                                   <div class="row">
                                        <?php
                                        $jumlahkomentar = "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'";
                                        $hitungdata = $conn->query($jumlahkomentar);
                                        $menampilkanjumlahdata = $hitungdata->rowCount();
                                        echo "<h5><strong>$menampilkanjumlahdata komentar</strong></h5>";
                                        ?>
                                        <?php
                                        $userid = $_SESSION['userid'];
                                        $stmt = $conn->prepare("SELECT * FROM   user WHERE userid='$userid'");
                                        $stmt->execute();
                                        $stmt->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $row) {
                                             ?>
                                             <div class="col-auto">
                                                  <h5>
                                                       <img src="image_profil/<?= $row['image'] ?>" class=" rounded-circle"
                                                            style="width:60px;">
                                                  </h5>
                                             </div>
                                             <div class="col ">
                                                  <form method="POST" action="php/komentar.php">
                                                       <div class="mb-3">
                                                            <input type="hidden" name="komentarid">
                                                            <input type="hidden" value="<?= $_GET['fotoid'] ?>" name="fotoid">
                                                            <textarea name="isikomentar" class="form-control"
                                                                 placeholder="Tambahkan Komentar"></textarea>

                                                       </div>
                                                       <div class="text-end">
                                                            <button type="submit" name="simpan"
                                                                 class="btn btn-primary">Kirim</button>
                                                       </div>
                                                  </form>
                                             </div>
                                        <?php } ?>
                                   </div>

                              </div>
                         </div>
                    <?php } ?>

               </div>
          </div>
     </div>
     <!-- end -->



     <script src=" Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>