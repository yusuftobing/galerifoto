<?php
session_start();
include '../db_conn.php';
if (isset ($_SESSION['status']) != '$status') {
     echo "<script> alert('Anda Belum Login') 
     location.href='../blog.php';
     </script>";
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
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
                              <a class="nav-link active" aria-current="page" href="album.php">Album</a>
                         </li>
                         <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="../foto/foto.php">Foto</a>
                         </li>
                    </ul>
                    <a class="btn btn-primary" href="../logout.php" type="button">Logout</a>
               </div>
          </div>
     </nav>

     <div class="container" style="margin-top: 15px;">
          <ol class="breadcrumb">
               <li class="breadcrumb-item">
                    <a href="../index.php">Home</a>
               </li>
               <li class="breadcrumb-item active">Album</li>
          </ol>

          <center>
               <h3>Album </h3>
          </center>
          <hr />
          <a href="buatalbum.php" class="btn btn-sm btn-primary">Buat Album</a>
          <div class="row" style="margin-top: 15px;">
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
                    <div class="table-responsive">
                         <table class='table table-striped table-bordered table-hover' width='100%' cellspacing='0'>
                              <thead>

                                   <tr>
                                        <th style="color:red; text-align:center;">ID</th>
                                        <th style=" text-align:center;">Nama Album</th>
                                        <th style=" text-align:center;">Deskripsi</th>
                                        <th style=" text-align:center;">Tanggal</th>
                                        <th style=" text-align:center;">Aksi</th>


                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   $userid = $_SESSION['userid'];
                                   $query = "SELECT * FROM album WHERE userid='$userid'";
                                   $statement = $conn->prepare($query);
                                   $statement->execute();
                                   $statement->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                                   $result = $statement->fetchAll();
                                   if ($result) {
                                        foreach ($result as $row) {
                                             ?>
                                             <tr>
                                                  <td>
                                                       <center>
                                                            <?= $row['albumid']; ?>
                                                       </center>

                                                  </td>
                                                  <td>
                                                       <center>
                                                            <?= $row['namaalbum']; ?>
                                                       </center>

                                                  </td>
                                                  <td>
                                                       <center>
                                                            <?= $row['deskripsi']; ?>
                                                       </center>

                                                  </td>
                                                  <td>
                                                       <center>
                                                            <?= $row['tanggaldibuat']; ?>
                                                       </center>

                                                  </td>
                                                  <td>
                                                       <center>
                                                            <form action="../php/album.php" method="POST">
                                                                 <a href="edit.php?id=<?= $row['albumid']; ?> &NamaAlbum=<?= $row['namaalbum']; ?>&Deskripsi=<?= $row['deskripsi']; ?> &Albumid=<?= $row['albumid']; ?>"
                                                                      class="btn btn-primary">Edit</a>

                                                                 <button type="submit" name="delete"
                                                                      value="<?= $row['albumid']; ?>"
                                                                      class="btn btn-danger">Delete</button>
                                                            </form>
                                                       </center>
                                                  </td>
                                             </tr>
                                             <?php
                                        }
                                   } else {
                                        ?>
                                        <tr>
                                             <td colspan="5">No Record Found</td>
                                        </tr>
                                        <?php
                                   }

                                   ?>

                              </tbody>
                         </table>
                    </div>
               </section>

          </div>

     </div>

     <script src="../Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>