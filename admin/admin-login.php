<?php
session_start();

if (
     isset($_POST['uname']) &&
     isset($_POST['pass'])
) {

     include "../db_conn.php";

     $uname = $_POST['uname'];
     $pass = $_POST['pass'];

     $data = "uname=" . $uname;

     if (empty($uname)) {
          $em = "User name is required";
          header("Location: ../admin-login.php?error=$em&$data");
          exit;
     } else if (empty($pass)) {
          $em = "Password is required";
          header("Location: ../admin-login.php?error=$em&$data");
          exit;
     } else {

          $sql = "SELECT * FROM admin WHERE username = ?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$uname]);

          if ($stmt->rowCount() == 1) {
               $user = $stmt->fetch();

               $username = $user['username'];
               $password = $user['password'];
               $adminid = $user['adminid'];
               if ($username === $uname) {
                    if (password_verify($pass, $password)) {
                         $_SESSION['adminid'] = $adminid;
                         $_SESSION['username'] = $username;

                         header("Location: dashboard.php");
                         exit;
                    } else {
                         $em = "Incorect User name or password";
                         header("Location: ../admin-login.php?error=$em&$data");
                         exit;
                    }

               } else {
                    $em = "Incorect User name or password";
                    header("Location: ../admin-login.php?error=$em&$data");
                    exit;
               }

          } else {
               $em = "Incorect User name or password";
               header("Location: ../admin-login.php?error=$em&$data");
               exit;
          }
     }


} else {
     header("Location: ../admin-login.php?error=error");
     exit;
}