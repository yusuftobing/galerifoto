<?php
session_start();
include '../db_conn.php';
$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];
$tanggallike = date('Y-m-d');


$query = "INSERT INTO likefoto (fotoid, userid, tanggallike ) VALUES (:fotoid, :userid, :tanggallike) ";
$query_run = $conn->prepare($query);

$data = [
     ':fotoid' => $fotoid,
     ':userid' => $userid,
     ':tanggallike' => $tanggallike
];

$query_execute = $query_run->execute($data);

if ($query_execute) {
     header('Location: ../index.php');

} else {
     header('Location: ../index.php');

     exit(0);
}

$stmt = $conn->prepare("SELECT * FROM likefoto");
$stmt->execute();
$user = $stmt->fetchAll();
foreach ($user as $row) {

}
