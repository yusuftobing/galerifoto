<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Login</title>
     <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <div class="navbar navbar-expand-lg d-flex">
          <div class=" container-fluid justify-content-center align-items-center vh-100 opacity-100">
               <form class="shadow p-3 login" action="php/login.php" method="post" style="width:400px;">
                    <h4 class="display-4  fs-1">LOGIN</h4><br>
                    <?php if (isset ($_GET['error'])) { ?>
                         <div class="alert alert-danger" role="alert">
                              <?php echo $_GET['error']; ?>
                         </div>
                    <?php } ?>

                    <div class="mb-3">
                         <label class="form-label">Username</label>
                         <input type="text" class="form-control" name="uname"
                              value="<?php echo (isset ($_GET['uname'])) ? $_GET['uname'] : "" ?>">
                    </div>

                    <div class="mb-3">
                         <label class="form-label">Password</label>
                         <input type="password" class="form-control" name="pass">
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="signup.php" class="link-secondary">Register</a>
                    &ensp;
                    <a href="index.php" class="link-secondary">Home</a>
                    &ensp;
                    <a class="link-secondary" href="logout.php">Logout</a>
          </div>
          </form>
     </div>
     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>