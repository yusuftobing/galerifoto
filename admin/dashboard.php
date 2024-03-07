<?php
session_start();

if (isset($_SESSION['adminid']) && isset($_SESSION['username'])) {
     ?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Dashboard</title>
     <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../bootstrap-icons/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="../css/bar.css">
</head>

<body>
     <input type="checkbox" id="checkbox">
     <header class="header">
          <h2 class="u-name">ADMIN <b>PHOTO</b>
               <label for="checkbox">
                    <i id="navbtn" class="bi bi-list"></i>
               </label>
          </h2>
          <i class="bi bi-person-fill"></i>
     </header>
     <div class="body">
          <nav class="side-bar">
               <div class="user-p">
                    <img src="../img/user.jpg">
                    <h4>Yusuf</h4>
               </div>
               <ul>
                    <li>
                         <a href="#">
                              <i class="bi bi-pc-display-horizontal"></i>
                              <span>Dashboard</span>
                         </a>
                    </li>
                    <li>
                         <a href="#">
                              <i class="bi bi-envelope"></i>
                              <span>Message</span>
                         </a>
                    </li>
                    <li>
                         <a href="#">
                              <i class="bi bi-chat-left-dots-fill"></i>
                              <span>Comment</span>
                         </a>
                    </li>
                    <li>
                         <a href="#">
                              <i class="bi bi-exclamation-circle"></i>
                              <span>About</span>
                         </a>
                    </li>
                    <li>
                         <a href="#">
                              <i class="bi bi-gear"></i>
                              <span>Setting</span>
                         </a>
                    </li>
                    <li>
                         <a href="../logout.php">
                              <i class="bi bi-box-arrow-left"></i>
                              <span>Logout</span>
                         </a>
                    </li>
               </ul>
          </nav>
          <section class="section-1">
               <h1>WELCOME</h1>
               <p>#CodingWithElias</p>
          </section>
     </div>
     <script src="Assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php } else {
     header("Location: ../admin-login.php");
     exit;
} ?>