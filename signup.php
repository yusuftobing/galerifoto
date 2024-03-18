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
     <div class="d-flex justify-content-center align-items-center vh-100">

          <form class="shadow w-450 p-3" action="php/signup.php" method="post" enctype="multipart/form-data">

               <h4 class="display-4  fs-1">Create Account</h4><br>
               <?php if (isset ($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                         <?php echo $_GET['error']; ?>
                    </div>
               <?php } ?>

               <?php if (isset ($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                         <?php echo $_GET['success']; ?>
                    </div>
               <?php } ?>

               <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="nlengkap" style="width:400px;"
                         value="<?php echo (isset ($_GET['nlengkap'])) ? $_GET['nlengkap'] : "" ?>">
               </div>

               <div class="mb-3">
                    <label class="form-label">User name</label>
                    <input type="text" class="form-control" name="uname"
                         value="<?php echo (isset ($_GET['uname'])) ? $_GET['uname'] : "" ?>">
               </div>
               <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat"
                         value="<?php echo (isset ($_GET['alamat'])) ? $_GET['alamat'] : "" ?>">
               </div>
               <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email"
                         value="<?php echo (isset ($_GET['email'])) ? $_GET['email'] : "" ?>">
               </div>

               <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass">
               </div>

               <div class="mb-3">
                    <label class="form-label">Foto :</label>
                    <input type="file" class="form-control" name="image" required>
               </div>

               <button type="submit" class="btn btn-primary" name="tambah">Sign Up</button>
               <a href="login.php" class="link-secondary">Login</a>
          </form>
     </div>
     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>