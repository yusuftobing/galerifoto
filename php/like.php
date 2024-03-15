<?php
session_start();
include '../db_conn.php';
// error_reporting(0);
if (isset ($_SESSION['status']) != 'login') {
     echo "<script> alert('Anda Belum Login') 
     location.href='blog.php';  
     </script>";
}
if (isset ($_GET['t'], $_GET['fotoid']) and !empty ($_GET['t']) and !empty ($_GET['fotoid'])) {
     $getid = (int) $_GET['fotoid'];
     $gett = (int) $_GET['t'];
     $userid = $_SESSION['userid'];
     $check = $conn->prepare('SELECT fotoid FROM foto WHERE fotoid = ? ');
     $check->execute(array($getid));

     if ($check->rowCount() == 1) {
          if ($gett == 1) {
               $check_like = $conn->prepare('SELECT likeid FROM likefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
               $check_like->execute(array($getid, $userid, $userid));

               $del = $conn->prepare('DELETE FROM dislikefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
               $del->execute(array($getid, $userid, $userid));

               if ($check_like->rowCount() == 1) {
                    $del = $conn->prepare('DELETE FROM likefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
                    $del->execute(array($getid, $userid, $userid));
               } else {
                    $ins = $conn->prepare('INSERT INTO likefoto (fotoid,id_member,userid) VALUES (?,?,?)');
                    $ins->execute(array($getid, $userid, $userid));
               }


          } elseif ($gett == 2) {
               $check_like = $conn->prepare('SELECT dislikeid FROM dislikefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
               $check_like->execute(array($getid, $userid, $userid));

               $del = $conn->prepare('DELETE FROM likefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
               $del->execute(array($getid, $userid, $userid));

               if ($check_like->rowCount() == 1) {
                    $del = $conn->prepare('DELETE FROM dislikefoto WHERE fotoid = ? AND id_member = ? AND userid = ?');
                    $del->execute(array($getid, $userid, $userid));
               } else {
                    $ins = $conn->prepare('INSERT INTO dislikefoto (fotoid,id_member,userid) VALUES (?,?,?)');
                    $ins->execute(array($getid, $userid, $userid));
               }
          }
          header('Location: ../tampilberanda.php?fotoid=' . $getid);
     } else {
          exit ('error fatal');
     }
} else {
     exit ('error fatal');
}