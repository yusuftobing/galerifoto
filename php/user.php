<?php

function getUserById($userid, $conn)
{
     $sql = "SELECT * FROM user WHERE userid= ?";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$userid]);

     if ($stmt->rowCount() == 1) {
          $user = $stmt->fetch();
          return $user;
     } else {
          return 0;
     }
}