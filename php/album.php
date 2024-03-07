<?php
session_start();
include "../db_conn.php";

// delete
if (isset($_POST['delete'])) {

     $albumid = $_POST['delete'];

     try {
          $query = "DELETE FROM album WHERE albumid=:albumid";
          $statement = $conn->prepare($query);
          $data = [
               ':albumid' => $albumid
          ];
          $query_execute = $statement->execute($data);


          if ($query_execute) {
               $_SESSION['Message'] = "Delete Data Berhasil";
               header('Location: ../album/album.php');
               exit(0);

          } else {
               $_SESSION['Message'] = "Delete Data Gagal";
               header('Location: ../album/album.php');

               exit(0);
          }

     } catch (PDOException $e) {
          echo $e->getMessage();
     }
}
// end delete



// Update
if (isset($_POST['update'])) {
     $albumid = $_POST['albumid'];
     $namaalbum = $_POST['namaalbum'];
     $deskripsi = $_POST['deskripsi'];
     $tanggal = date('Y-m-d');
     $userid = $_SESSION['userid'];
     try {
          $query = "UPDATE album SET  namaalbum=:namaalbum, deskripsi=:deskripsi, tanggaldibuat=:tanggaldibuat, userid=:userid WHERE albumid=:albumid LIMIT 1";
          $statement = $conn->prepare($query);
          $data = [
               ':namaalbum' => $namaalbum,
               ':deskripsi' => $deskripsi,
               ':tanggaldibuat' => $tanggal,
               ':userid' => $userid,
               ':albumid' => $albumid

          ];
          $query_execute = $statement->execute($data);

          if ($query_execute) {
               $_SESSION['Message'] = "Update Data Berhasil";
               header('Location: ../album/buatalbum.php');

          } else {
               $_SESSION['Message'] = "Update Data Gagal";
               header('Location: ../album/buatalbum.php');

               exit(0);
          }

     } catch (PDOException $e) {
          echo $e->getMessage();
     }
}
// end Update


// simpan
if (isset($_POST['simpan'])) {
     $namaalbum = $_POST['namaalbum'];
     $deskripsi = $_POST['deskripsi'];
     $tanggal = date('Y-m-d');
     $userid = $_SESSION['userid'];

     $query = "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid ) VALUES (:namaalbum, :deskripsi, :tanggal, :userid) ";
     $query_run = $conn->prepare($query);

     $data = [
          ':namaalbum' => $namaalbum,
          ':deskripsi' => $deskripsi,
          ':tanggal' => $tanggal,
          ':userid' => $userid
     ];

     $query_execute = $query_run->execute($data);

     if ($query_execute) {
          $_SESSION['Message'] = "Input Data Berhasil";
          header('Location: ../album/buatalbum.php');

     } else {
          $_SESSION['Message'] = "Input Data Gagal";
          header('Location: ../album/buatalbum.php');

          exit(0);
     }
}
// end simpan