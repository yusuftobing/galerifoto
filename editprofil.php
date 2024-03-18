<?php
session_start();

if (isset ($_SESSION['userid']) && isset ($_SESSION['namalengkap'])) {
     include "php/user.php";
     include "db_conn.php";
     $user = getUserById($_SESSION['userid'], $conn);
     ?>

<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Sign Up</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
     <?php
          if ($user) { ?>



     <div class="d-flex justify-content-center align-items-center vh-100">

          <form class="shadow w-450 p-3" action="php/editprofil.php" method="post" enctype="multipart/form-data">

               <h4 class="display-4  fs-1">Edit Profil</h4><br>
               <!-- error -->
               <?php if (isset ($_GET['error'])) { ?>
               <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
               </div>
               <?php } ?>
               <!-- end error -->

               <!-- succes -->
               <?php if (isset ($_GET['success'])) { ?>
               <div class="alert alert-success" role="alert">
                    <?php echo $_GET['success']; ?>
               </div>
               <?php } ?>
               <!-- end succes -->

               <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="nlengkap" style="width:400px;"
                         value="<?php echo $user['namalengkap'] ?>">
               </div>

               <div class="mb-3">
                    <label class="form-label">User name</label>
                    <input type="text" class="form-control" name="uname" value="<?php echo $user['username'] ?>">
               </div>
               <div class="mb-3">
                    <label class="form-label">Foto :</label>
                    <input type="file" class="form-control" name="image" required">
                    <img src="image_profil/<?= $user['image']; ?>" class="rounded-circle" style="width:70px;">
                    <input type="text" hidden="hidden" name="old_image" value="<?= $user['image'] ?>">
               </div>

               <button type="submit" class="btn btn-primary" name="tambah">Update</button>
               <a href="index.php" class="link-secondary">Home</a>
          </form>

     </div>
     <?php } else {
               header("Location: index.php");
               exit;
          }
          ?>
     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php } else {
     header("Location: login.php");
     exit;
}
?>