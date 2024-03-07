<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Admin Login</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
     <div class="d-flex justify-content-center align-items-center vh-100">

          <form class="shadow w-450 p-3" action="admin/admin-login.php" method="post">

               <h4 class="display-4  fs-1">Admin LOGIN</h4><br>
               <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                         <?php echo $_GET['error']; ?>
                    </div>
               <?php } ?>

               <div class="mb-3">
                    <label class="form-label">User name</label>
                    <input type="text" class="form-control" name="uname"
                         value="<?php echo (isset($_GET['uname'])) ? $_GET['uname'] : "" ?>">
               </div>

               <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass">
               </div>

               <button type="submit" class="btn btn-primary">Login</button>
               <a href="signup.php" class="link-secondary">Sign Up</a>
               &ensp;
               <a href="blog.php" class="link-secondary">Berandan</a>
          </form>
     </div>
     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>