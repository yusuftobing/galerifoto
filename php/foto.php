<?php
session_start();
include "../db_conn.php";
// delete
if (isset($_POST['delete'])) {
     $fotoid = $_POST['delete'];
     $query = "SELECT * FROM foto WHERE fotoid='$fotoid'";
     $statement = $conn->prepare($query);
     $statement->execute();
     $statement->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
     $result = $statement->fetchAll();
     foreach ($result as $row) {
          if (is_file('../Assets/img/' . $row['lokasifile'])) {
               unlink('../Assets/img/' . $row['lokasifile']);
          }
          try {
               $fotoid = $_POST['delete'];
               $query = "DELETE FROM foto WHERE fotoid=:fotoid";
               $statement = $conn->prepare($query);
               $data = [
                    ':fotoid' => $fotoid
               ];
               $query_execute = $statement->execute($data);


               if ($query_execute) {
                    $_SESSION['Message'] = "Delete Data Berhasil";
                    header('Location: ../foto/foto.php');
                    exit(0);

               } else {
                    $_SESSION['Message'] = "Delete Data Gagal";
                    header('Location: ../foto/foto.php');

                    exit(0);
               }

          } catch (PDOException $e) {
               echo $e->getMessage();
          }
     }
}
// end delete



// Update
if (isset($_POST['update'])) {
     $fotoid = $_POST['fotoid'];
     $judulfoto = $_POST['judulfoto'];
     $deskripsifoto = $_POST['deskripsifoto'];
     $tanggalunggah = date('Y-m-d');
     $userid = $_SESSION['userid'];
     $foto = $_FILES['lokasifile']['name'];
     $tmp = $_FILES['lokasifile']['tmp_name'];
     $lokasi = '../Assets/img/';
     $namafoto = rand() . '-' . $foto;

     if ($foto == null) {
          try {
               $query = "UPDATE foto SET judulfoto=:judulfoto, deskripsifoto=:deskripsifoto, tanggalunggah=:tanggalunggah WHERE fotoid=:fotoid LIMIT 1";
               $statement = $conn->prepare($query);
               $data = [
                    ':fotoid' => $fotoid,
                    ':judulfoto' => $judulfoto,
                    ':deskripsifoto' => $deskripsifoto,
                    ':tanggalunggah' => $tanggalunggah,

               ];
               $query_execute = $statement->execute($data);

               if ($query_execute) {
                    $_SESSION['Message'] = "Update Data Berhasil";
                    header('Location: ../foto/edit.php');

               } else {
                    $_SESSION['Message'] = "Update Data Gagal";
                    header('Location: ../foto/edit.php');

                    exit(0);
               }

          } catch (PDOException $e) {
               echo $e->getMessage();
          }
     } else {
          $query = "SELECT * FROM foto WHERE fotoid='$fotoid'";
          $statement = $conn->prepare($query);
          $statement->execute();
          $statement->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
          $result = $statement->fetchAll();
          if ($result) {
               foreach ($result as $row) {
                    if (is_file('../Assets/img/' . $row['lokasifile'])) {
                         unlink('../Assets/img/' . $row['lokasifile']);
                    }

                    move_uploaded_file($tmp, $lokasi . $namafoto);
                    try {
                         $query = "UPDATE foto SET  judulfoto=:judulfoto, deskripsifoto=:deskripsifoto, tanggalunggah=:tanggalunggah, lokasifile=:lokasifile  WHERE fotoid=:fotoid LIMIT 1";
                         $statement = $conn->prepare($query);
                         $data = [
                              ':fotoid' => $fotoid,
                              ':judulfoto' => $judulfoto,
                              ':deskripsifoto' => $deskripsifoto,
                              ':tanggalunggah' => $tanggalunggah,
                              ':lokasifile' => $namafoto

                         ];
                         $query_execute = $statement->execute($data);

                         if ($query_execute) {
                              $_SESSION['Message'] = "Update Data Berhasil";
                              header('Location: ../foto/foto.php');

                         } else {
                              $_SESSION['Message'] = "Update Data Gagal";
                              header('Location: ../foto/foto.php');

                              exit(0);
                         }

                    } catch (PDOException $e) {
                         echo $e->getMessage();
                    }
               }
          }

     }


}
// end Update


// simpan
if (isset($_POST['tambah'])) {
     $judulfoto = $_POST['judulfoto'];
     $deskripsifoto = $_POST['deskripsifoto'];
     $tanggalunggah = date('Y-m-d');
     $albumid = $_POST['albumid'];
     $userid = $_SESSION['userid'];
     $foto = $_FILES['lokasifile']['name'];
     $tmp = $_FILES['lokasifile']['tmp_name'];
     $lokasi = '../Assets/img/';
     $namafoto = rand() . '-' . $foto;

     move_uploaded_file($tmp, $lokasi . $namafoto);

     $query = "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, albumid, userid, lokasifile ) VALUES (:judulfoto, :deskripsifoto, :tanggalunggah,
:albumid, :userid, :namafoto) ";
     $query_run = $conn->prepare($query);

     $data = [
          ':judulfoto' => $judulfoto,
          ':deskripsifoto' => $deskripsifoto,
          ':tanggalunggah' => $tanggalunggah,
          ':namafoto' => $namafoto,
          ':albumid' => $albumid,
          ':userid' => $userid
     ];

     $query_execute = $query_run->execute($data);

     if ($query_execute) {
          $_SESSION['Message'] = "Input Data Berhasil";
          header('Location: ../foto/foto.php');

     } else {
          $_SESSION['Message'] = "Input Data Gagal";
          header('Location: ../foto/foto.php');

          exit(0);
     }
}
// end simpan