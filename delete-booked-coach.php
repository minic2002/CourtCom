<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login");
    exit();
}

// Check if user is a Court Owner or Coach
if ($_SESSION["usertype"] == "Court Owner" || $_SESSION["usertype"] == "Coach") {
    // Redirect user to the appropriate dashboard
    if ($_SESSION["usertype"] == "Court Owner") {
        header("Location: dashboard_court");
    } else {
        header("Location: dashboard_coach");
    }
    exit();
}

include "userdb.php";

$bcch_id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM book_coach WHERE bcch_id = ?");
mysqli_stmt_bind_param($stmt, "i", $bcch_id);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn) > 0) {
    header("Location: user-booking-coach");
    exit();
} else {
    header("Location: user-booking-coach");
    exit();
}

mysqli_close($conn);
?>