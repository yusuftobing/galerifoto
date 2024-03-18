<?php
session_start();
if (
   isset ($_POST['uname']) &&
   isset ($_POST['pass'])
) {

   include "../db_conn.php";

   $uname = $_POST['uname'];
   $pass = $_POST['pass'];

   $data = "uname=" . $uname;

   if (empty ($uname)) {
      $em = "Nama Dibutuhkan";
      header("Location: ../login.php?error=$em&$data");
      exit;
   } else if (empty ($pass)) {
      $em = "Katasandi Dibutuhkan";
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
		alert('Login Berhasil');
		location.href='../dasboard.php';
		exit;
		</script>";

            } else {
               $em = "Login Gagal";
               header("Location: ../login.php?error=$em&$data");
               exit;
            }

         } else {
            $em = "Nama pengguna atau kata sandi salah";
            header("Location: ../login.php?error=$em&$data");
            exit;
         }

      } else {
         $em = "Nama pengguna atau kata sandi salah";
         header("Location: ../login.php?error=$em&$data");
         exit;
      }
   }


} else {
   header("Location: ../login.php?error=error");
   exit;
}