<?php
session_start();

if (isset ($_SESSION['userid']) && isset ($_SESSION['namalengkap'])) {



     if (
          isset ($_POST['tambah'])
     ) {

          include "../db_conn.php";

          $nlengkap = $_POST['nlengkap'];
          $uname = $_POST['uname'];
          $old_pp = $_POST['old_image'];
          $userid = $_SESSION['userid'];

          if (empty ($nlengkap)) {
               $em = "Full name is required";
               header("Location: ../editprofil.php?error=$em");
               exit;
          } else if (empty ($uname)) {
               $em = "User name is required";
               header("Location: ../editprofil.php?error=$em");
               exit;
          } else {

               if (isset ($_FILES['image']['name']) and !empty ($_FILES['image']['name'])) {


                    $img_name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $error = $_FILES['image']['error'];

                    if ($error === 0) {
                         $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                         $img_ex_to_lc = strtolower($img_ex);

                         $allowed_exs = array('jpg', 'jpeg', 'png');
                         if (in_array($img_ex_to_lc, $allowed_exs)) {
                              $new_img_name = uniqid($uname, true) . '.' . $img_ex_to_lc;
                              $img_upload_path = '../image_profil/' . $new_img_name;
                              // Delete old profile pic
                              $old_pp_des = "../image_profil/$old_pp";
                              if (unlink($old_pp_des)) {
                                   // just deleted
                                   move_uploaded_file($tmp_name, $img_upload_path);
                              } else {
                                   // error or already deleted
                                   move_uploaded_file($tmp_name, $img_upload_path);
                              }


                              // update the Database
                              $sql = "UPDATE user SET namalengkap=?, username=?, image=?  WHERE userid=?";
                              $stmt = $conn->prepare($sql);
                              $stmt->execute([$nlengkap, $uname, $new_img_name, $userid]);
                              $_SESSION['namalengkap'] = $nlengkap;
                              header("Location: ../editprofil.php?success=Update Data Berhasil");
                              exit;
                         } else {
                              $em = "Anda tidak dapat mengunggah file jenis ini";
                              header("Location: ../editprofil.php?error=$em&$data");
                              exit;
                         }
                    } else {
                         $em = "terjadi kesalahan yang tidak diketahui!";
                         header("Location: ../editprofil.php?error=$em&$data");
                         exit;
                    }


               } else {
                    $sql = "UPDATE user 
                       SET namalengkap=?, username=?, image=?
                       WHERE userid=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$nlengkap, $uname, $new_img_name, $userid]);

                    header("Location: ../editprofil.php?success=Update Data Berhasil");
                    exit;
               }
          }


     } else {
          header("Location: ../editprofil.php?error=error");
          exit;
     }


} else {
     header("Location: login.php");
     exit;
}