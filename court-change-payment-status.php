<?php
  include "database.php";

  // Check if user is logged in
  if (!isset($_SESSION["user_id"])) {
      header("Location: login");
      exit();
  }

  if ($_SESSION["usertype"] == "User" || $_SESSION["usertype"] == "Coach") {
      if ($_SESSION["usertype"] == "User") {
          header("Location: dashboard");
      } elseif ($_SESSION["usertype"] == "Coach") {
          header("Location: dashboard_coach");
      }
      exit();
  }


    $bcrt_id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "UPDATE pay_booked_court SET payment_Status = 'Paid' WHERE bcrt_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $bcrt_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        header("Location: court-bookings");
        exit();
    } 
    else {
        header("Location: court-bookings");
        exit();
    }
?>