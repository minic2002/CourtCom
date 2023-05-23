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

  

?>