<?php

if (isset($_POST['sumbit_login'])) {

  require 'dbh.inc.php';

  $uid = $_POST['uid'];
  $password = $_POST['pwd'];

  if (empty($uid) || empty($password)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
  else {
    $sql = "SELECT * FROM member WHERE username=? OR email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result))
      {
        $pwdCheck = $password == $row['password'];
        if ($pwdCheck == false) {
          header("Location: ../index.php?error=wrongpasswordd");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['userId'] = $row['memberID'];
          $_SESSION['userUid'] = $row['username'];

          header("Location: ../main.php?login=success");
          exit();
        }
        else {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        }
      }
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }

    }
  }
}
else {
  header("Location: ../index.php");
  exit();
}
