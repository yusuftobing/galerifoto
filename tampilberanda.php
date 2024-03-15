<?php
session_start();
include 'db_conn.php';
// error_reporting(0);
if (isset ($_SESSION['status']) != 'login') {
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
     <link rel="stylesheet" href="Assets/css/tampildata.css">
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


                                   <a class="btn btn-primary" href="Assets/img/<?= $row['lokasifile'] ?>"
                                        download="hayoloo" role="button"><i class="bi bi-download"></i></a>



                                   <div class="like d-flex">
                                        <a href="php/like.php?t=1&fotoid=<?= $row['fotoid'] ?>"
                                             class="add_style<?= $_GET['fotoid'] ?>" id="click_unlick_like"
                                             style="text-decoration:none; color:black;" data-type-click="like"
                                             data-foto_id="<?= $_GET['fotoid'] ?>"><i class="bi bi-hand-thumbs-up-fill"
                                                  style="font-size:25px;"></i>
                                             <input id="ch_like<?= $_GET['fotoid'] ?>" type="hidden">
                                             <?= $like ?>
                                        </a>

                                        <!-- <div class="count_like<?= $_GET['fotoid'] ?>">0</div> -->

                                        &thinsp;
                                        <a href="php/like.php?t=2&fotoid=<?= $row['fotoid'] ?>"
                                             class="add_styleun<?= $_GET['fotoid'] ?>" id="click_unlick_like"
                                             style="text-decoration:none; color:black;" data-type-click="unlike"
                                             data-foto_id="<?= $_GET['fotoid'] ?>"><i
                                                  class="bi bi-hand-thumbs-down-fill" style="font-size:25px;"></i>
                                             <input id="ch_unlike<?= $_GET['fotoid'] ?>" type="hidden">
                                             <?= $dislike ?>
                                        </a>
                                        <!-- <div class="count_unlike<?= $_GET['fotoid']; ?>">0</div> -->
                                   </div>


                              </div>
                              <h3 class="card-text p-5">
                                   <?= $row['judulfoto'] ?>
                              </h3>

                              <div class="mb-3">
                                   <h5 class="card-text">
                                        <small class="text-body-secondary">Komentar :</small>
                                   </h5>
                              </div>

                              <div class="row" style="max-height: 250px; overflow: auto; margin-bottom:50px;">
                                   <?php
                                        $fotoid = $row['fotoid'];
                                        $komentar = "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='$fotoid'";
                                        $stmt = $conn->prepare($komentar);
                                        $stmt->execute();
                                        $users = $stmt->fetchAll();
                                        foreach ($users as $row) {
                                             ?>
                                   <div class="row">
                                        <div class="col-auto">
                                             <strong>
                                                  <?= $row['username'] ?>
                                             </strong>
                                        </div>
                                        <div class="col p-2">
                                             <div class="bg-light  py-1">
                                                  <div class="row">
                                                       <div class="col">
                                                            <?= $row['username'] ?>
                                                       </div>
                                                       <div class="col-auto">
                                                            <small class="text-muted">
                                                                 <?= $row['tanggalkomentar'] ?>
                                                            </small>
                                                       </div>
                                                  </div>
                                                  <div class="mt-2 fw-bold">
                                                       <?= $row['isikomentar'] ?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <br>
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
                                             <?= $row['username'] ?>
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
<script type="text/javascript">
$(document).ready(function() {
     $(document).on('click', '#click_unlick_like', function() {
          var type = $(this).data('type-click');
          var fotoid = $(this).data('foto_id');

          var count_like = parseInt($(".count_like" + fotoid).text());
          var count_unlike = parseInt($(".count_unlike" + fotoid).text());

          var ch_like = $("#ch_like" + fotoid).val();
          var ch_unlike = $("#ch_unlike" + fotoid).val();

          function Minus_like() {
               $(".count_like" + fotoid).text(count_like - 1);
               $("#ch_like" + fotoid).val("");
          }

          function Minus_unlike() {
               $(".count_unlike" + fotoid).text(count_unlike - 1);
               $("#ch_unlike" + fotoid).val("");
          }

          if (type == "like") {

               if (ch_unlike == "yes") {
                    Minus_unlike();
                    $(".add_styleun" + fotoid).css('color', 'black');
               }

               if (ch_like == "yes") {
                    Minus_like();
                    $(".add_style" + fotoid).css('color', 'black');
               }
               if (ch_like == "") {
                    $(".count_like" + fotoid).text(count_like + 1);
                    $("#ch_like" + fotoid).val("yes");
                    $(".add_style" + fotoid).css('color', 'blue');
               }
          }
          if (type == "unlike") {
               if (ch_like == "yes") {
                    Minus_like();
                    $(".add_style" + fotoid).css('color', 'black');
               }

               if (ch_unlike == "yes") {
                    Minus_unlike();
                    $(".add_styleun" + fotoid).css('color', 'black');
               }
               if (ch_unlike == "") {
                    $(".count_unlike" + fotoid).text(count_unlike + 1);
                    $("#ch_unlike" + fotoid).val("yes");
                    $(".add_styleun" + fotoid).css('color', 'blue');
               }
          }
     });
});
</script>

</html>