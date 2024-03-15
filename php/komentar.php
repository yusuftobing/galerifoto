<?php
session_start();
include '../db_conn.php';
// error_reporting(0);
if (isset($_POST['simpan'])) {
     $komentarid = $_POST['komentarid'];
     $fotoid = $_POST['fotoid'];
     $userid = $_SESSION['userid'];
     $isikomentar = $_POST['isikomentar'];
     $tanggalkomentar = date('Y-m-d');


     $query = "INSERT INTO komentarfoto (komentarid, fotoid , userid, isikomentar, tanggalkomentar) VALUES (:komentarid, :fotoid, :userid, :isikomentar, :tanggalkomentar) ";
     $query_run = $conn->prepare($query);

     $data = [
          ':komentarid' => $komentarid,
          ':fotoid' => $fotoid,
          ':userid' => $userid,
          ':isikomentar' => $isikomentar,
          ':tanggalkomentar' => $tanggalkomentar
     ];

     $query_execute = $query_run->execute($data);

     if ($query_execute) {
          header("Location: ../tampilberanda.php?fotoid=" . $_POST['fotoid']);
          exit;
     }
}