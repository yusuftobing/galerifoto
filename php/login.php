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
      header("Location: ../login.php?error=$em&$data");
      exit;
   } else if (empty($pass)) {
      $em = "Password is required";
      header("Location: ../login.php?error=$em&$data");
      exit;
   } else {

      $sql = "SELECT * FROM user WHERE username= ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$uname]);

      if ($stmt->rowCount() == 1) {
         $user = $stmt->fetch();
         $username = $user['username'];
         $password = $user['password'];
         $nlengkap = $user['namalengkap'];
         $userid = $user['userid'];
         if ($username === $uname) {
            if (password_verify($pass, $password)) {
               $_SESSION['userid'] = $userid;
               $_SESSION['namalengkap'] = $nlengkap;
               $_SESSION['status'] = 'login';
               echo "<script>
               alert('Anda Berhasil Login');
                 location.href='../blog.php';
               exit;
               </script>";

            } else {
               $em = "Incorect User name or password";
               header("Location: ../login.php?error=$em&$data");
               exit;
            }

         } else {
            $em = "Incorect User name or password";
            header("Location: ../login.php?error=$em&$data");
            exit;
         }

      } else {
         $em = "Incorect User name or password";
         header("Location: ../login.php?error=$em&$data");
         exit;
      }
   }


} else {
   header("Location: ../login.php?error=error");
   exit;
}